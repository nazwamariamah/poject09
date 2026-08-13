<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Input Arsip') }}
        </h2>
    </x-slot>

    {{-- TOMBOL KEMBALI --}}
    <div class="#">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
            <a href="{{ route('year.show', $category->id) }}"
                class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-2 py-2 rounded-full border border-gray-200
                    shadow-lg transition-all duration-200 ease-in-out hover:bg-gray-400 hover:shadow-md active:bg-gray-300 active:scale-95">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>             
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="py-6 bg-gradient-to-br from-slate-50 to-emerald-50 min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- CARD UTAMA --}}
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">

                {{-- HEADER MENYATU --}}
                <div class="relative px-6 py-5 bg-gradient-to-b from-[#003A8F] to-[#002766]">
                    <div class="absolute inset-0 bg-black/10"></div>

                    <div class="relative flex items-center gap-4">
                        <div class="w-11 h-11 bg-white/20 backdrop-blur rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-white">
                                Tambah Rak Arsip Baru
                            </h3>
                            <p class="text-sm text-emerald-100">
                                Tentukan lokasi penyimpanan arsip
                            </p>
                        </div>
                    </div>
                </div>

                {{-- FORM --}}
                <div class="p-6 sm:p-10">
                    <form action="{{ route('rack.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <input type="text" value="{{ $category->id }}" name="year_id" class="hidden">

                        {{-- NAMA RAK --}}
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                                Nama Rak Arsip
                            </label>
                            <input type="text" name="name"
                                class="w-full rounded-lg border-2 border-gray-200
                                focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100
                                px-4 py-3 transition"
                                placeholder="Masukkan nama rak arsip dan angka / Nomor rak contoh Rak 1" required>
                        </div>

                        {{-- Kode Rak
                        <div>
                            <label for="kode_rack" class="block text-sm font-medium text-gray-700 mb-1">
                                Kode Rak Arsip
                            </label>
                            <input type="text" name="kode_rack" id="kode_rack"
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                                placeholder="Masukkan kode rak" required>
                        </div>

                        Keterangan
                        <div>
                            <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-1">
                                Keterangan
                            </label>
                            <input type="text" name="keterangan" id="keterangan"
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                                placeholder="Masukkan keterangan" required>
                        </div> --}}

                        {{-- AKSI --}}
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4">
                            <div class="flex items-center gap-2 text-sm text-gray-500">
                                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4"/>
                                </svg>
                                Semua field wajib diisi
                            </div>

                            <div class="flex gap-3 w-full sm:w-auto">
                                <button type="submit"
                                    class="flex-1 px-8 py-2.5 rounded-lg text-white font-semibold
                                           bg-gradient-to-r from-green-600 to-emerald-600
                                           shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition">
                                    Simpan
                                </button>

                                <a href="{{ route('year.show', $category->id) }}"
                                    class="flex-1 px-5 py-2.5 rounded-lg font-semibold text-gray-700
                                      bg-gray-300 hover:bg-gray-400 shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition text-center">
                                    Batal
                                </a>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</x-app-layout>
