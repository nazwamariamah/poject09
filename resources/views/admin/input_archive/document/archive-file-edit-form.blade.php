<x-app-layout>
    {{-- HEADER --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Input Arsip') }}
        </h2>
    </x-slot>

    {{-- TOMBOL KEMBALI --}}
    <div class="#">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
            <a href="{{ route('archive.list', $file->folder_id) }}"
                class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-2 py-2 rounded-full border border-gray-200
                    shadow-lg transition-all duration-200 ease-in-out hover:bg-gray-400 hover:shadow-md active:bg-gray-300 active:scale-95">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>             
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-md p-8 border border-gray-200">

                {{-- Header --}}
                <div class="mb-8 pb-4 border-b border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-800">Form Edit Arsip</h3>
                    <p class="text-sm text-gray-600 mt-1">Lengkapi informasi dengan benar dan teliti</p>
                </div>

                {{-- FORM --}}
                <form action="{{ route('file.update', $file->id) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
                    @csrf
                    @method('PUT')

                    {{-- Nama File --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Nama Arsip</p>
                        <input type="text" name="file_name"   value="{{ old('file_name', $file->file_name) }}"
                            class="w-full text-lg font-semibold text-gray-900 border-b border-gray-300
                            focus:border-indigo-500 focus:ring-0"
                            placeholder="Nama File Arsip">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        {{-- Kode Klasifikasi --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-2">Kode Klasifikasi</p>
                            <input type="text" name="kode_klasifikasi"   value="{{ old('kode_klasifikasi', $file->kode_klasifikasi) }}"
                                class="w-full font-semibold text-gray-900 bg-transparent border-b border-gray-300
                                focus:border-indigo-500 focus:ring-0" placeholder="Kode Klasifikasi">
                        </div>

                        {{-- Indeks 1 --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-2">Indeks 1</p>
                            <input type="text" name="indeks1"   value="{{ old('indeks1', $file->indeks1) }}"
                                class="w-full font-semibold text-gray-900 bg-transparent border-b border-gray-300
                                focus:border-indigo-500 focus:ring-0" placeholder="Indeks 1">
                        </div>

                        {{-- Indeks 2 --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-2">Indeks 2</p>
                            <input type="text" name="indeks2"   value="{{ old('indeks2', $file->indeks2) }}"
                                class="w-full font-semibold text-gray-900 bg-transparent border-b border-gray-300
                                focus:border-indigo-500 focus:ring-0" placeholder="Indeks 2">
                        </div>

                        {{-- No Item --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-2">No Item</p>
                            <input type="number" name="no_item"   value="{{ old('no_item', $file->no_item) }}"
                                class="w-full font-semibold text-gray-900 bg-transparent border-b border-gray-300
                                focus:border-indigo-500 focus:ring-0" placeholder="No Item">
                        </div>
                    </div>

                    {{-- Uraian --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Uraian</p>
                        <textarea name="uraian" rows="2"   placeholder="Uraian"
                            class="w-full font-semibold text-gray-900 bg-transparent border-2 border-gray-300 focus:border-indigo-500 focus:ring-0 px-3 py-2">{{ old('uraian', $file->uraian) }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        {{-- No SPBy --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-2">No SPBy</p>
                            <input type="text" name="no_spby"   value="{{ old('no_spby', $file->no_spby) }}"
                                class="w-full font-semibold text-gray-900 bg-transparent border-b border-gray-300
                                focus:border-indigo-500 focus:ring-0" placeholder="No SPBy">
                        </div>

                        {{-- No SPM --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-2">No SPM</p>
                            <input type="text" name="no_spm"   value="{{ old('no_spm', $file->no_spm) }}"
                                class="w-full font-semibold text-gray-900 bg-transparent border-b border-gray-300
                                focus:border-indigo-500 focus:ring-0" placeholder="No SPM">
                        </div>

                        {{-- Jenis SPM --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-2">Jenis SPM</p>
                            <input type="text" name="jenis_spm"   value="{{ old('jenis_spm', $file->jenis_spm) }}"
                                class="w-full font-semibold text-gray-900 bg-transparent border-b border-gray-300
                                focus:border-indigo-500 focus:ring-0" placeholder="Jenis SPM">
                        </div>

                        {{-- NIlai SP2D --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-2">Nilai SP2D</p>
                            <input type="text" name="nilai_sp2d"   value="{{ old('nilai_sp2d', $file->nilai_sp2d) }}"
                                class="w-full font-semibold text-gray-900 bg-transparent border-b border-gray-300
                                focus:border-indigo-500 focus:ring-0" placeholder="Nilai SP2D">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        {{-- Tanggal SP2D --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-2">Tanggal SP2D</p>
                            <input type="date" name="tgl_sp2d"   value="{{ old('tgl_sp2d', $file->tgl_sp2d) }}"
                                class="w-full font-semibold text-gray-900 bg-transparent border-b border-gray-300
                                focus:border-indigo-500 focus:ring-0" placeholder="Tanggal SP2D">
                        </div>

                        {{-- Tanggal selesai SP2D --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-2">Tanggal Selesai SP2D</p>
                            <input type="date" name="tgl_selesai_sp2d"   value="{{ old('tgl_selesai_sp2d', $file->tgl_selesai_sp2d) }}"
                                class="w-full font-semibold text-gray-900 bg-transparent border-b border-gray-300
                                focus:border-indigo-500 focus:ring-0" placeholder="Tanggal Selesai SP2D">
                        </div>   

                        {{-- Tanggal Invoice --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-2">Tanggal Invoice</p>
                            <input type="text" name="tgl_invoice"   value="{{ old('tgl_invoice', $file->tgl_invoice) }}"
                                class="w-full font-semibold text-gray-900 bg-transparent border-b border-gray-300
                                focus:border-indigo-500 focus:ring-0" placeholder="Tanggal Invoice">
                        </div>

                        {{-- Tanggal terima --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-2">Tanggal Terima</p>
                            <input type="date" name="tgl_terima"   value="{{ old('tgl_terima', $file->tgl_terima) }}"
                                class="w-full font-semibold text-gray-900 bg-transparent border-b border-gray-300
                                focus:border-indigo-500 focus:ring-0" placeholder="Tanggal Terima">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        {{-- No Invoice --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-2">No Invoice</p>
                            <input type="text" name="no_invoice"   value="{{ old('no_invoice', $file->no_invoice) }}"
                                class="w-full font-semibold text-gray-900 bg-transparent border-b border-gray-300
                                focus:border-indigo-500 focus:ring-0" placeholder="No Invoice">
                        </div>
                    
                        {{-- Tingkat Pertimbangan --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-2">Tingkat Pertimbangan</p>
                            <input type="text" name="tingkat_pertimbangan"   value="{{ old('tingkat_pertimbangan', $file->tingkat_pertimbangan) }}"
                                class="w-full font-semibold text-gray-900 bg-transparent border-b border-gray-300
                                focus:border-indigo-500 focus:ring-0" placeholder="Tingkat Pertimbangan">
                        </div>

                        {{-- Jumlah Halaman --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-2">Jumlah Halaman</p>
                            <input type="number" name="jumlah_halaman"   value="{{ old('jumlah_halaman', $file->jumlah_halaman) }}"
                                class="w-full font-semibold text-gray-900 bg-transparent border-b border-gray-300
                                focus:border-indigo-500 focus:ring-0" placeholder="Jumlah Halaman">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        {{-- Retensi Arsip Aktif --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-2">Retensi Arsip Aktif</p>
                            <input type="number" name="retensi_arsip_aktif"   value="{{ old('retensi_arsip_aktif', $file->retensi_arsip_aktif) }}"
                                class="w-full font-semibold text-gray-900 bg-transparent border-b border-gray-300
                                focus:border-indigo-500 focus:ring-0" placeholder="Retensi Arsip Aktif">
                        </div>

                        {{-- Retensi Aktif Inaktif --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-2">Retensi Arsip Inaktif</p>
                            <input type="number" name="retensi_arsip_inaktif"   value="{{ old('retensi_arsip_inaktif', $file->retensi_arsip_inaktif) }}"
                                class="w-full font-semibold text-gray-900 bg-transparent border-b border-gray-300
                                focus:border-indigo-500 focus:ring-0" placeholder="Retensi Arsip Aktif">
                        </div>

                        {{-- Nasib Akhir Arsip --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-2">Nasib Akhir Arsip</p>
                            <input type="text" name="nasib_akhir_arsip"   value="{{ old('nasib_akhir_arsip', $file->nasib_akhir_arsip) }}"
                                class="w-full font-semibold text-gray-900 bg-transparent border-b border-gray-300
                                focus:border-indigo-500 focus:ring-0" placeholder="Nasib Akhir Arsip">
                        </div>

                        {{-- Klasifikasi Keamanan --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-2">Klasifikasi Keamanan</p>
                            <input type="text" name="klasifikasi_keamanan"   value="{{ old('klasifikasi_keamanan', $file->klasifikasi_keamanan) }}"
                                class="w-full font-semibold text-gray-900 bg-transparent border-b border-gray-300
                                focus:border-indigo-500 focus:ring-0" placeholder="Klasifikasi Keamanan">
                        </div>
                    </div>

                    {{-- Status --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Status</p>
                        <input type="text" name="status"   value="{{ old('status', $file->status) }}"
                            class="w-full font-semibold text-gray-900 bg-transparent border-b border-gray-300
                            focus:border-indigo-500 focus:ring-0" placeholder="Status">
                    </div>  

                    {{-- Keterangan --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Keterangan / Deskripsi</p>
                        <input type="text" name="keterangan"   value="{{ old('keterangan', $file->keterangan) }}"
                            class="w-full font-semibold text-gray-900 bg-transparent border-b border-gray-300
                            focus:border-indigo-500 focus:ring-0" placeholder="Keterangan">
                    </div>

                    {{-- FILE ARSIP --}}
                    <div class="space-y-3">
                        @if ($file->file_path)
                            {{-- File Saat Ini --}}
                            <div class="relative overflow-hidden rounded-xl border border-green-200 bg-white p-5 shadow-sm">
                                <div class="flex items-center justify-between gap-4">

                                    {{-- Kiri : Icon + Info --}}
                                    <div class="flex items-start gap-4 min-w-0">
                                        <div class="flex-shrink-0 p-3 bg-green-100 rounded-xl">
                                            <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>

                                        <div class="min-w-0">
                                            <p class="text-sm font-semibold text-green-700">File Arsip Tersedia</p>
                                            <p class="text-sm text-red-700 truncate mt-1"><span>📄 {{ basename($file->file_path) }}</span></p>
                                        </div>
                                    </div>

                                    {{-- Kanan : Tombol --}}
                                    <div class="flex-shrink-0">
                                        <a href="{{ route('archive.looks', $file->id) }}" target="_blank"
                                            class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5 c4.478 0 8.268 2.943 9.542 7 -1.274 4.057-5.064 7-9.542 7 -4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            Lihat File
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <input type="file" name="file_archive" accept="application/pdf"
                            class="w-full rounded-xl border-2 border-dashed border-gray-300 bg-gray-50 cursor-pointer file:mr-4 file:px-6 file:py-3
                            file:rounded-lg file:border-0 file:bg-indigo-600 file:text-white hover:file:bg-indigo-700 focus:ring-4 focus:ring-indigo-100 transition" />
                        <p class="text-xs text-gray-500 ml-1">Format PDF • Maksimal 20MB</p>
                    </div>

                    {{-- ACTION --}}
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-4">
                        <p class="text-sm text-gray-500 flex items-center gap-2">
                            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 9v2m0 4h.01
                                         m-6.938 4h13.856" />
                            </svg>
                            Perubahan akan tersimpan permanen
                        </p>

                        <div class="flex gap-3 w-full sm:w-auto">
                            <button type="submit"
                                    class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-8 py-2.5 bg-gradient-to-r from-amber-600 to-orange-600 hover:from-amber-700 hover:to-orange-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                Update
                            </button>
                            <a href="{{ route('archive.list', $file->folder_id) }}"
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
