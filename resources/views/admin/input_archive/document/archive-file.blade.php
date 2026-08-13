<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 tracking-tight">
            {{ __('Daftar File Arsip') }}
        </h2>
    </x-slot>

    {{-- TOMBOL KEMBALI --}}
    <div class="#">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
            <a href="{{ route('rack.show', $folder->id) }}"
                class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-2 py-2 rounded-full border border-gray-200
                    shadow-lg transition-all duration-200 ease-in-out hover:bg-gray-400 hover:shadow-md active:bg-gray-300 active:scale-95">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
        </div>
    </div>

    <div class="py-4 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header Card --}}
            <div class="relative overflow-hidden bg-white rounded-3xl shadow-xl p-8 mb-8 border border-gray-100">

                <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-12 h-12 bg-gradient-to-b from-[#003A8F] to-[#002766] rounded-lg flex items-center justify-center shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">
                                Kelola File Arsip
                            </h3>

                            <p class="text-sm font-semibold text-gray-500">Total Arsip : {{ $archives->count() }}</p>
                        </div>
                    </div>

                    <a href="{{ route('file.create_with_folder', $folder->id) }}"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700
                                text-white font-medium rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                        <img src="https://img.icons8.com/?size=24&id=48427&format=png&color=ffffff" alt="plus">
                        Tambah File Arsip
                    </a>
                </div>


                {{-- Daftar File --}}
                {{-- @if ($files->count() > 0)
                    <div class="mt-10 space-y-4 rounded-lg">
                        @php $no = 1; @endphp
                        @foreach ($files as $file)
                            <div
                                class="flex items-center justify-between p-4 bg-white border border-gray-400 rounded-lg
                                shadow-sm hover:shadow-md hover:bg-gray-300 transition-all duration-200 group"> --}}

                                {{-- <<<<<<< HEAD
                        KIRI: NOMOR + INFO FILE
                        <a href="{{ route('file.show', $file->id) }}"
                        class="flex items-center gap-4 flex-1 min-w-0">

                            Nomor
                            <div class="w-8 h-8 flex items-center justify-center rounded-full bg-gradient-to-b from-[#003A8F] to-[#002766] text-white font-semibold">
                                {{ $no++ }}
                            </div>

                            Icon
                            <div
                                class="w-12 h-12 flex items-center justify-center
                                    rounded-lg border
                                    {{ $file->path_file == null ? 'border-red-200 bg-red-50' : 'border-green-200 bg-green-50' }}">
                                @if ($file->path_file == null)
                                    <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                @else
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                @endif
                            </div>

                            Info File
                            <div class="min-w-0">
                                <p class="text-base font-semibold text-gray-900 group-hover:text-indigo-600 truncate">
                                    {{ $file->name_file }}
                                </p>
                                <div class="flex items-center gap-2 mt-1">
                                    @if ($file->path_file == null)
                                        <span
                                            class="inline-flex items-center gap-1 px-2 py-0.5
                                                bg-red-50 text-red-700 text-xs font-semibold
                                                rounded-md border border-red-200">
                                            Belum Upload
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1 px-2 py-0.5
                                                bg-green-50 text-green-700 text-xs font-semibold
                                                rounded-md border border-green-200">
                                            Tersedia
                                        </span>
                                    @endif
======= --}}
                                @if ($archives->count() > 0)
                                    <div class="mt-10 space-y-4">
                                        @php $no = 1; @endphp

                                        @foreach ($archives as $archive)
                                            <div
                                                class="flex items-center justify-between p-4 bg-white border border-gray-300 rounded-lg
                    shadow-sm hover:shadow-md hover:bg-gray-100 transition">

                                                {{-- Klik Utama --}}
                                                <a href="{{ route('file.show', $archive->id) }}"
                                                    class="flex items-center gap-4 flex-1 min-w-0">

                                                    <div
                                                        class="w-8 h-8 flex items-center justify-center rounded-full
                            bg-gradient-to-b from-[#003A8F] to-[#002766]
                            text-white font-semibold">
                                                        {{ $no++ }}
                                                    </div>

                                                    <div class="min-w-0">
                                                        <p class="font-semibold text-gray-900 truncate">
                                                            {{ $archive->file_name }}
                                                        </p>

                                                        @if ($archive->file_path)
                                                            <span
                                                                class="text-xs text-green-600 font-semibold">Tersedia</span>
                                                        @else
                                                            <span class="text-xs text-red-500 font-semibold">Belum
                                                                Upload</span>
                                                        @endif
                                                    </div>
                                                </a>

                                                {{-- Aksi --}}
                                                <div class="flex gap-2 ml-4">
                                                    <a href="{{ route('file.edit', $archive->id) }}"
                                                        class="bg-amber-500 hover:bg-amber-600 p-2 rounded-lg">
                                                        <img
                                                            src="https://img.icons8.com/?size=24&id=88584&format=png&color=ffffff">
                                                    </a>

                                                    <form action="{{ route('file.destroy', $archive->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Yakin hapus file ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="bg-red-500 hover:bg-red-600 p-2 rounded-lg">
                                                            <img
                                                                src="https://img.icons8.com/?size=24&id=43949&format=png&color=ffffff">
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="mt-16 text-center text-gray-500">
                                        Belum ada file arsip
                                    </div>
                                @endif
                            </div>
                    </div>
            </div>
</x-app-layout>
