<x-app-layout>
   <x-slot name="title">{{ $title }}</x-slot>

   <x-alert />
   <div class="mb-8 flex items-center justify-between flex-wrap gap-3">
       <div>
           <h3 class="text-2xl font-bold">{{ $title }}</h3>
           <p class="text-neutral-500">Page for managing articles</p>
       </div>
       <a href="{{ route('dashboard.article.create') }}" wire:navigate>
           <x-dark-button>Add article</x-dark-button>
       </a>
   </div>

   <livewire:dashboard.articles.index>
</x-app-layout>
