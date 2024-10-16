<div class="mt-6">
    <div class="mb-3">
        <ul class="flex items-center gap-x-6 mt-6">
            <li class="text-sm text-black font-semibold">
                Semua {{ $articles->count() }}
            </li>
            <li class="text-sm text-black font-semibold">
                <span>Publish </span> {{ $articles->where('is_published', 1)->count() }}
            </li>
            <li class="text-sm text-black font-semibold">
                <span>Draft</span> {{ $articles->where('is_published', 0)->count() }}
            </li>
        </ul>
    </div>
    <div class="max-w-xs mb-8 mx-auto">
        <x-text-input type="text" class="!text-black !border-neutral-300 focus:!border-black focus:!ring-black"
            wire:model.live='search' placeholder="ketik sesuatu disini..." />
    </div>
    <div class="bg-white rounded-2xl shadow-lg shadow-neutral-200 p-6">
        @empty($articles->count())
            <div class="text-center text-sm text-neutral-500">Belum ada artikel saat ini.</div>
        @else
            <div class="w-full overflow-x-auto ">
                <div class=" min-w-max mb-4">
                    <table class="divide-y divide-gray-300 w-full text-left">
                        <thead class="uppercase">
                            <tr>
                                <th scope="col" class="py-2 px-4">
                                    Image
                                </th>
                                <th scope="col" class="py-2 px-4">
                                    title
                                </th>
                                <th scope="col" class="py-2 px-4">
                                    Status
                                </th>
                                <th scope="col" class="py-2 px-4">
                                    Created At
                                </th>
                                <th scope="col" class="py-2 px-4"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $i => $article)
                                <tr>
                                    <td class="py-2 px-4">
                                        <img src="{{ asset($article->image) }}" alt="{{ $article->title }}"
                                            class="max-w-28 border rounded-lg" loading="lazy">
                                    </td>
                                    <td class="py-2 px-4">
                                        <a href="{{ route('dashboard.article.edit', $article->slug) }}" wire:navigate
                                            class="hover:underline inline-block text-wrap line-clamp-2 max-w-sm capitalize font-semibold">
                                            {{ $article->title }}
                                        </a>
                                    </td>
                                    <td class="py-2 px-4">
                                        <button type="button" wire:click='setPublish({{ $article->id }})'
                                            class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium {{ $article->is_published ? 'bg-teal-100 text-teal-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $article->is_published ? 'Publish' : 'Draft' }}
                                        </button>
                                    </td>
                                    <td class="py-2 px-4">
                                        <p>
                                            {{ $article->created_at->diffForHumans() }}
                                        </p>
                                    </td>
                                    <td class="py-2 px-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('dashboard.article.edit', $article->slug) }}" wire:navigate>
                                                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                                    <rect width="256" height="256" fill="none" />
                                                    <path
                                                        d="M92.69,216H48a8,8,0,0,1-8-8V163.31a8,8,0,0,1,2.34-5.65L165.66,34.34a8,8,0,0,1,11.31,0L221.66,79a8,8,0,0,1,0,11.31L98.34,213.66A8,8,0,0,1,92.69,216Z"
                                                        fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="16" />
                                                    <line x1="136" y1="64" x2="192" y2="120"
                                                        fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="16" />
                                                </svg>
                                            </a>
                                            <button type="button" wire:click='setDelete("{{ $article->slug }}")' wire:key='delete-{{ $i + 1 }}'>
                                                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                                    <rect width="256" height="256" fill="none" />
                                                    <line x1="216" y1="56" x2="40" y2="56"
                                                        fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="16" />
                                                    <line x1="104" y1="104" x2="104" y2="168"
                                                        fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="16" />
                                                    <line x1="152" y1="104" x2="152" y2="168"
                                                        fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="16" />
                                                    <path d="M200,56V208a8,8,0,0,1-8,8H64a8,8,0,0,1-8-8V56" fill="none"
                                                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="16" />
                                                    <path d="M168,56V40a16,16,0,0,0-16-16H104A16,16,0,0,0,88,40V56"
                                                        fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endempty

        {{ $articles->links() }}
    </div>

    <x-modal name="delete-article" :show="$errors->isNotEmpty()" max-width="lg">
        @if ($selectedDeleteSlug)
            <div class="p-6">
                <div class=" flex justify-end">
                    <div>
                        <div class="w-8 h-8 inline-flex items-center justify-center rounded-full text-neutral-400 hover:text-light hover:bg-neutral-700/80 duration-300 cursor-pointer"
                            x-on:click="$dispatch('close')">
                            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                <rect width="256" height="256" fill="none" />
                                <line x1="200" y1="56" x2="56" y2="200"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="16" />
                                <line x1="200" y1="200" x2="56" y2="56"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="16" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-2">
                    <svg class="size-28 text-red-500 fill-red-500 mx-auto" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 256 256">
                        <rect width="256" height="256" fill="none" />
                        <circle cx="128" cy="128" r="96" fill="none" stroke="currentColor"
                            stroke-miterlimit="10" stroke-width="16" />
                        <line x1="128" y1="136" x2="128" y2="80" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="16" />
                        <circle cx="128" cy="172" r="12" />
                    </svg>

                    <h2 class="text-3xl font-medium text-light  mt-2">
                        {{ __('Delete Article') }}
                    </h2>

                    <p class="mt-1 text-sm text-neutral-400">
                        {{ __('Are you sure you want to delete this article?') }}
                    </p>
                    <x-danger-button class="mt-6  mb-4" wire:click='deleteArticle' x-on:click="$dispatch('close')">
                        Delete Menu
                    </x-danger-button>
                </div>
            </div>
        @endif
    </x-modal>
</div>
