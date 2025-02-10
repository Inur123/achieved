<header
class="bg-blackish shadow-md"
style="
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 100;
  background-color: black;
"
>
<div class="container mx-auto px-4">
  <div class="flex items-center justify-between py-4">
    <div class="flex items-center">
        <a href="{{ url('/') }}" class="flex items-center">
            <img
                src="{{ asset('images/peta-logo.png') }}"
                alt="Peta Project Logo"
                class="h-12 mr-2"
            />
            <div class="flex items-center font-sub">
                <div class="text-3xl font-bold text-[#be2c13] mr-2">Peta</div>
                <div class="text-3xl font-bold text-white mr-2">Project</div>
            </div>
        </a>

    </div>

    <div class="md:hidden">
      <button
        id="menuBtn"
        class="text-white hover:text-redish focus:outline-none"
      >
        <svg
          id="hamburgerIcon"
          class="w-6 h-6"
          fill="none"
          stroke="currentColor"
          viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M4 6h16M4 12h16M4 18h16"
          ></path>
        </svg>
        <svg
          id="closeIcon"
          class="w-6 h-6 hidden"
          xmlns="http://www.w3.org/2000/svg"
          width="16"
          height="16"
          fill="currentColor"
          class="bi bi-x-lg"
          viewBox="0 0 16 16"
        >
          <path
            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"
          />
        </svg>
      </button>
    </div>

    <div class="hidden md:flex space-x-4">
        <a href="/" class="text-gray-300 hover:text-red-600 {{ request()->is('/') ? 'text-red-600 font-bold' : '' }}">Beranda</a>
        <a href="{{ route('berita.index') }}" class="text-gray-300 hover:text-red-600 {{ request()->is('berita*') ? 'text-red-600 font-bold' : '' }}">Berita</a>
        <a href="{{ route('opini.index') }}" class="text-gray-300 hover:text-red-600 {{ request()->is('opini*') ? 'text-red-600 font-bold' : '' }}">Opini</a>
        <a href="{{ route('podcast.index') }}" class="text-gray-300 hover:text-red-600 {{ request()->is('podcast*') ? 'text-red-600 font-bold' : '' }}">Podcast</a>
    </div>

  </div>
</div>

<div id="mobileMenu" class="hidden md:hidden bg-blackish p-4">
  <a href="" class="block text-gray-300 hover:text-redish py-2"
    >Beranda</a
  >
  <a href="{{ route('berita.index') }}" class="block text-gray-300 hover:text-redish py-2"
    >Berita</a
  >
  <a href="{{ route('opini.index') }}" class="block text-gray-300 hover:text-redish py-2">Opini</a>
  <a href="{{ route('podcast.index') }}" class="block text-gray-300 hover:text-redish py-2"
    >Podcast</a
  >
</div>
</header>
