<div class="max-w-2xl mx-auto px-6">
    <div class="w-full mb-14">
        <div class="flex items-center justify-center gap-5 mb-6">
            <svg width="30" height="13" viewBox="0 0 30 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                <line x1="12" y1="6.5" x2="30" y2="6.5" stroke="#333330" />
                <rect x="6.5" y="0.48954" width="8.5" height="8.5" transform="rotate(45 6.5 0.48954)"
                    stroke="#333330" stroke-width="0.5" />
            </svg>
            <h2 class="text-3xl font-semibold text-center font-forum uppercase">Latest News</h2>
            <svg width="30" height="13" viewBox="0 0 30 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                <line x1="18.1362" y1="6.49988" x2="0.13623" y2="6.49988" stroke="#333330" />
                <rect x="23.6362" y="12.5103" width="8.5" height="8.5" transform="rotate(-135 23.6362 12.5103)"
                    stroke="#333330" stroke-width="0.5" />
            </svg>
        </div>
    </div>
    <div>
        @foreach ($articles as $article)
            <a href="{{ route('articles.detail', $article->slug) }}" wire:navigate
                class="w-full flex flex-wrap items-center -mx-4 mb-6 last:mb-0">
                <div class="w-full sm:w-1/3 xl:w-1/2 px-4">
                    <div class="flex items-start gap-3 w-full">
                        <div>
                            <img src="{{ asset($article->image) }}" alt="{{ $article->title }}"
                                class="rounded-2xl w-full max-h-56 h-full object-cover" loading="lazy">
                        </div>
                    </div>
                </div>
                <div class="w-full sm:w-2/3 xl:w-1/2 px-4">
                    <div class="">
                        <p class="font-forum uppercase tracking-wide font-medium">
                            {{ $article->created_at->format('M d, Y') }}
                        </p>
                        <h1 class="text-[22px] font-semibold mt-1 font-forum uppercase line-clamp-3 leading-tight">
                            {{ $article->title }}</h1>
                        <p class="text-textColor/70 mt-2 line-clamp-3">
                            {{ Str::limit(strip_tags(preg_replace('/&nbsp;/', ' ', $article->body)), 100) }}
                        </p>
                    </div>
                </div>
            </a>
        @endforeach

        {{ $articles->links() }}
    </div>
</div>
