<x-main-layout>
    <x-slot name="title">{{ $title }}</x-slot>

    <section class="px-4 w-full max-w-7xl mx-auto mt-14">
        <div class="mb-4">
            <a href="{{ route('home') }}" wire:navigate
                class="inline-flex items-center gap-3 border-b border-transparent hover:border-light duration-300">
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                    <rect width="256" height="256" fill="none" />
                    <line x1="216" y1="128" x2="40" y2="128" fill="none"
                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                    <polyline points="112 56 40 128 112 200" fill="none" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="16" />
                </svg>

                <span>Back</span>
            </a>
        </div>
        <div class="border border-borderColor rounded-xl p-6">
            <div class="flex flex-wrap lg:-mx-4">
                <div class="w-full lg:w-1/4 lg:px-4">
                    @include('home.partials.sidebar')
                </div>
                <div class="w-full lg:w-3/4 lg:px-4 mt-8 lg:mt-0">
                    <livewire:home.dashboard.check-phone>
                    @if (!request()->routeIs('home.dashboard') && !request()->routeIs('reservation.detail'))
                        {{-- breadcrumb --}}
                        <nav aria-label="Breadcrumb" class="mb-6">
                            <ol class="flex items-center space-x-4">
                                @foreach (request()->segments() as $index => $segment)
                                    <li class="flex items-center">
                                        @if ($index > 0)
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"
                                                class="w-4 h-4 mr-2">
                                                <rect width="256" height="256" fill="none" />
                                                <polyline points="96 48 176 128 96 208" fill="none"
                                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="22" />
                                            </svg>
                                        @endif
                                        <button
                                            class="{{ $loop->iteration == $loop->count ? 'text-light' : 'text-neutral-500' }} capitalize font-semibold">
                                            {{ str_replace('-', ' ', $segment) }}
                                        </button>
                                    </li>
                                @endforeach
                            </ol>
                        </nav>
                    @endif

                    {{ $slot }}
                </div>
            </div>
        </div>
    </section>
</x-main-layout>
