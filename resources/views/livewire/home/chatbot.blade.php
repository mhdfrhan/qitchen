<div class="fixed bottom-4 right-4 z-[999]">

    <!-- Chat Toggle Button -->
    <button wire:click="toggleChat"
        class="bg-yellow text-white p-4 rounded-full shadow-lg hover:bg-[#847959] transition-colors">
        <svg x-show="!$wire.isOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
        </svg>
        <svg x-show="$wire.isOpen" class="size-6 fill-white" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000" viewBox="0 0 256 256">
            <path
                d="M205.66,194.34a8,8,0,0,1-11.32,11.32L128,139.31,61.66,205.66a8,8,0,0,1-11.32-11.32L116.69,128,50.34,61.66A8,8,0,0,1,61.66,50.34L128,116.69l66.34-66.35a8,8,0,0,1,11.32,11.32L139.31,128Z">
            </path>
        </svg>
    </button>

    <!-- Chat Window -->
    <div x-show="$wire.isOpen" x-transition
        class="absolute bottom-16 right-0 w-96 bg-white rounded-2xl shadow-neutral-800/30 shadow-xl border border-black">
        <!-- Header -->
        <div class="bg-black text-white p-4 rounded-t-lg flex items-center gap-3">
            <img src="https://cdn3d.iconscout.com/3d/premium/thumb/women-3d-icon-download-in-png-blend-fbx-gltf-file-formats--female-woman-girl-young-avatar-pack-people-icons-10239111.png?f=webp"
                class="w-12 h-12 rounded-full bg-yellow" alt="">
            <div>
                <h3 class="text-lg font-semibold">Qimi </h3>
                <p class="text-sm">Ada yang bisa saya bantu?</p>
            </div>
        </div>

        <!-- Chat Messages -->
        <div class="h-96 overflow-y-auto p-4 space-y-4" id="chat-messages">
            @foreach ($conversations as $index => $conversation)
                <div wire:key="conversation-{{ $index }}">
                    <!-- Pesan pengguna -->
                    <div class="flex justify-end mb-3">
                        <div class="bg-yellow text-black rounded-lg py-2 px-4 max-w-[80%]">
                            {{ $conversation['message'] }}
                        </div>
                    </div>
                    <!-- Respons Bot -->
                    @if ($conversation['response'] !== null)
                        <div class="flex justify-start mb-3">
                            <div class="bg-yellow text-black rounded-lg py-2 px-4 max-w-[80%]">
                                {{ $conversation['response'] }}
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach

            @if ($isTyping)
                <div class="flex justify-start mb-3">
                    <div class="bg-yellow text-black rounded-lg py-2 px-4 max-w-[80%]">
                        Qimi sedang mengetik...
                    </div>
                </div>
            @endif

        </div>

        <!-- Input Area -->
        <div class="border-t p-4">
            <form wire:submit.prevent="sendMessage" class="flex gap-2">
                <input wire:model="message" type="text"
                    class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-yellow text-black"
                    placeholder="Ketik pesan Anda...">
                <button type="submit" class="bg-black text-white px-4 py-2 rounded-lg ">
                    <span wire:loading.remove>
                        <svg class="size-5 fill-white" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                            fill="#000000" viewBox="0 0 256 256">
                            <path
                                d="M231.87,114l-168-95.89A16,16,0,0,0,40.92,37.34L71.55,128,40.92,218.67A16,16,0,0,0,56,240a16.15,16.15,0,0,0,7.93-2.1l167.92-96.05a16,16,0,0,0,.05-27.89ZM56,224a.56.56,0,0,0,0-.12L85.74,136H144a8,8,0,0,0,0-16H85.74L56.06,32.16A.46.46,0,0,0,56,32l168,95.83Z">
                            </path>
                        </svg>
                    </span>
                    <span wire:loading wire:target="sendMessage">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                            class="size-5 fill-white motion-safe:animate-spin">
                            <path d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,19a8,8,0,1,1,8-8A8,8,0,0,1,12,20Z"
                                opacity=".25" />
                            <path
                                d="M10.14,1.16a11,11,0,0,0-9,8.92A1.59,1.59,0,0,0,2.46,12,1.52,1.52,0,0,0,4.11,10.7a8,8,0,0,1,6.66-6.61A1.42,1.42,0,0,0,12,2.69h0A1.57,1.57,0,0,0,10.14,1.16Z" />
                        </svg>
                    </span>
                </button>
            </form>
        </div>
    </div>
    @push('scripts')
        <script>
            // Auto scroll ke pesan terbaru
            function scrollToBottom() {
                const chatMessages = document.getElementById('chat-messages');
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }

            // Panggil saat komponen pertama kali dimuat
            document.addEventListener('livewire:init', () => {
                scrollToBottom();
            });
        </script>
    @endpush
</div>
