@extends('layouts.app')
<!-- ===== Header Start ===== -->
@section('title', 'Berita')

@include('layouts.header')




<main class="container mx-auto px-4 py-8 mt-[70px]">
    <h4 class="text-3xl font-bold text-red-600 mb-5">Berita</h4>
    <div class="flex flex-col lg:flex-row gap-8">

        <!-- Left Column (Main Content) -->
        <div class="w-full lg:w-2/3">

            <!-- News Grid -->
            @if ($berita->isEmpty())
            <p class="text-center text-gray-500">Tidak ada berita.</p>
            @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                @foreach($berita as $item)
                <a href="{{ route('berita.show', $item->slug) }}" class="block">
                    <div
                        class="bg-white border border-gray-300 rounded-lg shadow-md overflow-hidden flex flex-col relative hover:border-red-600 transition-all duration-300">
                        <img src="{{ Storage::url($item->thumbnail) }}" alt="News Item" class="w-full h-48 object-cover" />
                        <div class="absolute top-2 right-2 bg-red-600 text-white px-2 py-1 rounded-full">
                            <span class="text-xs">{{ $item->category->name }}</span>
                        </div>
                        <div class="p-4 flex-grow">
                            <div class="flex items-center justify-between mb-2">
                                <div>
                                    <span class="text-gray-500 text-xs">Penulis: {{ $item->author->name ?? 'Anonim' }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-500 text-xs">{{ $item->created_at->format('d M Y') }}</span>
                                </div>
                            </div>
                            <h3 class="font-bold mb-2">{{ $item->title }}</h3>
                            <p class="text-gray-600 text-sm">
                                {{ Str::limit(strip_tags($item->excerpt), 100) }}
                            </p>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            @endif
        </div>

        <!-- Right Column (Sidebar) -->
        @include('layouts.sidebar')
    </div>
</main>
@include('layouts.footer')
