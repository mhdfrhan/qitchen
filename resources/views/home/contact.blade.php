<x-main-layout>
    <x-slot name="title">{{ $title }}</x-slot>

    <section
        class="flex items-start flex-wrap xl:flex-nowrap flex-none flex-row h-min xl:h-screen justify-start overflow-visible  relative w-full z-[1]">
        <div class="w-full xl:w-1/2 h-full p-6 xl:pr-0">
            <div class="relative overflow-hidden aspect-square md:aspect-video xl:aspect-auto xl:h-full">
                <div class="h-full relative">
                    <img src="{{ asset('assets/img/contact.webp') }}"
                        class="w-full h-full block object-cover rounded-2xl" />
                    <div class="absolute inset-0 bg-black/30"></div>
                    <div
                        class="absolute container bottom-8 left-1/2 -translate-x-1/2 xl:translate-x-0 xl:bottom-10 xl:left-10">
                        <p
                            class="text-[56px] leading-none text-center xl:text-left md:text-7xl lg:text-8xl xl:text-[112px] 2xl:text-9xl text-light uppercase font-forum">
                            contact
                        </p>
                    </div>
                </div>

                @include('home.partials.navbar')
            </div>
        </div>
        <div class="w-full xl:w-1/2 pt-0 md:pt-6 p-6 items-start md:self-stretch flex flex-col flex-nowrap gap-4 h-auto">
            <div class="flex flex-wrap w-full md:items-stretch md:h-full mb-1">
                <div class="w-full md:w-1/2 overflow-hidden mb-6 md:mb-0 md:h-full md:pr-4">
                    <div
                        class="relative overflow-hidden border border-borderColor p-12 md:h-full w-full rounded-2xl flex flex-col md:items-stretch">
                        <div class="flex items-center justify-center gap-5 mb-6">
                            <svg width="30" height="13" viewBox="0 0 30 13" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <line x1="12" y1="6.5" x2="30" y2="6.5" stroke="#333330" />
                                <rect x="6.5" y="0.48954" width="8.5" height="8.5"
                                    transform="rotate(45 6.5 0.48954)" stroke="#333330" stroke-width="0.5" />
                            </svg>
                            <h2 class="text-2xl font-semibold text-center font-forum uppercase">Opening Hours</h2>
                            <svg width="30" height="13" viewBox="0 0 30 13" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <line x1="18.1362" y1="6.49988" x2="0.13623" y2="6.49988" stroke="#333330" />
                                <rect x="23.6362" y="12.5103" width="8.5" height="8.5"
                                    transform="rotate(-135 23.6362 12.5103)" stroke="#333330" stroke-width="0.5" />
                            </svg>
                        </div>
                        @php
                            $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Sat & Sun'];
                        @endphp
                        <ul class="md:mt-auto font-normal space-y-2">
                            @foreach ($days as $day)
                                <li
                                    class="flex items-end flex-none gap-4 flex-row h-min justify-start overflow-visible p-0 relative w-full text-light/60">
                                    <p class="shrink-0">{{ $day }}</p>
                                    <div class="border-b w-full border-dashed border-borderColor"></div>
                                    <div class="shrink-0">
                                        <p>10:00 - 22:00</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="w-full md:w-1/2">
                    <div class="grid grid-cols-2 gap-3 md:gap-6 w-full h-full">
                        @for ($i = 0; $i < 4; $i++)
                            <img src="{{ asset('assets/img/about/' . ($i + 1) . '.jpg') }}" alt="{{ $i }}"
                                class="w-full h-full rounded-2xl object-cover aspect-square">
                        @endfor
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap w-full items-stretch h-full">
                <div class="w-full md:w-1/2 h-full md:pr-4 mb-6 md:mb-0">
                    <div class="h-full rounded-2xl overflow-hidden google-map">
                        <iframe class="w-full h-full rounded-2xl min-h-80"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.664290281727!2d101.453836625585!3d0.503460278426233!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d5aebdaca659a1%3A0x7ab93f68df52cd31!2sJl.%20Jend.%20Sudirman%20No.100%2C%20Cinta%20Raja%2C%20Kec.%20Marpoyan%20Damai%2C%20Kota%20Pekanbaru%2C%20Riau%2024585!5e0!3m2!1sid!2sid!4v1727744502499!5m2!1sid!2sid"
                            style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <div class="w-full md:w-1/2 overflow-hidden h-full">
                    <div
                        class="relative overflow-hidden border border-borderColor p-12 h-full w-full rounded-2xl flex flex-col items-stretch">
                        <div class="flex items-center justify-center gap-5 mb-6">
                            <svg width="30" height="13" viewBox="0 0 30 13" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <line x1="12" y1="6.5" x2="30" y2="6.5" stroke="#333330" />
                                <rect x="6.5" y="0.48954" width="8.5" height="8.5"
                                    transform="rotate(45 6.5 0.48954)" stroke="#333330" stroke-width="0.5" />
                            </svg>
                            <h2 class="text-2xl font-semibold text-center font-forum uppercase">Get in touch</h2>
                            <svg width="30" height="13" viewBox="0 0 30 13" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <line x1="18.1362" y1="6.49988" x2="0.13623" y2="6.49988" stroke="#333330" />
                                <rect x="23.6362" y="12.5103" width="8.5" height="8.5"
                                    transform="rotate(-135 23.6362 12.5103)" stroke="#333330" stroke-width="0.5" />
                            </svg>
                        </div>
                        @php
                            $contacts = [
                                [
                                    'title' => 'Address',
                                    'content' => 'Jl. Sudirman No. 100,Pekanbaru, Riau',
                                ],
                                [
                                    'title' => 'Phone',
                                    'content' => '0812 1234 5678',
                                ],
                                [
                                    'title' => 'Email',
                                    'content' => 'support@qitchen.com',
                                ],
                            ];
                        @endphp
                        <ul class="mt-auto font-normal space-y-6">
                            @foreach ($contacts as $contact)
                                <li
                                    class="flex flex-none gap-4 flex-row h-min justify-between overflow-visible p-0 relative w-full text-light/60">
                                    <p>{{ $contact['title'] }}</p>
                                    <div class="w-1/2 text-right">
                                        <p>{{ $contact['content'] }}</p>
                                    </div>
                                </li>
                            @endforeach
                            <li
                                class="flex flex-none gap-4 flex-row h-min justify-between overflow-visible p-0 relative w-full text-light/60">
                                <p>Follow</p>
                                <div class="w-1/2 text-right">
                                    <div class="flex items-center justify-end gap-4">
                                        <a class="inline">
                                            <svg class="size-5" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 256 256">
                                                <rect width="256" height="256" fill="none" />
                                                <circle cx="128" cy="128" r="40" fill="none"
                                                    stroke="currentColor" stroke-miterlimit="10" stroke-width="16" />
                                                <rect x="32" y="32" width="192" height="192" rx="48"
                                                    fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="16" />
                                                <circle cx="180" cy="76" r="12" />
                                            </svg>
                                        </a>
                                        <a class="inline">
                                            <svg class="size-5" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 256 256">
                                                <rect width="256" height="256" fill="none" />
                                                <circle cx="128" cy="128" r="96" fill="none"
                                                    stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="16" />
                                                <path d="M168,88H152a24,24,0,0,0-24,24V224" fill="none"
                                                    stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="16" />
                                                <line x1="96" y1="144" x2="160" y2="144"
                                                    fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="16" />
                                            </svg>
                                        </a>
                                        <a class="inline">
                                            <svg class="size-5" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 256 256">
                                                <rect width="256" height="256" fill="none" />
                                                <polygon points="48 40 96 40 208 216 160 216 48 40" fill="none"
                                                    stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="16" />
                                                <line x1="113.88" y1="143.53" x2="48" y2="216"
                                                    fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="16" />
                                                <line x1="208" y1="40" x2="142.12" y2="112.47"
                                                    fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="16" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="w-full relative">
                @include('home.partials.footer')
            </div>
        </div>
    </section>
</x-main-layout>
