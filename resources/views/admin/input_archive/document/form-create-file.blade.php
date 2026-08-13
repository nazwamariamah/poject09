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
            <a href="{{ route('archive.list', $folders->id) }}"
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
                    <h3 class="text-xl font-semibold text-gray-800">Form Input Arsip Baru</h3>
                    <p class="text-sm text-gray-600 mt-1">Lengkapi data arsip berikut dengan benar.</p>
                </div>

                {{-- Form --}}
                <form action="{{ route('file.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 p-6">
                    @csrf
                    <input type="hidden" name="folder_id" value="{{ $folders->id }}">

                    {{-- Nama File --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Nama Arsip</p>
                        <input type="text" name="file_name"  
                            class="w-full text-lg font-semibold text-gray-900 border-b border-gray-300
                            focus:border-indigo-500 focus:ring-0"
                            placeholder="Nama File Arsip">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        {{-- Kode Klasifikasi --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-2">Kode Klasifikasi</p>
                            <input type="text" name="kode_klasifikasi"  
                                class="w-full font-semibold text-gray-900 bg-transparent border-b border-gray-300
                                focus:border-indigo-500 focus:ring-0" placeholder="Kode Klasifikasi">
                        </div>

                        {{-- Indeks 1 --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-2">Indeks 1</p>
                            <input type="text" name="indeks1"  
                                class="w-full font-semibold text-gray-900 bg-transparent border-b border-gray-300
                                focus:border-indigo-500 focus:ring-0" placeholder="Indeks 1">
                        </div>

                        {{-- Indeks 2 --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-2">Indeks 2</p>
                            <input type="text" name="indeks2"  
                                class="w-full font-semibold text-gray-900 bg-transparent border-b border-gray-300
                                focus:border-indigo-500 focus:ring-0" placeholder="Indeks 2">
                        </div>

                        {{-- No Item --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-2">No Item</p>
                            <input type="number" name="no_item"  
                                class="w-full font-semibold text-gray-900 bg-transparent border-b border-gray-300
                                focus:border-indigo-500 focus:ring-0" placeholder="No Item">
                        </div>
                    </div>

                    {{-- Uraian --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Uraian</p>
                        <textarea name="uraian" rows="2"   placeholder="Uraian"
                            class="w-full font-semibold text-gray-900 bg-transparent border-2 border-gray-300 focus:border-indigo-500 focus:ring-0 px-3 py-2"></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        {{-- No SPBy --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-2">No SPBy</p>
                            <input type="text" name="no_spby"  
                                class="w-full font-semibold text-gray-900 bg-transparent border-b border-gray-300
                                focus:border-indigo-500 focus:ring-0" placeholder="No SPBy">
                        </div>

                        {{-- No SPM --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-2">No SPM</p>
                            <input type="text" name="no_spm"  
                                class="w-full font-semibold text-gray-900 bg-transparent border-b border-gray-300
                                focus:border-indigo-500 focus:ring-0" placeholder="No SPM">
                        </div>

                        {{-- Jenis SPM --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-2">Jenis SPM</p>
                            <input type="text" name="jenis_spm"  
                                class="w-full font-semibold text-gray-900 bg-transparent border-b border-gray-300
                                focus:border-indigo-500 focus:ring-0" placeholder="Jenis SPM">
                        </div>

                        {{-- NIlai SP2D --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-2">Nilai SP2D</p>
                            <input type="text" name="nilai_sp2d"  
                                class="w-full font-semibold text-gray-900 bg-transparent border-b border-gray-300
                                focus:border-indigo-500 focus:ring-0" placeholder="Nilai SP2D">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        {{-- Tanggal SP2D --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-2">Tanggal SP2D</p>
                            <input type="date" name="tgl_sp2d"  
                                class="w-full font-semibold text-gray-900 bg-transparent border-b border-gray-300
                                focus:border-indigo-500 focus:ring-0" placeholder="Tanggal SP2D">
                        </div>

                        {{-- Tanggal selesai SP2D --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-2">Tanggal Selesai SP2D</p>
                            <input type="date" name="tgl_selesai_sp2d"  
                                class="w-full font-semibold text-gray-900 bg-transparent border-b border-gray-300
                                focus:border-indigo-500 focus:ring-0" placeholder="Tanggal Selesai SP2D">
                        </div>   

                        {{-- Tanggal Invoice --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-2">Tanggal Invoice</p>
                            <input type="text" name="tgl_invoice"  
                                class="w-full font-semibold text-gray-900 bg-transparent border-b border-gray-300
                                focus:border-indigo-500 focus:ring-0" placeholder="Tanggal Invoice">
                        </div>

                        {{-- Tanggal terima --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-2">Tanggal Terima</p>
                            <input type="date" name="tgl_terima"  
                                class="w-full font-semibold text-gray-900 bg-transparent border-b border-gray-300
                                focus:border-indigo-500 focus:ring-0" placeholder="Tanggal Terima">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        {{-- No Invoice --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-2">No Invoice</p>
                            <input type="text" name="no_invoice"  
                                class="w-full font-semibold text-gray-900 bg-transparent border-b border-gray-300
                                focus:border-indigo-500 focus:ring-0" placeholder="No Invoice">
                        </div>
                    
                        {{-- Tingkat Pertimbangan --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-2">Tingkat Pertimbangan</p>
                            <input type="text" name="tingkat_pertimbangan"  
                                class="w-full font-semibold text-gray-900 bg-transparent border-b border-gray-300
                                focus:border-indigo-500 focus:ring-0" placeholder="Tingkat Pertimbangan">
                        </div>

                        {{-- Jumlah Halaman --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-2">Jumlah Halaman</p>
                            <input type="number" name="jumlah_halaman"  
                                class="w-full font-semibold text-gray-900 bg-transparent border-b border-gray-300
                                focus:border-indigo-500 focus:ring-0" placeholder="Jumlah Halaman">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        {{-- Retensi Arsip Aktif --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-2">Retensi Arsip Aktif</p>
                            <input type="number" name="retensi_arsip_aktif"  
                                class="w-full font-semibold text-gray-900 bg-transparent border-b border-gray-300
                                focus:border-indigo-500 focus:ring-0" placeholder="Retensi Arsip Aktif">
                        </div>

                        {{-- Retensi Aktif Inaktif --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-2">Retensi Arsip Inaktif</p>
                            <input type="number" name="retensi_arsip_inaktif"  
                                class="w-full font-semibold text-gray-900 bg-transparent border-b border-gray-300
                                focus:border-indigo-500 focus:ring-0" placeholder="Retensi Arsip Aktif">
                        </div>

                        {{-- Nasib Akhir Arsip --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-2">Nasib Akhir Arsip</p>
                            <input type="text" name="nasib_akhir_arsip"  
                                class="w-full font-semibold text-gray-900 bg-transparent border-b border-gray-300
                                focus:border-indigo-500 focus:ring-0" placeholder="Nasib Akhir Arsip">
                        </div>

                        {{-- Klasifikasi Keamanan --}}
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-2">Klasifikasi Keamanan</p>
                            <input type="text" name="klasifikasi_keamanan"  
                                class="w-full font-semibold text-gray-900 bg-transparent border-b border-gray-300
                                focus:border-indigo-500 focus:ring-0" placeholder="Klasifikasi Keamanan">
                        </div>
                    </div>

                    {{-- Status --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Status</p>
                        <input type="text" name="status"  
                            class="w-full font-semibold text-gray-900 bg-transparent border-b border-gray-300
                            focus:border-indigo-500 focus:ring-0" placeholder="Status">
                    </div>  
                    
                    {{-- Keterangan --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-2">Keterangan / Deskripsi</p>
                        <input type="text" name="keterangan"  
                            class="w-full font-semibold text-gray-900 bg-transparent border-b border-gray-300
                            focus:border-indigo-500 focus:ring-0" placeholder="Keterangan">
                    </div>

                    {{-- Upload PDF --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Upload File PDF Arsip
                        </label>
                        <input type="file" name="file_archive"
                            class="w-full block rounded-lg border border-gray-300 bg-gray-50 file:bg-indigo-600 file:text-white file:border-none file:py-2 file:px-4 file:rounded-lg file:cursor-pointer hover:file:bg-indigo-700 transition"
                            accept="application/pdf">
                        <p class="text-xs text-gray-500 mt-1">Format: PDF • Maksimal 20MB</p>
                    </div>

                    {{-- ACTION BUTTONS --}}
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-2">
                        <p class="flex items-center gap-2 text-sm text-gray-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Semua field wajib diisi
                        </p>

                        <div class="flex gap-3 w-full sm:w-auto">
                            <button type="submit"
                                    class="flex-1 px-8 py-2.5 rounded-lg text-white font-semibold bg-gradient-to-r from-green-600 to-emerald-600 shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition">
                                Simpan
                            </button>

                            <a href="{{ route('archive.list', $folders->id) }}"
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
