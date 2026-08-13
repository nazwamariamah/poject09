<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Detail Arsip Digital') }}
        </h2>
    </x-slot>
 
    {{-- TOMBOL KEMBALI --}}
    <div class="#">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
            <a href="{{ route('year.show', $archive->category_id) }}"
                class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-2 py-2 rounded-full border border-gray-200
                    shadow-lg transition-all duration-200 ease-in-out hover:bg-gray-400 hover:shadow-md active:bg-gray-300 active:scale-95">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>             
        </div>
    </div>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-md p-8 border border-gray-200">

                {{-- Header --}}
                <div class="mb-8 pb-4 border-b border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-800">Informasi Detail Arsip Digital</h3>
                    <p class="text-sm text-gray-600 mt-1">Detail lengkap archive dan dokumen arsip digital yang tersimpan pada sistem.</p>
                </div>

                {{-- Grid 2 Kolom untuk Info --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                    {{-- Nama archive --}}
                    <div class="md:col-span-2">
                        <p class="text-sm font-medium text-gray-500 mb-2">Nama archive</p>
                        <p class="text-lg font-semibold text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archive->archive_name ?? '-' }}
                        </p>
                    </div>

                    {{-- Kode Arsip --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Kode Arsip</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archive->archive_code ?? '-' }}
                        </p>
                    </div>

                    {{-- Divisi Asal --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Divisi Asal</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archive->from_division ?? $archive->category_archive->divisi_name ?? '-' }}
                        </p>
                    </div>

                    {{-- Kode Klasifikasi --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Kode Klasifikasi</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archive->kode_klasifikasi ?? '-' }}
                        </p>
                    </div>

                    {{-- Indeks 1 --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Indeks 1</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archive->indeks1 ?? '-' }}
                        </p>
                    </div>

                    {{-- Indeks 2 --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Indeks 2</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archive->indeks2 ?? '-' }}
                        </p>
                    </div>

                    {{-- No Item --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">No Item</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archive->no_item ?? '-' }}
                        </p>
                    </div>

                    {{-- Nominal --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Nominal</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archive->nominal ? 'Rp ' . number_format($archive->nominal, 0, ',', '.') : '-' }}
                        </p>
                    </div>

                    {{-- Uraian --}}
                    <div class="md:col-span-2">
                        <p class="text-sm font-medium text-gray-500 mb-2">Uraian</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200 min-h-[80px]">
                            {{ $archive->uraian ?? '-' }}
                        </p>
                    </div>

                    {{-- No SPBy --}}
                    <div class="md:col-span-2">
                        <p class="text-sm font-medium text-gray-500 mb-2">No SPBy</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archive->no_spby ?? '-' }}
                        </p>
                    </div>

                    {{-- No SPM --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">No SPM</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archive->no_spm ?? '-' }}
                        </p>
                    </div>

                    {{-- Jenis SPM --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Jenis SPM</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archive->jenis_spm ?? '-' }}
                        </p>
                    </div>

                    {{-- NO SP2D --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">No SP2D</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archive->no_sp2d ?? '-' }}
                        </p>
                    </div>

                    {{-- Nilai SP2D --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Nilai SP2D</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archive->nilai_sp2d ? 'Rp ' . number_format($archive->nilai_sp2d, 0, ',', '.') : '-' }}
                        </p>
                    </div>

                    {{-- Jenis SP2D --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Jenis SP2D</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archive->jenis_sp2d ?? '-' }}
                        </p>
                    </div>

                    {{-- Tanggal SP2D --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Tanggal SP2D</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archive->tgl_sp2d ? \Carbon\Carbon::parse($archive->tgl_sp2d)->format('d F Y') : '-' }}
                        </p>
                    </div>

                    {{-- Tanggal Selesai SP2D --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Tanggal Selesai SP2D</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archive->tgl_selesai_sp2d ? \Carbon\Carbon::parse($archive->tgl_selesai_sp2d)->format('d F Y') : '-' }}
                        </p>
                    </div>

                    {{-- No Invoice --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">No Invoice</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archive->no_invoice ?? '-' }}
                        </p>
                    </div>

                    {{-- Tanggal Invoice --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Tanggal Invoice</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archive->tgl_invoice ? \Carbon\Carbon::parse($archive->tgl_invoice)->format('d F Y') : '-' }}
                        </p>
                    </div>

                    {{-- Tanggal Terima --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Tanggal Terima</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archive->tgl_terima ? \Carbon\Carbon::parse($archive->tgl_terima)->format('d F Y') : '-' }}
                        </p>
                    </div>

                    {{-- Tingkat Pertimbangan --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Tingkat Pertimbangan</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archive->tingkat_pertimbangan ?? '-' }}
                        </p>
                    </div>

                    {{-- Jumlah Halaman --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Jumlah Halaman</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archive->jumlah_halaman ? $archive->jumlah_halaman . ' lembar' : '-' }}
                        </p>
                    </div>

                    {{-- Retensi Arsip Aktif --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Retensi Arsip Aktif</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archive->retensi_arsip_aktif ? $archive->retensi_arsip_aktif . ' tahun' : '-' }}
                        </p>
                    </div>

                    {{-- Retensi Arsip Inaktif --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Retensi Arsip Inaktif</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archive->retensi_arsip_inaktif ? $archive->retensi_arsip_inaktif . ' tahun' : '-' }}
                        </p>
                    </div>

                    {{-- Nasib Akhir Arsip --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Nasib Akhir Arsip</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archive->nasib_akhir_arsip ?? '-' }}
                        </p>
                    </div>

                    {{-- Klasifikasi Keamanan --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Klasifikasi Keamanan</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archive->klasifikasi_keamanan ?? '-' }}
                        </p>
                    </div>

                    {{-- Status --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Status</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archive->status ?? '-' }}
                        </p>
                    </div>

                    {{-- Tanggal Pembuangan --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Tanggal Pembuangan</p>
                        <p class="text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200">
                            {{ $archive->disposal_date ? \Carbon\Carbon::parse($archive->disposal_date)->format('d F Y') : '-' }}
                        </p>
                    </div>

                </div>

                {{-- People Information Section --}}
                <div class="pt-6 border-t border-gray-200 mb-6">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4">Informasi Petugas</h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        {{-- Pengaju --}}
                        <div class="bg-purple-50 rounded-md p-4 border border-purple-200">
                            <p class="text-xs font-medium text-purple-600 mb-2">Pengaju</p>
                            <p class="text-sm font-semibold text-gray-800">{{ $archive->submiter_name ?? $archive->user->name ?? '-' }}</p>
                        </div>

                        {{-- Finance Officer --}}
                        <div class="bg-teal-50 rounded-md p-4 border border-teal-200">
                            <p class="text-xs font-medium text-teal-600 mb-2">Divisi Keuangan</p>
                            <p class="text-sm font-semibold text-gray-800">{{ $archive->finance_officer_name ?? $archive->finance_officer->name ?? '-' }}</p>
                        </div>

                        {{-- Revenue Officer --}}
                        <div class="bg-blue-50 rounded-md p-4 border border-blue-200">
                            <p class="text-xs font-medium text-blue-600 mb-2">Bendahara</p>
                            <p class="text-sm font-semibold text-gray-800">{{ $archive->revenue_officer_name ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                {{-- File Arsip Section --}}
                <div class="pt-6 border-t border-gray-200 mb-6">
                    <p class="text-sm font-medium text-gray-500 mb-3">File Arsip Digital</p>

                    @if ($archive->file_path_archive || $archive->path_file_archive)
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
                                        <p class="text-xs text-green-600 mt-0.5">
                                            {{ basename($archive->file_path_archive ?? $archive->path_file_archive) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            {{-- Lihat --}}
                            <a href="{{ route('lihat.digital_archive', $archive->id) }}" target="_blank"
                                class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Lihat File
                            </a>

                            {{-- Download (jika ada route) --}}
                            <a href="{{ route('download.digital_archive', $archive->id) }}"
                                class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                Download
                            </a>

                            {{-- Link Arsip External --}}
                            @if($archive->link_arsip)
                            <a href="{{ $archive->link_arsip }}" target="_blank"
                                class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-md transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                                Link Eksternal
                            </a>
                            @endif
                        </div>
                    @else
                        <div class="p-4 bg-red-50 border border-red-200 rounded-md">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd" />
                                </svg>
                                <p class="text-sm font-medium text-red-700">File belum tersedia</p>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Keterangan --}}
                <div class="pt-6 border-t border-gray-200 mb-6">
                    <p class="text-sm font-medium text-gray-500 mb-2">Keterangan</p>
                    <div class="px-4 py-3 bg-gray-50 rounded-md border border-gray-200 text-gray-800 min-h-[80px]">
                        {{ $archive->keterangan ?? '-' }}
                    </div>
                </div>

                {{-- Timestamp Information --}}
                <div class="pt-6 border-t border-gray-200 mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Created At --}}
                        <div class="bg-gray-50 rounded-md p-4 border border-gray-200">
                            <p class="text-xs font-medium text-gray-500 mb-1">Dibuat Pada</p>
                            <p class="text-sm font-semibold text-gray-800">
                                {{ $archive->created_at->format('d F Y, H:i') }}
                            </p>
                        </div>

                        {{-- Updated At --}}
                        <div class="bg-gray-50 rounded-md p-4 border border-gray-200">
                            <p class="text-xs font-medium text-gray-500 mb-1">Diperbarui Pada</p>
                            <p class="text-sm font-semibold text-gray-800">
                                {{ $archive->updated_at->format('d F Y, H:i') }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons (jika diperlukan) --}}
                @if(Route::has('digital.archive.edit') && Route::has('digital.archive.destroy'))
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <div class="flex items-center gap-3">
                        {{-- Edit --}}
                        <a href="{{ route('digital.archive.edit', $archive->id) }}"
                            class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit
                        </a>

                        {{-- Hapus --}}
                        <form action="{{ route('digital.archive.destroy', $archive->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus arsip digital ini?')">
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
                @endif

            </div>
        </div>
    </div>
</x-app-layout>