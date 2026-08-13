<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Input Arsip') }}
        </h2>
    </x-slot>

    {{-- TOMBOL KEMBALI --}}
    <div>
        <a href="{{ route('rack.show', $folder->id) }}"
            class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-2 py-2 rounded-full border border-gray-200
            shadow transition-all duration-200 hover:bg-gray-200 active:scale-95">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
    </div>

    <div class="min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- CARD UTAMA (HEADER + FORM MENYATU) --}}
            <div class="bg-white rounded-xl shadow-2xl border border-gray-100 overflow-hidden">

                {{-- HEADER CARD --}}
                <div class="bg-gradient-to-b from-[#003A8F] to-[#002766] px-8 py-5">
                    <div class="flex items-center gap-4">
                        <div class="w-11 h-11 bg-white/20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-white">
                                Tambah Folder Arsip Baru
                            </h3>
                            <p class="text-sm text-blue-100">
                                Lengkapi data folder arsip dengan benar
                            </p>
                        </div>
                    </div>
                </div>

                {{-- FORM --}}
                <div class="p-8 sm:p-10">
                <form action="{{ route('folder.store', $folder->id) }}" method="POST" class="space-y-6">
                    @csrf

                    <input type="text" name="document_rack_id" id="" value="{{ $folder->id }}"
                        class="hidden">

                    {{-- Nama Folder --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Folder Arsip
                        </label>
                        <input type="text" name="name"
                            class="w-full rounded-xl border-2 border-gray-200 focus:border-emerald-500
                            focus:ring-4 focus:ring-emerald-100 px-4 py-2 transition"
                            placeholder="Masukkan nama folder arsip" required>
                    </div>
                    {{-- <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                            Kode Folder Arsip
                        </label>
                        <input type="text" name="kode_folder" id="name"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                            placeholder="Masukkan kode folder arsip" required>
                    </div> --}}

                    {{-- Deskripsi --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Deskripsi
                        </label>
                        <textarea name="deskripsi" rows="3"
                            class="w-full rounded-xl border-2 border-gray-200 focus:border-blue-500
                            focus:ring-4 focus:ring-blue-100 px-4 py-2 resize-none transition"
                            placeholder="Keterangan rentang tanggal dan bulan" required></textarea>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-4 border-t">
                        <span class="text-sm text-gray-500">
                            Semua field wajib diisi
                        </span>

                        <div class="flex gap-3 w-full sm:w-auto">
                            <button type="submit"
                                class="flex-1 px-8 py-2.5 rounded-lg text-white font-semibold bg-gradient-to-r from-green-600 to-emerald-600
                                        shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition">
                                Simpan
                            </button>

                            <a href="{{ route('rack.show', $folder->id) }}"
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
