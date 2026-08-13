<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl tracking-tight">
            {{ __('Input Arsip') }}
        </h2>
    </x-slot>

    {{-- TOMBOL KEMBALI --}}
    <div class="#">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
            <a href="{{ route('category.show', $category->id) }}"
                class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-2 py-2 rounded-full border border-gray-200
                    shadow-lg transition-all duration-200 ease-in-out hover:bg-gray-400 hover:shadow-md active:bg-gray-300 active:scale-95">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>             
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- CARD UTAMA --}}
            <div class="bg-white rounded-xl shadow-2xl overflow-hidden border border-gray-100">

                {{-- HEADER CARD MENYATU --}}
                <div class="relative px-6 py-5 bg-gradient-to-b from-[#003A8F] to-[#002766]">
                    <div class="absolute inset-0 bg-black/10"></div>

                    <div class="relative flex items-center gap-4">
                        <div class="w-11 h-11 bg-white/20 backdrop-blur rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-white">
                                Tambah Tahun Baru
                            </h3>
                            <p class="text-sm text-indigo-200">
                                Mengelompokkan arsip berdasarkan tahun
                            </p>
                        </div>
                    </div>
                </div>

                {{-- FORM --}}
                <div class="p-6 sm:p-10">
                    <form action="{{ route('year.store', $category->id) }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="text" name="category_id" value="{{ $category->id }}" class="hidden">
                        {{-- INPUT TAHUN --}}
                        <div>
                            <label for="year" class="block text-base font-semibold text-gray-800">
                                    Masukkan Tahun
                                </label>

                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <input type="number" name="year" id="year"
                                    min="1900" max="2100" value="{{ date('Y') }}"
                                    class="w-full rounded-xl border-2 border-gray-200 focus:border-indigo-600
                                    focus:ring-4 focus:ring-indigo-100 pl-14 pr-4 py-3 text-lg font-semibold
                                    text-gray-900 transition"
                                    placeholder="2025" required>
                            </div>

                            <p class="mt-2 text-xs text-gray-500">
                                Pastikan tahun sesuai dengan dokumen arsip
                            </p>
                        </div>

                        {{-- AKSI --}}
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4">
                            <div class="flex items-center gap-2 text-sm text-gray-500">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                                Data akan tersimpan dengan aman
                            </div>

                            <button type="submit"
                                class="inline-flex items-center gap-2 px-5 py-2.5
                                bg-gradient-to-r from-green-600 to-emerald-600
                                hover:from-green-700 hover:to-emerald-700
                                text-white font-semibold rounded-xl shadow-lg
                                hover:shadow-xl hover:-translate-y-0.5 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"/>
                                </svg>
                                Tambahkan Tahun
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
