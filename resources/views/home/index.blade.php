<x-main-layout>
    <x-slot name="title">{{ $title }}</x-slot>

    <section
        class="flex items-start flex-wrap xl:flex-nowrap flex-none flex-row h-min xl:h-screen justify-start overflow-visible  relative w-full z-[1]">
        <div class="w-full xl:w-3/4 h-full p-6 xl:pr-0">
            <div class="relative overflow-hidden aspect-square md:aspect-video xl:aspect-auto xl:h-full">
                <div class="h-full relative">
                    <video src="{{ asset('assets/video-bg.mp4') }}" class="w-full h-full block object-cover rounded-2xl"
                        autoplay loop muted playsinline></video>
                    <div
                        class="absolute container bottom-8 left-1/2 -translate-x-1/2 xl:translate-x-0 xl:bottom-10 xl:left-10">
                        <p
                            class="text-[56px] leading-none text-center xl:text-left md:text-7xl lg:text-8xl xl:text-[112px] 2xl:text-9xl text-light uppercase font-forum">
                            sushi
                        </p>
                        <p
                            class="text-[56px] leading-none text-center xl:text-left md:text-7xl lg:text-8xl xl:text-[112px] 2xl:text-9xl text-light uppercase font-forum">
                            sensation
                        </p>
                    </div>
                </div>
                <div class="bg-black pl-3 pt-3 absolute bottom-0 right-0 rounded-tl-3xl hidden md:block">
                    <div class="flex items-center gap-3">
                        <a href=""
                            class="border border-borderColor rounded-full inline-flex items-center justify-center w-9 h-9">
                            <svg class="size-4 fill-light text-light" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 256 256">
                                <rect width="256" height="256" fill="none" />
                                <circle cx="128" cy="128" r="40" fill="none" stroke="currentColor"
                                    stroke-miterlimit="10" stroke-width="16" />
                                <rect x="32" y="32" width="192" height="192" rx="48" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="16" />
                                <circle cx="180" cy="76" r="12" />
                            </svg>
                        </a>
                        <a href=""
                            class="border border-borderColor rounded-full inline-flex items-center justify-center w-9 h-9">
                            <svg class="size-4 fill-light text-light" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 256 256">
                                <rect width="256" height="256" fill="none" />
                                <circle cx="128" cy="128" r="96" fill="none" stroke="currentColor"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                                <path d="M168,88H152a24,24,0,0,0-24,24V224" fill="none" stroke="currentColor"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                                <line x1="96" y1="144" x2="160" y2="144" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="16" />
                            </svg>
                        </a>
                        <a href=""
                            class="border border-borderColor rounded-full inline-flex items-center justify-center w-9 h-9">
                            <svg class="size-4 fill-light text-light" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 256 256">
                                <rect width="256" height="256" fill="none" />
                                <polygon points="48 40 96 40 208 216 160 216 48 40" fill="none" stroke="currentColor"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                                <line x1="113.88" y1="143.53" x2="48" y2="216" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="16" />
                                <line x1="208" y1="40" x2="142.12" y2="112.47" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="16" />
                            </svg>
                        </a>
                    </div>
                </div>

                @include('home.partials.navbar')
            </div>
        </div>
        <div
            class="w-full xl:w-1/4 p-6 items-start self-stretch flex flex-col md:flex-row xl:flex-col flex-nowrap gap-4 h-auto">
            <a href="{{ route('menu') }}" wire:navigate class="block relative overflow-hidden group flex-1 w-full h-full">
                <div class="relative h-full">
                    <img src="{{ asset('assets/img/1.webp') }}" class="h-full object-cover w-full rounded-2xl"
                        alt="">
                    <div class="absolute inset-0 bg-black/30 rounded-2xl group-hover:opacity-0 duration-300"></div>
                </div>
                <div class="bg-black pl-4 pt-1.5 absolute bottom-0 right-0 rounded-tl-3xl">
                    <div class="inline-flex items-center">
                        <span class="uppercase font-forum inline-block mr-3">menu</span>
                        <div
                            class="border border-borderColor group-hover:bg-[#111116] rounded-full inline-flex items-center justify-center w-9 h-9 overflow-hidden">
                            <svg class="size-4 fill-light text-light -translate-x-8 group-hover:translate-x-2 duration-300 ease-in-out"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                <rect width="256" height="256" fill="none" />
                                <line x1="40" y1="128" x2="216" y2="128" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="16" />
                                <polyline points="144 56 216 128 144 200" fill="none" stroke="currentColor"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                            </svg>
                            <svg class="size-4 fill-light text-light -translate-x-2 group-hover:translate-x-8 duration-300 ease-in-out"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                <rect width="256" height="256" fill="none" />
                                <line x1="40" y1="128" x2="216" y2="128" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="16" />
                                <polyline points="144 56 216 128 144 200" fill="none" stroke="currentColor"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                            </svg>
                        </div>
                    </div>
                </div>
            </a>
            <a href="" class="block relative overflow-hidden group flex-1 w-full h-full">
                <div class="relative h-full">
                    <img src="{{ asset('assets/img/2.webp') }}" class="h-full object-cover w-full rounded-2xl"
                        alt="">
                    <div class="absolute inset-0 bg-black/30 rounded-2xl group-hover:opacity-0 duration-300"></div>
                </div>
                <div class="bg-black pl-4 pt-1.5 absolute bottom-0 right-0 rounded-tl-3xl">
                    <div class="inline-flex items-center">
                        <span class="uppercase font-forum inline-block mr-3">reservation</span>
                        <div
                            class="border border-borderColor group-hover:bg-[#111116] rounded-full inline-flex items-center justify-center w-9 h-9 overflow-hidden">
                            <svg class="size-4 fill-light text-light -translate-x-8 group-hover:translate-x-2 duration-300 ease-in-out"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                <rect width="256" height="256" fill="none" />
                                <line x1="40" y1="128" x2="216" y2="128" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="16" />
                                <polyline points="144 56 216 128 144 200" fill="none" stroke="currentColor"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                            </svg>
                            <svg class="size-4 fill-light text-light -translate-x-2 group-hover:translate-x-8 duration-300 ease-in-out"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                <rect width="256" height="256" fill="none" />
                                <line x1="40" y1="128" x2="216" y2="128" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="16" />
                                <polyline points="144 56 216 128 144 200" fill="none" stroke="currentColor"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                            </svg>
                        </div>
                    </div>
                </div>
            </a>
            <a href="" class="block relative overflow-hidden group flex-1 w-full h-full">
                <div class="relative h-full">
                    <img src="{{ asset('assets/img/3.webp') }}" class="h-full object-cover w-full rounded-2xl"
                        alt="">
                    <div class="absolute inset-0 bg-black/30 rounded-2xl group-hover:opacity-0 duration-300"></div>
                </div>
                <div class="bg-black pl-4 pt-1.5 absolute bottom-0 right-0 rounded-tl-3xl">
                    <div class="inline-flex items-center">
                        <span class="uppercase font-forum inline-block mr-3">our restaurant</span>
                        <div
                            class="border border-borderColor group-hover:bg-[#111116] rounded-full inline-flex items-center justify-center w-9 h-9 overflow-hidden">
                            <svg class="size-4 fill-light text-light -translate-x-8 group-hover:translate-x-2 duration-300 ease-in-out"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                <rect width="256" height="256" fill="none" />
                                <line x1="40" y1="128" x2="216" y2="128" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="16" />
                                <polyline points="144 56 216 128 144 200" fill="none" stroke="currentColor"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                            </svg>
                            <svg class="size-4 fill-light text-light -translate-x-2 group-hover:translate-x-8 duration-300 ease-in-out"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                <rect width="256" height="256" fill="none" />
                                <line x1="40" y1="128" x2="216" y2="128" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="16" />
                                <polyline points="144 56 216 128 144 200" fill="none" stroke="currentColor"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                            </svg>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </section>
</x-main-layout>
