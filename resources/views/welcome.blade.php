@extends('layouts.app')
<!-- ===== Header Start ===== -->
@section('title', 'Beranda')

@include('layouts.header')




<main class="container mx-auto px-4 py-8" style="margin-top: 50px">
    <div class="overflow-hidden flex lg:flex-row-reverse flex-col mb-8 mt-10" data-aos="zoom-in">
        <img src="images/login.png" alt="Gambar Utama"
            class="w-full lg:w-1/2 h-96 object-cover rounded-lg hidden lg:block" />
        <div class="lg:w-1/2 me-5"
            style="
        background-image: url('images/indo1.svg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-size: 600px;
      ">
            <h1 class="text-4xl font-bold mb-2">Peta Project</h1>
            <p class="text-gray-600 text-justify mb-8">
                Podcast dan Talkshow yang memiliki visi menjadi sumber cahaya yang
                menerangi kompleksitas sosial, politik, hukum dan isu-isu terkini.
                Peta project hadir sebagai media education dalam melakukan transfer
                of knowladge, transfer of tools, opinion making dan paradigma
                shifting.
            </p>
            <p class="text-black font-bold text-justify">
                Call us (0123) 456 - 789
            </p>
            <p class="text-gray-600 text-justify">For any question or concern</p>
        </div>
    </div>
    <div class="bg-red-800 py-2 mb-4 rounded-lg">
        <div class="container mx-auto px-4">
            <p class="breaking-news text-sm font-bold text-white transition duration-500 ease-in-out">
                BREAKING NEWS: <span id="changing-text"></span>
            </p>
        </div>
    </div>
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Left Column (Main Content) -->
        <div class="w-full lg:w-2/3">
            <!-- News Grid -->
            <h2 class="text-xl font-bold mb-4 text-red-600">Terkini</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                @foreach ($post_terkini as $berita)
                    @php
                        // Menentukan route berdasarkan kategori
                        $routeName = match ($berita->category->name) {
                            'Berita' => 'berita.show',
                            'Podcast' => 'podcast.show',
                            'Opini' => 'opini.show', // Default jika kategori tidak dikenal
                        };
                    @endphp
                    <a href="{{ route($routeName, $berita->slug) }}" class="block">
                        <div
                            class="bg-white border border-gray-300 rounded-lg shadow-md overflow-hidden flex flex-col relative hover:border-red-600 transition-all duration-300">
                            <img src="{{ Storage::url($berita->thumbnail) }}" alt="{{ $berita->title }}"
                                class="w-full h-48 object-cover" />
                            <div class="absolute top-2 right-2 bg-red-600 text-white px-2 py-1 rounded-full">
                                <span class="text-xs">{{ $berita->category->name ?? 'Uncategorized' }}</span>
                            </div>
                            <div class="p-4 flex-grow">
                                <div class="flex items-center justify-between mb-2">
                                    <div>
                                        <span class="text-gray-500 text-xs">Penulis:
                                            {{ $berita->author->name ?? 'Anonim' }}</span>
                                    </div>
                                    <div>
                                        <span
                                            class="text-gray-500 text-xs">{{ $berita->created_at->format('d M Y') }}</span>
                                    </div>
                                </div>
                                <h3 class="font-bold mb-2">{{ $berita->title }}</h3>
                                <p class="text-gray-600 text-sm">
                                    {{ Str::limit(strip_tags($berita->content), 100, '...') }}
                                </p>
                            </div>
                        </div>
                    </a>
                @endforeach
                <!-- Repeat for other news items -->
            </div>

            <!-- Category Sections -->
            <div class="space-y-8">
                <!-- News Category -->
                <div>
                    <h2 class="text-xl font-bold mb-4 text-red-600">Berita</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Repeat news items here -->
                        @foreach ($berita_terkini as $berita)
                            <a href="{{ route('berita.show', $berita->slug) }}" class="block">
                                <div
                                    class="bg-white border border-gray-300 rounded-lg shadow-md overflow-hidden flex flex-col relative hover:border-red-600 transition-all duration-300">
                                    <img src="{{ Storage::url($berita->thumbnail) }}" alt="{{ $berita->title }}"
                                        class="w-full h-48 object-cover" />
                                    <div class="absolute top-2 right-2 bg-red-600 text-white px-2 py-1 rounded-full">
                                        <span class="text-xs">{{ $berita->category->name ?? 'Uncategorized' }}</span>
                                    </div>
                                    <div class="p-4 flex-grow">
                                        <div class="flex items-center justify-between mb-2">
                                            <div>
                                                <span class="text-gray-500 text-xs">Penulis:
                                                    {{ $berita->author->name ?? 'Anonim' }}</span>
                                            </div>
                                            <div>
                                                <span
                                                    class="text-gray-500 text-xs">{{ $berita->created_at->format('d M Y') }}</span>
                                            </div>
                                        </div>
                                        <h3 class="font-bold mb-2">{{ $berita->title }}</h3>
                                        <p class="text-gray-600 text-sm">
                                            {{ Str::limit(strip_tags($berita->content), 100, '...') }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Opini Category -->
                <div>
                    <h2 class="text-xl font-bold mb-4 text-red-600">Opini</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Repeat opinion items here -->
                        @foreach ($opini_terkini as $berita)
                            <a href="{{ route('opini.show', $berita->slug) }}" class="block">
                                <div
                                    class="bg-white border border-gray-300 rounded-lg shadow-md overflow-hidden flex flex-col relative hover:border-red-600 transition-all duration-300">
                                    <img src="{{ Storage::url($berita->thumbnail) }}" alt="{{ $berita->title }}"
                                        class="w-full h-48 object-cover" />
                                    <div class="absolute top-2 right-2 bg-red-600 text-white px-2 py-1 rounded-full">
                                        <span class="text-xs">{{ $berita->category->name ?? 'Uncategorized' }}</span>
                                    </div>
                                    <div class="p-4 flex-grow">
                                        <div class="flex items-center justify-between mb-2">
                                            <div>
                                                <span class="text-gray-500 text-xs">Penulis:
                                                    {{ $berita->author->name ?? 'Anonim' }}</span>
                                            </div>
                                            <div>
                                                <span
                                                    class="text-gray-500 text-xs">{{ $berita->created_at->format('d M Y') }}</span>
                                            </div>
                                        </div>
                                        <h3 class="font-bold mb-2">{{ $berita->title }}</h3>
                                        <p class="text-gray-600 text-sm">
                                            {{ Str::limit(strip_tags($berita->content), 100, '...') }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Podcast Category -->
                <div>
                    <h2 class="text-xl font-bold mb-4 text-red-600">Podcast</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Repeat podcast items here -->
                        @foreach ($podcast_terkini as $berita)
                            <a href="{{ route('podcast.show', $berita->slug) }}" class="block">
                                <div
                                    class="bg-white border border-gray-300 rounded-lg shadow-md overflow-hidden flex flex-col relative hover:border-red-600 transition-all duration-300">
                                    <img src="{{ Storage::url($berita->thumbnail) }}" alt="{{ $berita->title }}"
                                        class="w-full h-48 object-cover" />
                                    <div class="absolute top-2 right-2 bg-red-600 text-white px-2 py-1 rounded-full">
                                        <span class="text-xs">{{ $berita->category->name ?? 'Uncategorized' }}</span>
                                    </div>
                                    <div class="p-4 flex-grow">
                                        <div class="flex items-center justify-between mb-2">
                                            <div>
                                                <span class="text-gray-500 text-xs">Penulis:
                                                    {{ $berita->author->name ?? 'Anonim' }}</span>
                                            </div>
                                            <div>
                                                <span
                                                    class="text-gray-500 text-xs">{{ $berita->created_at->format('d M Y') }}</span>
                                            </div>
                                        </div>
                                        <h3 class="font-bold mb-2">{{ $berita->title }}</h3>
                                        <p class="text-gray-600 text-sm">
                                            {{ Str::limit(strip_tags($berita->content), 100, '...') }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column (Sidebar) -->
        @include('layouts.sidebar')
    </div>
</main>

<script>
    const changingText = document.getElementById("changing-text");
    const messages = @json($messages); // Ambil dari PHP ke JavaScript
    let currentMessageIndex = 0;

    function changeMessage() {
        changingText.style.opacity = 0; // Fade out

        setTimeout(() => {
            changingText.textContent = messages[currentMessageIndex] || "Tidak ada berita terbaru";
            changingText.style.opacity = 1; // Fade in

            currentMessageIndex = (currentMessageIndex + 1) % messages.length;
        }, 500);
    }

    if (messages.length > 0) {
        changingText.textContent = messages[0];
        changingText.style.opacity = 1;
        setInterval(changeMessage, 3000);
    } else {
        changingText.textContent = "Tidak ada berita terbaru";
    }
</script>

@include('layouts.footer')
