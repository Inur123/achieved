<div class="w-full lg:w-1/3">
    <!-- Popular News -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-bold mb-2">Iklan</h2>
        <ul class="space-y-4">
            <li class="flex items-center justify-center">
                <img src="{{ asset('images/peta-logo.png') }}" alt="Iklan 1" class="rounded-lg object-contain"
                    style="width: 400px; height: 400px" />
            </li>
        </ul>
    </div>
    <!-- Video Section -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-bold mb-4">Vidio Terbaru</h2>
        <div class="space-y-4">
            <div>
                <div class="h-40 mb-2">
                    <iframe src="https://www.youtube.com/embed/DXMfoLTIeoE" title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen style="height: 100%; width: 100%; border-radius: 10px"></iframe>
                </div>
            </div>
            <div>
                <div class="h-40 mb-2">
                    <iframe src="https://www.youtube.com/embed/DXMfoLTIeoE" title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen style="height: 100%; width: 100%; border-radius: 10px"></iframe>
                </div>
            </div>
            <div>
                <div class="h-40 mb-2">
                    <iframe src="https://www.youtube.com/embed/DXMfoLTIeoE" title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen style="height: 100%; width: 100%; border-radius: 10px"></iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-bold mb-4">Post Populer</h2>
        <ul class="space-y-4">
            @if ($post_populer->count() > 0)
                @foreach ($post_populer as $index => $post)
                @php
                // Tentukan route berdasarkan kategori post
                $routeName = match($post->category->name) {
                    'Berita' => 'berita.show',
                    'Podcast' => 'podcast.show',
                    'Opini' => 'opini.show',
                    // Jika kategori tidak sesuai
                };
            @endphp
                    <li class="flex items-center">
                        <img src="{{ Storage::url($post->thumbnail) }}" alt="{{ $post->title }}" class="w-10 h-10 mr-4 rounded-lg" />
                        <a href="{{ route($routeName, $post->slug) }}" class="text-sm hover:underline">
                            {{ Str::limit($post->title, 50, '...') }}
                        </a>
                    </li>
                @endforeach
            @else
                <p class="text-gray-500">Belum ada post populer.</p>
            @endif
        </ul>
    </div>



    <!-- Tag Cloud -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-bold mb-4">Tag Populer</h2>

        @php
    $allTags = \Spatie\Tags\Tag::all(); // Ambil semua tag dari database
@endphp

<div class="flex flex-wrap gap-2">
    @foreach($allTags as $tag)
        <span class="bg-gray-200 px-2 py-1 rounded-full text-sm">#{{ $tag->name }}</span>
    @endforeach
</div>

    </div>
</div>
