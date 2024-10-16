<x-app-layout>
   
   <x-alert />
   
   <x-slot name="title">{{ $title }}</x-slot>

   <div class="mb-8 flex items-center justify-between flex-wrap gap-3">
       <div>
           <h3 class="text-2xl font-bold">{{ $title }}</h3>
           <p class="text-neutral-500">Create new article</p>
       </div>
   </div>

   <livewire:dashboard.articles.edit :artikel="$article">

</x-app-layout>
