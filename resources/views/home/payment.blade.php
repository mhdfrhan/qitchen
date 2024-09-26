<x-main-layout>
   <x-slot name="title">{{ $title }}</x-slot>

   <x-alert />
   <section
       class="flex items-start flex-wrap xl:flex-nowrap flex-none flex-row h-min xl:h-screen justify-start overflow-visible  relative w-full z-[1]">
       <div class="w-full xl:w-1/2 h-full p-6 xl:pr-0">
           <div class="relative overflow-hidden aspect-square md:aspect-video xl:aspect-auto xl:h-full">
               <div class="h-full relative">
                   <img src="{{ asset('assets/img/cart.webp') }}" loading="lazy"
                       class="w-full h-full block object-cover rounded-2xl" />
                   <div
                       class="absolute container bottom-8 left-1/2 -translate-x-1/2 xl:translate-x-0 xl:bottom-10 xl:left-10">
                       <p
                           class="text-[56px] leading-none text-center xl:text-left md:text-7xl lg:text-8xl xl:text-[112px] 2xl:text-9xl text-light uppercase font-forum">
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
               <div class="h-full overflow-auto scrollbar-thin xl:pr-6 scrollbar-thumb-light scrollbar-track-black z-10">
                   <div class="pt-10">
                       <div class="mb-8 w-full max-w-2xl mx-auto">
                           <a href="{{ route('reservation') }}" wire:navigate
                               class="inline-flex items-center gap-3 border-b border-transparent hover:border-light duration-300">
                               <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                   <rect width="256" height="256" fill="none" />
                                   <line x1="216" y1="128" x2="40" y2="128" fill="none"
                                       stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                       stroke-width="16" />
                                   <polyline points="112 56 40 128 112 200" fill="none" stroke="currentColor"
                                       stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                               </svg>

                               <span>Back</span>
                           </a>
                           <div class="mt-8">
                               <h1 class="text-3xl font-forum uppercase font-bold text-center">{{ $title }}</h1>
                               <livewire:home.payment.index :carts="$carts" :reservation="$reservation" />
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </section>
</x-main-layout>
