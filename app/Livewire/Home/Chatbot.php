<?php
namespace App\Livewire\Home;

use Livewire\Component;
use App\Models\ChatConversations;
use Livewire\Attributes\On;
use GeminiAPI\Client;
use GeminiAPI\Resources\Parts\TextPart;
use Illuminate\Support\Facades\Cache;

class Chatbot extends Component
{
    public $message = '';
    public $conversations = [];
    public $isOpen = false;
    public $isTyping = false;

    public function mount()
    {
        $sessionId = session()->getId();
        $this->conversations = ChatConversations::where('session_id', $sessionId)
            ->latest()
            ->take(10)
            ->get()
            ->reverse()
            ->values()
            ->map(function ($conversation) {
                return [
                    'message' => $conversation->message,
                    'response' => $conversation->response
                ];
            })->toArray();
    }

    protected function getMenuAndCategoryInfo()
    {
        return Cache::remember('menu_info', 24 * 60 * 60, function () {
            $categories = \App\Models\MenuCategory::with(['menus' => function ($query) {
                $query->where('available', 1);
            }])->get();

            $menuInfo = "Berikut adalah daftar menu kami:\n\n";

            foreach ($categories as $category) {
                $menuInfo .= "=== {$category->name} ===\n";
                foreach ($category->menus as $menu) {
                    $menuInfo .= "- {$menu->name}: Rp. " . number_format($menu->price) . "\n";
                    if ($menu->is_halal) {
                        $menuInfo .= "  (Halal)\n";
                    }
                }
                $menuInfo .= "\n";
            }

            return $menuInfo;
        });
    }

    public function sendMessage()
    {
        if (empty($this->message)) return;

        $userMessage = $this->message;
        $this->message = '';

        // Tambahkan pesan user ke conversations
        $this->conversations[] = [
            'message' => $userMessage,
            'response' => null
        ];

        $this->isTyping = true;
        $this->dispatch('messageUpdated');

        // Dispatch event untuk memproses pesan
        $this->dispatch('processChatbotMessage', message: $userMessage);

        return;
    }

    #[On('processChatbotMessage')]
    public function processChatbotMessage($message)
    {
        try {
            $client = new Client(env('GEMINI_API_KEY'));

            $menuInfo = $this->getMenuAndCategoryInfo();

            $systemPrompt = $this->generateSystemPrompt($menuInfo);

            $response = $client->geminiProFlash1_5()->generateContent(
                new TextPart($systemPrompt . "\n\n" . $message)
            );

            $responseText = $response->text();

            // Simpan ke database
            $conversation = ChatConversations::create([
                'session_id' => session()->getId(),
                'message' => $message,
                'response' => $responseText
            ]);

            // Update conversations dengan response
            $this->conversations[count($this->conversations) - 1]['response'] = $responseText;

            $this->isTyping = false;
            $this->dispatch('messageUpdated');
        } catch (\Exception $e) {
            \Log::error('Chatbot Error: ' . $e->getMessage());
            
            $this->dispatch('notify', 
                message: 'Maaf, terjadi kesalahan saat memproses pesan', 
                type: 'error'
            );

            $this->isTyping = false;
        }
    }

    protected function generateSystemPrompt($menuInfo)
    {
        return "Nama Kamu adalah Qimi, kamu adalah asisten virtual ramah untuk restoran Qitchen.
        
        Berikut adalah informasi menu terbaru kami:
        {$menuInfo}
        
        Kamu dapat membantu dengan:
        1. Informasi kategori, menu dan harga sesuai data di atas
        2. Restoran qitchen sendiri beroperasi mulai dari jam 10:00-22:00, dan ketika melakukan reservasi, harus 1 jam setelah toko buka dan 1 jam setelah toko tutup.
        3. Qitchen adalah platform berbasis web yang dirancang khusus untuk memudahkan proses reservasi meja di restoran. Tidak hanya itu, Qitchen juga menyediakan fitur pemesanan makanan secara online, sehingga pelanggan dapat memesan makanan sebelum tiba di restoran, menghemat waktu, dan menghindari antrian.
        4. Qitchen beroperasi pada hari Senin sampai Jumat, dengan jam buka pukul 10:00 dan tutup pukul 22:00. Lokasi nya ada di Jalan Sudirman No. 20, Pekanbaru, Riau.
        5. Qitchen menyediakan fitur pembayaran lengkap seperti GoPay/GoPay Later, ATM/Bank Transfer, Credit/Debit Card, ShopeePay/SPayLater, Other QRIS, Alfa Group, Indomaret)
        
        Jika ada pertanyaan di luar jam operasional, ingatkan pelanggan tentang jam buka.
        Jika ditanya tentang data sensitif atau melakukan pemesanan, arahkan untuk menghubungi staf restoran.
        
        Selalu jawab dalam Bahasa Indonesia yang friendly, sopan dan ramah.";
    }

    public function toggleChat()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function render()
    {
        return view('livewire.home.chatbot');
    }
}