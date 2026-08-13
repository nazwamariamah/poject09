<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 tracking-tight">
            Input Arsip
        </h2>
    </x-slot>

    {{-- TOMBOL KEMBALI --}}
    <div class="#">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
            <a href="{{ route('admin.archive') }}"
                class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-2 py-2 rounded-full border border-gray-200
                    shadow-lg transition-all duration-200 ease-in-out hover:bg-gray-400 hover:shadow-md active:bg-gray-300 active:scale-95">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
        </div>
    </div>

    <div class="py-4 bg-gray-100 min-h-screen">
        {{-- <div class="py-6 min-h-screen"> --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-12">

            {{-- HEADER KATEGORI --}}
            <div class="bg-white/90 backdrop-blur-xl shadow-lg rounded-2xl p-6 border border-gray-200 mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-800">
                            Daftar Kategori Arsip
                        </h3>
                        <p class="text-sm text-gray-500 mt-1">
                            Kelompokkan arsip berdasarkan kategori
                        </p>
                    </div>

                    <a href="{{ route('category.list', $cabinet->id) }}"
                        class="inline-flex items-center gap-2 px-4 py-2
                                   bg-gradient-to-r from-emerald-500 to-teal-600
                                   hover:from-emerald-600 hover:to-teal-700
                                   text-white font-medium rounded-lg
                                   shadow-lg hover:shadow-xl
                                   transform hover:-translate-y-0.5
                                   transition-all duration-200">
                        <img src="https://img.icons8.com/?size=20&id=EkK2AS8KSyo0&format=png&color=ffffff"
                            class="w-5" />
                        Edit Kategori
                    </a>
                </div>
            </div>

            {{-- GRID KATEGORI --}}
            @if ($categories->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 gap-6">

                    @foreach ($categories as $category)
                        <div
                            class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-indigo-500 to-blue-500
                                    p-8 text-white shadow-lg transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">

                            {{-- HOVER GLOW --}}
                            <div class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition">
                            </div>

                            {{-- KONTEN CARD (LINK KE SHOW) --}}
                            <a href="{{ route('category.show', $category->id) }}" class="relative block">
                                <div class="flex flex-col items-center justify-center gap-4">

                                    {{-- ICON --}}
                                    <div
                                        class="w-16 h-16 flex items-center justify-center
                                                    bg-white/20 rounded-2xl
                                                    group-hover:scale-110 transition">
                                        @if ($category->url_icon)
                                            <img src="{{ $category->url_icon }}" class="w-10 h-10 object-contain">
                                        @else
                                            <span class="text-2xl">📁</span>
                                        @endif
                                    </div>

                                    {{-- TITLE --}}
                                    <p class="text-lg font-semibold text-center leading-snug">
                                        {{ $category->category_name }}
                                    </p>
                                </div>
                            </a>
                            {{-- <a href="{{ route('category.show', $category->id) }}"
                                class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-indigo-500 to-blue-500
                                    p-8 text-white shadow-lg transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">

                                HOVER GLOW
                                <div class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition">
                                </div>

                                <div class="relative flex flex-col items-center justify-center gap-4">

                                    ICON
                                    <div
                                        class="w-16 h-16 flex items-center justify-center
                                            bg-white/20 rounded-2xl
                                            group-hover:scale-110 transition">
                                        @if ($category->url_icon)
                                            <img src="{{ $category->url_icon }}" class="w-10 h-10 object-contain">
                                        @else
                                            <span class="text-2xl">📁</span>
                                        @endif
                                    </div>

                                    TITLE
                                    <p class="text-lg font-semibold text-center leading-snug">
                                        {{ $category->category_name }}
                                    </p> --}}
                        </div>
                    @endforeach

                </div>
            @else
                {{-- EMPTY STATE --}}
                <div class="text-center py-20 text-gray-500">
                    <p class="text-lg font-semibold">Belum ada kategori</p>
                    <p class="text-sm mt-1">Silakan tambahkan kategori terlebih dahulu</p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
