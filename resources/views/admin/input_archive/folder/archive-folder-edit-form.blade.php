<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Input Arsip') }}
        </h2>
    </x-slot>

    {{-- TOMBOL KEMBALI --}}
    <div class="#">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
            <a href="{{ route('rack.show', $folder->id) }}"
                class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-2 py-2 rounded-full border border-gray-200
                    shadow-lg transition-all duration-200 ease-in-out hover:bg-gray-400 hover:shadow-md active:bg-gray-300 active:scale-95">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>             
        </div>
    </div>

    <div class="py-4 min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- CARD UTAMA --}}
            <div class="overflow-hidden rounded-3xl shadow-2xl border border-gray-100 bg-white">

                {{-- HEADER GRADIENT --}}
                <div class="relative px-8 py-6 bg-gradient-to-b from-[#003A8F] to-[#002766]">
                    <div class="flex items-center gap-4">
                        <div class="w-11 h-11 bg-white/20 rounded-xl flex items-center justify-center shadow-inner">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-white">
                                Edit Folder Arsip
                            </h3>
                        </div>
                    </div>
                </div>

                {{-- FORM --}}
                <div class="p-8 sm:p-10">
                <form action="{{ route('folder.update', $folder->id) }}" method="POST" class="space-y-6">
                    @method('PUT')
                    @csrf

                    {{-- <input type="text" name="document_rack_id" id="" value="{{ $rack->id }}"
                        class="hidden"> --}}

                    {{-- Nama Folder Arsip --}}
                    <div class="group">
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                            Nama Folder Arsip
                        </label>
                        <div class="relative">
                            <input type="text" name="name" id="name" value="{{ $folder->folder_name }}"
                                class="w-full rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 px-4 text-gray-900 placeholder-gray-400"
                                placeholder="Masukkan nama folder arsip" required>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                </svg>
                            </div>
                        </div>
                        <p class="mt-2 text-xs text-gray-500">Perbarui nama folder sesuai kebutuhan</p>
                    </div>

                    {{-- <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                            Kode Folder Arsip
                        </label>
                        <input type="text" name="kode_folder" id="name" value="{{ $folder->kode_folder }}"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                            placeholder="Masukkan kode folder arsip" required>
                    </div> --}}

                    {{-- Keterangan --}}
                    <div class="group">
                        <label for="keterangan" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Deskripsi
                        </label>
                        <textarea name="deskripsi" id="keterangan" rows="2"
                            class="w-full rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 px-4 text-gray-900 placeholder-gray-400 resize-none"
                            placeholder="Masukkan deskripsi" required>{{ $folder->description }}</textarea>
                        <p class="mt-2 text-xs text-gray-500">Perbarui informasi tambahan tentang folder</p>
                    </div>

                    {{-- <div>
                        <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-1">
                            Deskripsi
                        </label>
                        <input type="text" name="deskripsi" id="keterangan" value="{{ $folder->description }}"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                            placeholder="Masukkan deskripsi" required>
                    </div> --}}

                    {{-- AKSI --}}
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4">

                        <div class="flex gap-3 w-full sm:w-auto">
                            <button type="submit"
                            class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-8 py-2.5 bg-gradient-to-r from-amber-600 to-orange-600 hover:from-amber-700 hover:to-orange-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                Update
                            </button>

                            <a href="{{ route('rack.show', $folder->id) }}"
                                class="flex-1 px-5 py-2.5 rounded-lg font-semibold text-gray-700 bg-gray-300 hover:bg-gray-400 shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition text-center">
                                Batal
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
