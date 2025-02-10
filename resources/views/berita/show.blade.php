@extends('layouts.app')

@section('title', $berita->title)
@section('description', strip_tags($berita->content)) <!-- You can modify this to provide a shorter description -->
@section('image', Storage::url($berita->thumbnail))

@include('layouts.header')

<main class="container mx-auto px-4 py-8 mt-[70px]">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Konten Utama -->
        <div class="w-full lg:w-2/3">
            <!-- Gambar Utama Full Width -->
            <div class="w-full h-[400px] md:h-[500px] lg:h-[600px]">
                <img src="{{ Storage::url($berita->thumbnail) }}"
                     alt="{{ $berita->title }}"
                     class="w-full h-full object-cover rounded-lg shadow-lg">
            </div>

            <!-- Informasi Berita -->
            <div class="mt-6">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $berita->title }}</h1>

                <div class="flex items-center space-x-4 text-gray-500 text-sm mb-6">
                    <span>🖊 Penulis: <strong>{{ $berita->author->name ?? 'Anonim' }}</strong></span>
                    <span>📅 {{ $berita->created_at->format('d M Y') }}</span>
                </div>

                <!-- Konten Berita -->
                <div class="text-lg text-gray-700 leading-relaxed">
                    {!! $berita->content !!}
                </div>

                <!-- Tag Berita -->
                <div class="mt-8">
                    <h4 class="text-xl font-semibold text-gray-900 mb-2">Tags:</h4>
                    <div class="flex flex-wrap gap-2">
                        @foreach($berita->tags as $tag)
                            <span class="bg-red-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                #{{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="flex items-center space-x-3 mt-3">
                <h4 class="text-xl font-semibold text-gray-900">Bagikan:</h4>
                <a href="https://wa.me/?text={{ urlencode(url()->current()) }}" target="_blank">
                    <img src="{{ asset('images/wa.png') }}" alt="WhatsApp" class="w-10 h-10">
                </a>

            </div>



        </div>
          <!-- Bagikan ke WhatsApp -->




        <!-- Sidebar -->

            @include('layouts.sidebar')

    </div>
</main>

@include('layouts.footer')
