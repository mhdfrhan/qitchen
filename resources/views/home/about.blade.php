<x-main-layout>
   <x-slot name="title">{{ $title }}</x-slot>

   <section
       class="flex items-start flex-wrap xl:flex-nowrap flex-none flex-row h-min xl:h-screen justify-start overflow-visible  relative w-full z-[1]">
       <div class="w-full xl:w-1/2 h-full p-6 xl:pr-0">
           <div class="relative overflow-hidden aspect-square md:aspect-video xl:aspect-auto xl:h-full">
               <div class="h-full relative">
                  <img src="{{ asset('assets/img/about.webp') }}" class="w-full h-full block object-cover rounded-2xl" />
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
       <div
           class="w-full xl:w-1/2 p-6 items-start self-stretch flex flex-col md:flex-row xl:flex-col flex-nowrap gap-4 h-auto">

       </div>
   </section>
</x-main-layout>
