<x-app-layout>
    {{-- HEADER --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Daftar Rak Arsip') }}
        </h2>
    </x-slot>

    {{-- TOMBOL KEMBALI --}}
    <div class="#">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
            <a href="{{ route('year.show', $rack->category_id) }}"
                class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-2 py-2 rounded-full border border-gray-200
                    shadow-lg transition-all duration-200 ease-in-out hover:bg-gray-400 hover:shadow-md active:bg-gray-300 active:scale-95">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
        </div>
    </div>
    {{-- <<<<<<< HEAD

    <div class="py-4 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            Header Card
            <div class="relative overflow-hidden bg-white rounded-3xl shadow-xl p-8 mb-8 border border-gray-100">

                <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gradient-to-b from-[#003A8F] to-[#002766] rounded-lg flex items-center justify-center shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900">
                                Kelola Folder Arsip
                            </h3>
                            <p class="text-sm font-semibold text-gray-500">Total Folder : {{ $folders->count() }} Item</p>
                        </div>
                    </div>

                    <a href="{{ route('folder.create_with_rack', $raks->id) }}"
                        class="inline-flex items-center gap-2 px-4 py-2
                                   bg-gradient-to-r from-emerald-500 to-teal-600
                                   hover:from-emerald-600 hover:to-teal-700
                                   text-white font-medium rounded-lg
                                   shadow-lg hover:shadow-xl
                                   transform hover:-translate-y-0.5
                                   transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
======= --}}

    {{-- CONTENT --}}
    <div class="py-6 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- CARD PUTIH --}}
            <div class="bg-white rounded-xl shadow-xl border border-gray-100 p-8">

                {{-- HEADER CARD --}}
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 mb-10">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-12 h-12 bg-gradient-to-b from-[#003A8F] to-[#002766]
                                   rounded-lg flex items-center justify-center shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14
                                         a2 2 0 002-2V9
                                         a2 2 0 00-2-2h-6l-2-2H5
                                         a2 2 0 00-2 2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900">
                                Kelola Folder Arsip
                            </h3>
                            <p class="text-sm font-semibold text-gray-500">
                                Total Folder : {{ $folders->count() }} Item
                            </p>
                        </div>
                    </div>

                    {{-- TOMBOL TAMBAH --}}
                    <a href="{{ route('folder.create', $rack->id) }}"
                        class="inline-flex items-center gap-2 px-4 py-2
                               bg-gradient-to-r from-emerald-500 to-teal-600
                               hover:from-emerald-600 hover:to-teal-700
                               text-white font-medium rounded-lg
                               shadow-lg hover:shadow-xl
                               transform hover:-translate-y-0.5
                               transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Tambah Folder Arsip
                    </a>
                </div>

                {{-- DAFTAR FOLDER --}}
                @php $no = 1; @endphp

                @if ($folders->count() > 0)
                    {{-- <<<<<<< HEAD
                    <div class="mt-10 space-y-4 rounded-lg">
                        @foreach ($folders as $folder)
                        <div class="flex items-center justify-between p-4 bg-white border border-gray-400 rounded-lg
                                    shadow-sm hover:shadow-md hover:bg-gray-300 transition-all duration-200 group">

                                Bagian Klik Utama
                                <a href="{{ route('folder.show', $folder->id) }}"
                                    class="flex items-center gap-4 flex-1 group-hover:text-indigo-600">
                                    <div class="w-8 h-8 flex items-center justify-center rounded-full bg-gradient-to-b from-[#003A8F] to-[#002766] text-white font-semibold">
                                        {{ $no++ }}
                                    </div>

                                    <div class="flex justify-center">
                                        <div class="w-12 h-12 flex items-center justify-center bg-white rounded-lg border-2 border-cyan-400 group-hover:border-cyan-400 group-hover:scale-110 transition-all duration-300 shadow-md">
                                            <svg class="w-7 h-7 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                                            </svg>
                                        </div>
                                    </div>

                                    <div>
                                        <p class="text-gray-900 font-semibold text-base leading-tight">{{ $folder->folder_name }}</p>
                                        <p class="text-sm text-gray-600">Kode folder: {{ $folder->kode_folder }}</p>
                                    </div>
                                </a>

                                Tombol Aksi
                                <div class="flex items-center gap-2 ml-4">
                                    <a href="{{ route('folder.edit', $folder->id) }}"
                                        class="flex items-center justify-center bg-amber-500 hover:bg-orange-600 rounded-md p-2 transition"
                                        title="Edit">
                                        <img src="https://img.icons8.com/?size=24&id=88584&format=png&color=ffffff"
                                            alt="edit">
======= --}}
                    <div class="space-y-4">
                        @foreach ($folders as $folder)
                            @if ($folder->folder_name)
                                <div
                                    class="flex items-center justify-between p-4
                                           bg-white border border-gray-400 rounded-lg
                                           shadow-sm hover:shadow-md hover:bg-gray-300
                                           transition group">

                                    {{-- AREA KLIK --}}
                                    <a href="{{ route('archive.list', $folder->id) }}"
                                        class="flex items-center gap-4 flex-1 group-hover:text-indigo-600">
                                        <div
                                            class="w-8 h-8 flex items-center justify-center
                                                   rounded-full bg-gradient-to-b
                                                   from-[#003A8F] to-[#002766]
                                                   text-white font-semibold">
                                            {{ $no++ }}
                                        </div>
                                        <div>
                                            <p class="text-gray-900 font-semibold text-base leading-tight">
                                                {{ $folder->folder_name }}</p>
                                            <p class="text-sm text-gray-500">Kode folder: {{ $folder->kode_folder }}</p>
                                        </div>
                                    </a>

                                    {{-- AKSI --}}
                                    <div class="flex items-center gap-2 ml-4">
                                        <a href="{{ route('folder.edit', $folder->id) }}"
                                            class="p-2 bg-amber-500 hover:bg-orange-600
                                                   rounded-md transition"
                                            title="Edit">
                                            <img src="https://img.icons8.com/?size=24&id=88584&format=png&color=ffffff"
                                                alt="edit">
                                        </a>

                                        <form action="{{ route('folder.delete', $folder->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus folder ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 bg-red-500 hover:bg-red-600
                                                       rounded-md transition"
                                                title="Hapus">
                                                <img src="https://img.icons8.com/?size=24&id=43949&format=png&color=ffffff"
                                                    alt="delete">
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    {{-- <<<<<<< HEAD
                <div class="mt-10 text-center bg-white rounded-2xl shadow-md border border-gray-200 py-24">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full mb-6 shadow-inner">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                        </svg>
======= --}}
                    {{-- EMPTY STATE --}}
                    <div
                        class="text-center bg-white rounded-2xl shadow-md
                               border border-gray-200 py-24">
                        <div
                            class="inline-flex items-center justify-center
                                   w-20 h-20 rounded-full
                                   bg-gradient-to-br from-gray-100 to-gray-200
                                   shadow-inner mb-6">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14
                                         a2 2 0 002-2V9
                                         a2 2 0 00-2-2h-6l-2-2H5
                                         a2 2 0 00-2 2z" />
                            </svg>
                        </div>

                        <p class="text-xl font-semibold text-gray-700 mb-3">
                            Belum Ada Folder Arsip
                        </p>
                        <p class="text-gray-500 max-w-md mx-auto">
                            Tidak ada folder arsip yang tersedia.
                            Silakan tambahkan folder pertama untuk mulai menyimpan dokumen Anda.
                        </p>
                    </div>
                    <p class="text-xl font-semibold text-gray-700 mb-3">Belum Ada Folder Arsip</p>
                    <p class="text-gray-500 mb-8 max-w-md mx-auto">Tidak ada folder arsip yang tersedia. Silakan
                        tambahkan folder pertama untuk mulai menyimpan dokumen Anda.</p>
            </div>
            @endif
            {{-- <<<<<<< HEAD
            </div>
        </div>
======= --}}

        </div>
    </div>
    </div>
</x-app-layout>
