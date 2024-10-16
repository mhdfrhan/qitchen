<x-main-layout>
    <x-slot name="title">{{ $title }}</x-slot>

    <x-alert />

    <section
        class="flex items-start flex-wrap xl:flex-nowrap flex-none flex-row h-min xl:h-screen justify-start overflow-visible  relative w-full z-[1]">
        <div class="w-full xl:w-1/2 h-full p-6 xl:pr-0">
            <div class="relative overflow-hidden aspect-square md:aspect-video xl:aspect-auto xl:h-full">
                <div class="h-full relative">
                    <img src="{{ asset($article->image) }}" class="w-full h-full block object-cover rounded-2xl" />
                    <div
                        class="absolute container bottom-8 left-1/2 -translate-x-1/2 xl:translate-x-0 xl:bottom-10 xl:left-10">
                        <p
                            class="text-[56px] leading-none text-center xl:text-left md:text-7xl lg:text-8xl text-light uppercase font-forum">
                            {{ $title }}
                        </p>
                    </div>
                </div>

                @include('home.partials.navbar')
            </div>
        </div>
        <div
            class="w-full xl:w-1/2 p-6 items-start self-stretch flex flex-col md:flex-row xl:flex-col flex-nowrap gap-4 h-auto overflow-hidden">
            <div class="w-full border border-borderColor h-full p-5 rounded-2xl overflow-hidden relative">
                <div class="absolute inset-0 z-[-1] opacity-20">
                    <img src="{{ asset('assets/img/bg-black.webp') }}" alt="" class=" w-full h-full">
                </div>
                <div
                    class="h-full overflow-auto scrollbar-thin xl:pr-6 scrollbar-thumb-light scrollbar-track-black z-10">
                    <div class="pt-10">
                        <div class="relative max-w-2xl px-6 mx-auto">
                            <div class="flex items-center justify-center gap-5 mb-6">
                                <svg width="30" height="13" viewBox="0 0 30 13" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <line x1="12" y1="6.5" x2="30" y2="6.5"
                                        stroke="#333330" />
                                    <rect x="6.5" y="0.48954" width="8.5" height="8.5"
                                        transform="rotate(45 6.5 0.48954)" stroke="#333330" stroke-width="0.5" />
                                </svg>
                                <h2 class="font-medium text-center font-forum uppercase">
                                    {{ $article->created_at->format('M d, Y') }}</h2>
                                <svg width="30" height="13" viewBox="0 0 30 13" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <line x1="18.1362" y1="6.49988" x2="0.13623" y2="6.49988"
                                        stroke="#333330" />
                                    <rect x="23.6362" y="12.5103" width="8.5" height="8.5"
                                        transform="rotate(-135 23.6362 12.5103)" stroke="#333330" stroke-width="0.5" />
                                </svg>
                            </div>
                            <div class="mt-8">
                                <h1
                                    class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-semibold font-forum capitalize text-center !leading-none mb-8">
                                    {{ $article->title }}</h1>
                                <div class="flex justify-center">
                                    <svg width="42" height="13" viewBox="0 0 42 13" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <line x1="30.1362" y1="6.49988" x2="12.1362" y2="6.49988"
                                            stroke="#333330" />
                                        <rect x="35.6362" y="12.5103" width="8.5" height="8.5"
                                            transform="rotate(-135 35.6362 12.5103)" stroke="#333330"
                                            stroke-width="0.5" />
                                        <rect x="6.36377" y="12.3744" width="8.5" height="8.5"
                                            transform="rotate(-135 6.36377 12.3744)" stroke="#333330"
                                            stroke-width="0.5" />
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-10 article-body">
                                {!! $article->body !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-main-layout>
