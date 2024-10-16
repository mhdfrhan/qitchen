<x-app-layout>
   <x-slot name="title">{{ $title }}</x-slot>

   <div class="mb-8 flex items-center justify-between flex-wrap gap-3">
       <div>
           <h3 class="text-2xl font-bold">{{ $title }}</h3>
           <p class="text-neutral-500">Page for managing tables</p>
       </div>
   </div>
   <livewire:dashboard.tables.index>
</x-app-layout>
