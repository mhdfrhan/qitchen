<x-main-layout>
    @push('styles')
        {{-- splide js --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
        <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    @endpush
    @push('scripts')
        <script data-navigate-once>
            document.addEventListener('livewire:navigated', function() {
                if (document.getElementById('about-carousel')) {
                    new Splide('#about-carousel', {
                        type: 'loop',
                        height: '100%',
                        interval: 5000,
                        speed: 1000,
                        autoplay: "play",
                        pagination: false,
                        gap: '30px',
                    }).mount();
                }

                if (document.getElementById('our-story-carousel')) {
                    new Splide('#our-story-carousel', {
                        type: 'loop',
                        height: '100%',
                        interval: 5000,
                        speed: 1000,
                        autoplay: "play",
                        pagination: false,
                        gap: '30px',
                    }).mount();
                }
            });
        </script>
    @endpush
    <x-slot name="title">{{ $title }}</x-slot>

    <section
        class="flex items-start flex-wrap xl:flex-nowrap flex-none flex-row h-min xl:h-screen justify-start overflow-visible  relative w-full z-[1]">
        <div class="w-full xl:w-1/2 h-full p-6 xl:pr-0">
            <div class="relative overflow-hidden aspect-square md:aspect-video xl:aspect-auto xl:h-full">
                <div class="h-full relative">
                    <img src="{{ asset('assets/img/about.webp') }}"
                        class="w-full h-full block object-cover rounded-2xl" />
                    <div class="absolute inset-0 bg-black/30"></div>
                    <div
                        class="absolute container bottom-8 left-1/2 -translate-x-1/2 xl:translate-x-0 xl:bottom-10 xl:left-10">
                        <p
                            class="text-[56px] leading-none text-center xl:text-left md:text-7xl lg:text-8xl xl:text-[112px] 2xl:text-9xl text-light uppercase font-forum">
                            about
                        </p>
                    </div>
                </div>

                @include('home.partials.navbar')
            </div>
        </div>
        <div class="w-full xl:w-1/2 pt-0 md:pt-6 p-6 items-start md:self-stretch flex flex-col flex-nowrap gap-4 h-auto">
            <div class="flex flex-wrap w-full items-stretch md:h-full mb-2 md:mb-0">
                <div class="w-full md:w-[60%] overflow-hidden md:h-full md:pr-4 mb-6 md:mb-0">
                    <div
                        class="relative overflow-hidden border border-borderColor p-12 h-full w-full rounded-2xl flex flex-col items-stretch">
                        <h1 class="font-forum text-3xl uppercase font-semibold tracking-wider">Sushi Artistry Redefined
                        </h1>
                        <p class="mt-4 md:mt-auto text-light/80 font-normal">Where culinary craftsmanship meets modern elegance.
                            Indulge in the finest sushi, expertly curated to elevate your dining experience.</p>
                        <div class="absolute inset-0 z-[-1] opacity-20">
                            <img src="{{ asset('assets/img/bg-black.webp') }}" alt="" class=" w-full h-full">
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-[40%]">
                    <div id="about-carousel" class="splide  h-full" aria-label="About Us">
                        <div class="splide__track h-full rounded-2xl overflow-hidden">
                            <ul class="splide__list">
                                @for ($i = 0; $i < 4; $i++)
                                    <li class="splide__slide">
                                        <img src="{{ asset('assets/img/about/' . ($i + 1) . '.jpg') }}"
                                            alt="{{ $i }}" class="w-full h-full rounded-2xl object-cover">
                                    </li>
                                @endfor
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid sm:grid-cols-3 gap-3 w-full mb-3 md:mb-0">
                <div class="w-full border border-borderColor rounded-2xl p-4">
                    <div class="flex items-center justify-center gap-1">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="size-4 fill-light/80" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                <rect width="256" height="256" fill="none" />
                                <path
                                    d="M234.29,114.85l-45,38.83L203,211.75a16.4,16.4,0,0,1-24.5,17.82L128,198.49,77.47,229.57A16.4,16.4,0,0,1,53,211.75l13.76-58.07-45-38.83A16.46,16.46,0,0,1,31.08,86l59-4.76,22.76-55.08a16.36,16.36,0,0,1,30.27,0l22.75,55.08,59,4.76a16.46,16.46,0,0,1,9.37,28.86Z" />
                            </svg>
                        @endfor
                    </div>
                    <div>
                        <h1 class="text-2xl font-forum uppercase text-center my-3 leading-none mt-4">
                            Trip Advisor
                        </h1>
                        <p class="text-textColor/70 text-center font-normal uppercase text-sm">Best Sushi</p>
                    </div>
                </div>
                <div class="w-full border border-borderColor rounded-2xl p-4">
                    <div class="flex items-center justify-center gap-1">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="size-4 fill-light/80" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                <rect width="256" height="256" fill="none" />
                                <path
                                    d="M234.29,114.85l-45,38.83L203,211.75a16.4,16.4,0,0,1-24.5,17.82L128,198.49,77.47,229.57A16.4,16.4,0,0,1,53,211.75l13.76-58.07-45-38.83A16.46,16.46,0,0,1,31.08,86l59-4.76,22.76-55.08a16.36,16.36,0,0,1,30.27,0l22.75,55.08,59,4.76a16.46,16.46,0,0,1,9.37,28.86Z" />
                            </svg>
                        @endfor
                    </div>
                    <div>
                        <h1 class="text-2xl font-forum uppercase text-center my-3 leading-none mt-4">
                            Michelin Guide
                        </h1>
                        <p class="text-textColor/70 text-center font-normal uppercase text-sm">Quality Food</p>
                    </div>
                </div>
                <div class="w-full border border-borderColor rounded-2xl p-4">
                    <div class="flex items-center justify-center gap-1">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="size-4 fill-light/80" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                <rect width="256" height="256" fill="none" />
                                <path
                                    d="M234.29,114.85l-45,38.83L203,211.75a16.4,16.4,0,0,1-24.5,17.82L128,198.49,77.47,229.57A16.4,16.4,0,0,1,53,211.75l13.76-58.07-45-38.83A16.46,16.46,0,0,1,31.08,86l59-4.76,22.76-55.08a16.36,16.36,0,0,1,30.27,0l22.75,55.08,59,4.76a16.46,16.46,0,0,1,9.37,28.86Z" />
                            </svg>
                        @endfor
                    </div>
                    <div>
                        <h1 class="text-2xl font-forum uppercase text-center my-3 leading-none mt-4">
                            Start Dining
                        </h1>
                        <p class="text-textColor/70 text-center font-normal uppercase text-sm">Cool vibe</p>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap w-full items-stretch h-full">
                <div class="w-full md:w-[45%] h-full md:pr-4  mb-6 md:mb-0">
                    <div id="our-story-carousel" class="splide  h-full" aria-label="About Us">
                        <div class="splide__track h-full rounded-2xl overflow-hidden">
                            <ul class="splide__list">
                                @for ($i = 0; $i < 3; $i++)
                                    <li class="splide__slide">
                                        <img src="{{ asset('assets/img/our-story/' . ($i + 1) . '.jpg') }}"
                                            alt="{{ $i }}" class="w-full h-full rounded-2xl object-cover">
                                    </li>
                                @endfor
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-[55%] overflow-hidden h-full">
                    <div
                        class="relative overflow-hidden border border-borderColor p-12 h-full w-full rounded-2xl flex flex-col items-stretch">
                        <div class="flex items-center justify-center gap-5 mb-6">
                            <svg width="30" height="13" viewBox="0 0 30 13" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <line x1="12" y1="6.5" x2="30" y2="6.5" stroke="#333330" />
                                <rect x="6.5" y="0.48954" width="8.5" height="8.5"
                                    transform="rotate(45 6.5 0.48954)" stroke="#333330" stroke-width="0.5" />
                            </svg>
                            <h2 class="text-2xl font-semibold text-center font-forum uppercase">Our Story</h2>
                            <svg width="30" height="13" viewBox="0 0 30 13" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <line x1="18.1362" y1="6.49988" x2="0.13623" y2="6.49988" stroke="#333330" />
                                <rect x="23.6362" y="12.5103" width="8.5" height="8.5"
                                    transform="rotate(-135 23.6362 12.5103)" stroke="#333330" stroke-width="0.5" />
                            </svg>
                        </div>
                        <p class="mt-auto text-light/80 font-normal">
                            Founded with a passion for culinary excellence, Qitchen's journey began in the heart of
                            Prague. Over years, it evolved into a haven for sushi enthusiasts, celebrated for its artful
                            mastery and devotion to redefining gastronomy.
                        </p>
                    </div>
                </div>
            </div>

            <div class="w-full">
                @include('home.partials.footer')
            </div>
        </div>
    </section>
</x-main-layout>
