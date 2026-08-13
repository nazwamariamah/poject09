<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Detail Arsip') }}
        </h2>
    </x-slot>

    {{-- TOMBOL KEMBALI --}} 
    <div class="#">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
            <a href="{{ route('archive.list', $archives->folder_id) }}"
                class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-2 py-2 rounded-full border border-gray-200
                    shadow-lg transition-all duration-200 ease-in-out hover:bg-gray-400 hover:shadow-md active:bg-gray-300 active:scale-95">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>             
        </div>
    </div>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-md p-8 border border-gray-200">

                {{-- Header --}}
                <div class="mb-8 pb-4 border-b border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-800">Informasi Detail Arsip</h3>
                    <p class="text-sm text-gray-600 mt-1">Detail lengkap file arsip yang tersimpan pada sistem.</p>
                </div>

                {{-- Grid 2 Kolom untuk Info --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                    {{-- Nama File --}}
                    <div class="md:col-span-2">
                        <p class="text-sm font-medium text-gray-500 mb-2">Nama Arsip</p>
                        <p
                            class="text-lg font-semibold text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archives->file_name ?? '-' }}
                        </p>
                    </div>

                    {{-- Kode Klasifikasi --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Kode Klasifikasi</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archives->kode_klasifikasi ?? '-' }}
                        </p>
                    </div>

                    {{-- Indeks 1 --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Indeks 1</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archives->indeks1 ?? '-' }}
                        </p>
                    </div>

                    {{-- Indeks 2 --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Indeks 2</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archives->indeks2 ?? '-' }}
                        </p>
                    </div>

                    {{-- No Item --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">No Item</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archives->no_item ?? '-' }}
                        </p>
                    </div>

                    {{-- Uraian --}}
                    <div class="md:col-span-2">
                        <p class="text-sm font-medium text-gray-500 mb-2">Uraian</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200 min-h-[80px]">
                            {{ $archives->uraian ?? '-' }}
                        </p>
                    </div>

                    {{-- No SPBy --}}
                    <div class="md:col-span-2">
                        <p class="text-sm font-medium text-gray-500 mb-2">No SPBy</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200 min-h-[80px]">
                            {{ $archives->no_spby ?? '-' }}
                        </p>
                    </div>

                    {{-- No SPM --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">No SPM</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archives->no_spm ?? '-' }}
                        </p>
                    </div>

                    {{-- Jenis SPM --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Jenis SPM</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archives->jenis_spm ?? '-' }}
                        </p>
                    </div>

                    {{-- NO SP2D --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">No SP2D</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archives->no_sp2d ?? '-' }}
                        </p>
                    </div>

                    {{-- Nilai SP2D --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Nilai SP2D</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archives->nilai_sp2d ?? '-' }}
                        </p>
                    </div>

                    {{-- Jenis SP2D --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Jenis SP2D</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archives->jenis_sp2d ?? '-' }}
                        </p>
                    </div>

                    {{-- Tanggal SP2D --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Tanggal SP2D</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archives->tgl_sp2d ? \Carbon\Carbon::parse($archives->tgl_sp2d)->format('d F Y') : '-' }}
                        </p>
                    </div>

                    {{-- Tanggal Selesai Sp2d --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Tanggal Selesai SP2D</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archives->tgl_selesai_sp2d ? \Carbon\Carbon::parse($archives->tgl_selesai_sp2d)->format('d F Y') : '-' }}
                        </p>
                    </div>

                    {{-- Tanggal Invoice --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Tanggal Invoice</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archives->tgl_invoice ?? '-' }}
                        </p>
                    </div>

                    {{-- Tanggal Terima --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Tanggal Terima</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archives->tgl_terima ? \Carbon\Carbon::parse($archives->tgl_terima)->format('d F Y') : '-' }}
                        </p>
                    </div>       
                    
                    {{-- No Invoice --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">No Invoice</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archives->no_invoice ?? '-' }}
                        </p>
                    </div>

                    {{-- Tingkat Pertimbangan --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Tingkat Pertimbangan</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archives->tingkat_pertimbangan ?? '-' }}
                        </p>
                    </div>

                    {{-- Jumlah Halaman --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Jumlah Halaman</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archives->jumlah_halaman ? $archives->jumlah_halaman . ' lembar' : '-' }}
                        </p>
                    </div>

                    {{-- Retensi Arsip Aktif --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Retensi Arsip Aktif</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archives->retensi_arsip_aktif ? $archives->retensi_arsip_aktif . ' tahun' : '-' }}
                        </p>
                    </div>

                    {{-- Retensi Arsip Inaktif --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Retensi Arsip Inaktif</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archives->retensi_arsip_inaktif ? $archives->retensi_arsip_inaktif . ' tahun' : '-' }}
                        </p>
                    </div>

                    {{-- Nasib Akhir Arsip --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Nasib Akhir Arsip</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archives->nasib_akhir_arsip ?? '-' }}
                        </p>
                    </div>

                    {{-- Klasifikasi Keamanan --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Klasifikasi Keamanan</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archives->klasifikasi_keamanan ?? '-' }}
                        </p>
                    </div>

                    {{-- Status --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Status</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archives->status ?? '-' }}
                        </p>
                    </div>

                </div>

                {{-- File Arsip Section --}}
                <div class="pt-6 border-t border-gray-200 mb-6">
                    <p class="text-sm font-medium text-gray-500 mb-3">File Arsip</p>

                    @if ($archives->file_path)
                        <div class="p-4 bg-green-50 border border-green-200 rounded-md mb-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-green-700">File tersedia</p>
                                        <p class="text-xs text-green-600 mt-0.5">{{ basename($archives->file_path) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            {{-- Lihat --}}
                            <a href="{{ route('archive.looks', $archives->id) }}" target="_blank"
                                class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Lihat File
                            </a>

                            {{-- Download --}}
                            <a href="{{ route('file.download.archive', $archives->id) }}"
                                class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                Download
                            </a>
                        </div>
                    @else
                        <div class="p-4 bg-red-50 border border-red-200 rounded-md mb-4">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd" />
                                </svg>
                                <p class="text-sm font-medium text-red-700">File belum diupload</p>
                            </div>
                        </div>

                        {{-- Form Upload --}}
                        <form action="{{ route('archive.upload.store', $archives->id) }}" method="POST"
                            enctype="multipart/form-data" class="bg-gray-50 p-4 rounded-md border border-gray-200">
                            @csrf

                            <label class="block text-sm font-medium text-gray-700 mb-3">Upload File PDF Arsip</label>

                            <div class="flex items-center gap-3">
                                <input type="file" name="file_archive"
                                    class="flex-1 block rounded-md border border-gray-300 bg-white file:bg-indigo-600 file:text-white file:border-0 file:py-2 file:px-4 file:mr-4 file:rounded-l-md file:font-medium hover:file:bg-indigo-700 cursor-pointer transition text-sm"
                                    accept="application/pdf" required>

                                <button type="submit"
                                    class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md transition whitespace-nowrap">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    Upload
                                </button>
                            </div>
                        </form>
                    @endif
                </div>

                {{-- Keterangan --}}
                <div class="pt-6 border-t border-gray-200 mb-6">
                    <p class="text-sm font-medium text-gray-500 mb-2">Keterangan</p>
                    <div class="px-4 py-3 bg-gray-50 rounded-md border border-gray-200 text-gray-800 min-h-[80px]">
                        {{ $archives->keterangan ?? '-' }}
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    {{-- Tombol Aksi --}}
                    <div class="flex items-center gap-3">
                        {{-- Edit --}}
                        <a href="{{ route('file.edit', $archives->id) }}"
                            class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit
                        </a>

                        {{-- Hapus --}}
                        <form action="{{ route('file.destroy', $archives->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus arsip ini?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white font-medium rounded-md transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
