<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Edit Arsip Digital') }}
        </h2>
    </x-slot>
 
    {{-- TOMBOL KEMBALI --}}
    <div class="#">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
            <a href="{{ route('year.show', $digital->category_id) }}"
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
                    <h3 class="text-xl font-semibold text-gray-800">Form Edit Arsip Digital</h3>
                    <p class="text-sm text-gray-600 mt-1">Perbarui informasi arsip digital dengan benar dan teliti.</p>
                </div>

                {{-- FORM --}}
                <form action="{{ route('digital.update', $digital->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    {{-- Grid 2 Kolom untuk Info --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Nama digital --}}
                        <div class="md:col-span-2">
                            <label class="text-sm font-medium text-gray-500 mb-2 block">Nama digital</label>
                            <input type="text" name="digital_name" value="{{ old('digital_name', $digital->archive_name) }}"
                                class="w-full text-lg font-semibold text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Masukkan nama digital">
                            @error('digital_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Kode Arsip --}}
                        <div>
                            <label class="text-sm font-medium text-gray-500 mb-2 block">Kode Arsip</label>
                            <input type="text" name="digital_code" value="{{ old('digital_code', $digital->archive_code) }}"
                                class="w-full text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Kode Arsip">
                            @error('digital_code')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Divisi Asal --}}
                        <div>
                            <label class="text-sm font-medium text-gray-500 mb-2 block">Divisi Asal</label>
                            <input type="text" name="from_division" value="{{ old('from_division', $digital->from_division) }}"
                                class="w-full text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Divisi Asal">
                            @error('from_division')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Kode Klasifikasi --}}
                        <div>
                            <label class="text-sm font-medium text-gray-500 mb-2 block">Kode Klasifikasi</label>
                            <input type="text" name="kode_klasifikasi" value="{{ old('kode_klasifikasi', $digital->kode_klasifikasi) }}"
                                class="w-full text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Kode Klasifikasi">
                            @error('kode_klasifikasi')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Indeks 1 --}}
                        <div>
                            <label class="text-sm font-medium text-gray-500 mb-2 block">Indeks 1</label>
                            <input type="text" name="indeks1" value="{{ old('indeks1', $digital->indeks1) }}"
                                class="w-full text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Indeks 1">
                            @error('indeks1')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Indeks 2 --}}
                        <div>
                            <label class="text-sm font-medium text-gray-500 mb-2 block">Indeks 2</label>
                            <input type="text" name="indeks2" value="{{ old('indeks2', $digital->indeks2) }}"
                                class="w-full text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Indeks 2">
                            @error('indeks2')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- No Item --}}
                        <div>
                            <label class="text-sm font-medium text-gray-500 mb-2 block">No Item</label>
                            <input type="text" name="no_item" value="{{ old('no_item', $digital->no_item) }}"
                                class="w-full text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="No Item">
                            @error('no_item')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Nominal --}}
                        <div>
                            <label class="text-sm font-medium text-gray-500 mb-2 block">Nominal</label>
                            <input type="number" name="nominal" value="{{ old('nominal', $digital->nominal) }}"
                                class="w-full text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Nominal (Rp)">
                            @error('nominal')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Uraian --}}
                        <div class="md:col-span-2">
                            <label class="text-sm font-medium text-gray-500 mb-2 block">Uraian</label>
                            <textarea name="uraian" rows="3"
                                class="w-full text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Uraian singkat">{{ old('uraian', $digital->uraian) }}</textarea>
                            @error('uraian')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- No SPBy --}}
                        <div class="md:col-span-2">
                            <label class="text-sm font-medium text-gray-500 mb-2 block">No SPBy</label>
                            <input type="text" name="no_spby" value="{{ old('no_spby', $digital->no_spby) }}"
                                class="w-full text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="No SPBy">
                            @error('no_spby')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- No SPM --}}
                        <div>
                            <label class="text-sm font-medium text-gray-500 mb-2 block">No SPM</label>
                            <input type="text" name="no_spm" value="{{ old('no_spm', $digital->no_spm) }}"
                                class="w-full text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="No SPM">
                            @error('no_spm')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Jenis SPM --}}
                        <div>
                            <label class="text-sm font-medium text-gray-500 mb-2 block">Jenis SPM</label>
                            <input type="text" name="jenis_spm" value="{{ old('jenis_spm', $digital->jenis_spm) }}"
                                class="w-full text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Jenis SPM">
                            @error('jenis_spm')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- NO SP2D --}}
                        <div>
                            <label class="text-sm font-medium text-gray-500 mb-2 block">No SP2D</label>
                            <input type="text" name="no_sp2d" value="{{ old('no_sp2d', $digital->no_sp2d) }}"
                                class="w-full text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="No SP2D">
                            @error('no_sp2d')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Nilai SP2D --}}
                        <div>
                            <label class="text-sm font-medium text-gray-500 mb-2 block">Nilai SP2D</label>
                            <input type="number" name="nilai_sp2d" value="{{ old('nilai_sp2d', $digital->nilai_sp2d) }}"
                                class="w-full text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Nilai SP2D (Rp)">
                            @error('nilai_sp2d')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Jenis SP2D --}}
                        <div>
                            <label class="text-sm font-medium text-gray-500 mb-2 block">Jenis SP2D</label>
                            <input type="text" name="jenis_sp2d" value="{{ old('jenis_sp2d', $digital->jenis_sp2d) }}"
                                class="w-full text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Jenis SP2D">
                            @error('jenis_sp2d')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tanggal SP2D --}}
                        <div>
                            <label class="text-sm font-medium text-gray-500 mb-2 block">Tanggal SP2D</label>
                            <input type="date" name="tgl_sp2d" value="{{ old('tgl_sp2d', $digital->tgl_sp2d) }}"
                                class="w-full text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            @error('tgl_sp2d')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tanggal Selesai SP2D --}}
                        <div>
                            <label class="text-sm font-medium text-gray-500 mb-2 block">Tanggal Selesai SP2D</label>
                            <input type="date" name="tgl_selesai_sp2d" value="{{ old('tgl_selesai_sp2d', $digital->tgl_selesai_sp2d) }}"
                                class="w-full text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            @error('tgl_selesai_sp2d')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- No Invoice --}}
                        <div>
                            <label class="text-sm font-medium text-gray-500 mb-2 block">No Invoice</label>
                            <input type="text" name="no_invoice" value="{{ old('no_invoice', $digital->no_invoice) }}"
                                class="w-full text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="No Invoice">
                            @error('no_invoice')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tanggal Invoice --}}
                        <div>
                            <label class="text-sm font-medium text-gray-500 mb-2 block">Tanggal Invoice</label>
                            <input type="text" name="tgl_invoice" value="{{ old('tgl_invoice', $digital->tgl_invoice) }}" placeholder="Tanggal Invoice"
                                class="w-full text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            @error('tgl_invoice')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tanggal Terima --}}
                        <div>
                            <label class="text-sm font-medium text-gray-500 mb-2 block">Tanggal Terima</label>
                            <input type="date" name="tgl_terima" value="{{ old('tgl_terima', $digital->tgl_terima) }}"
                                class="w-full text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            @error('tgl_terima')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tingkat Pertimbangan --}}
                        <div>
                            <label class="text-sm font-medium text-gray-500 mb-2 block">Tingkat Pertimbangan</label>
                            <input type="text" name="tingkat_pertimbangan" value="{{ old('tingkat_pertimbangan', $digital->tingkat_pertimbangan) }}"
                                class="w-full text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Tingkat Pertimbangan">
                            @error('tingkat_pertimbangan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Jumlah Halaman --}}
                        <div>
                            <label class="text-sm font-medium text-gray-500 mb-2 block">Jumlah Halaman</label>
                            <input type="number" name="jumlah_halaman" value="{{ old('jumlah_halaman', $digital->jumlah_halaman) }}"
                                class="w-full text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Jumlah Halaman">
                            @error('jumlah_halaman')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Retensi Arsip Aktif --}}
                        <div>
                            <label class="text-sm font-medium text-gray-500 mb-2 block">Retensi Arsip Aktif (Tahun)</label>
                            <input type="number" name="retensi_arsip_aktif" value="{{ old('retensi_arsip_aktif', $digital->retensi_arsip_aktif) }}"
                                class="w-full text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Retensi Arsip Aktif">
                            @error('retensi_arsip_aktif')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Retensi Arsip Inaktif --}}
                        <div>
                            <label class="text-sm font-medium text-gray-500 mb-2 block">Retensi Arsip Inaktif (Tahun)</label>
                            <input type="number" name="retensi_arsip_inaktif" value="{{ old('retensi_arsip_inaktif', $digital->retensi_arsip_inaktif) }}"
                                class="w-full text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Retensi Arsip Inaktif">
                            @error('retensi_arsip_inaktif')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Nasib Akhir Arsip --}}
                        <div>
                            <label class="text-sm font-medium text-gray-500 mb-2 block">Nasib Akhir Arsip</label>
                            <input type="text" name="nasib_akhir_arsip" value="{{ old('nasib_akhir_arsip', $digital->nasib_akhir_arsip) }}"
                                class="w-full text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Nasib Akhir Arsip">
                            @error('nasib_akhir_arsip')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Klasifikasi Keamanan --}}
                        <div>
                            <label class="text-sm font-medium text-gray-500 mb-2 block">Klasifikasi Keamanan</label>
                            <input type="text" name="klasifikasi_keamanan" value="{{ old('klasifikasi_keamanan', $digital->klasifikasi_keamanan) }}"
                                class="w-full text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Klasifikasi Keamanan">
                            @error('klasifikasi_keamanan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div>
                            <label class="text-sm font-medium text-gray-500 mb-2 block">Status</label>
                            <input type="text" name="status" value="{{ old('status', $digital->status) }}"
                                class="w-full text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Status">
                            @error('status')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tanggal Pembuangan --}}
                        <div>
                            <label class="text-sm font-medium text-gray-500 mb-2 block">Tanggal Pembuangan</label>
                            <input type="date" name="disposal_date" value="{{ old('disposal_date', $digital->disposal_date) }}"
                                class="w-full text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            @error('disposal_date')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    {{-- People Information Section --}}
                    <div class="pt-6 border-t border-gray-200">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">Informasi Petugas</h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            {{-- Pengaju --}}
                            <div>
                                <label class="text-xs font-medium text-purple-600 mb-2 block">Pengaju</label>
                                <input type="text" name="submiter_name" value="{{ old('submiter_name', $digital->submiter_name) }}"
                                    class="w-full text-sm font-semibold text-gray-800 px-4 py-3 bg-purple-50 rounded-md border border-purple-200
                                    focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition"
                                    placeholder="Nama Pengaju">
                                @error('submiter_name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Finance Officer --}}
                            <div>
                                <label class="text-xs font-medium text-teal-600 mb-2 block">Divisi Keuangan</label>
                                <input type="text" name="finance_officer_name" value="{{ old('finance_officer_name', $digital->finance_officer_name) }}"
                                    class="w-full text-sm font-semibold text-gray-800 px-4 py-3 bg-teal-50 rounded-md border border-teal-200
                                    focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition"
                                    placeholder="Nama Finance Officer">
                                @error('finance_officer_name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Revenue Officer --}}
                            <div>
                                <label class="text-xs font-medium text-blue-600 mb-2 block">Bendahara</label>
                                <input type="text" name="revenue_officer_name" value="{{ old('revenue_officer_name', $digital->revenue_officer_name) }}"
                                    class="w-full text-sm font-semibold text-gray-800 px-4 py-3 bg-blue-50 rounded-md border border-blue-200
                                    focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                    placeholder="Nama Bendahara">
                                @error('revenue_officer_name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- File Arsip Section --}}
                    <div class="pt-6 border-t border-gray-200">
                        <label class="text-sm font-medium text-gray-500 mb-3 block">File Arsip Digital</label>

                        @if ($digital->file_path_archive)
                            <div class="p-4 bg-green-50 border border-green-200 rounded-md mb-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <div>
                                            <p class="text-sm font-medium text-green-700">File saat ini tersedia</p>
                                            <p class="text-xs text-green-600 mt-0.5">
                                                {{ basename($digital->file_path_archive) }}
                                            </p>
                                        </div>
                                    </div>
                                    <a href="{{ route('lihat.digital_archive', $digital->id) }}" target="_blank"
                                        class="inline-flex items-center gap-2 px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-md transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Lihat
                                    </a>
                                </div>
                            </div>
                        @endif

                        <div class="space-y-2">
                            <input type="file" name="file_path_digital" accept="application/pdf"
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4
                                file:rounded-md file:border-0 file:text-sm file:font-semibold
                                file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100
                                border border-gray-200 rounded-md cursor-pointer focus:outline-none" />
                            <p class="text-xs text-gray-500">Upload file baru jika ingin mengganti file arsip. Format PDF • Maksimal 20MB</p>
                        </div>
                    </div>

                    {{-- Link Arsip External --}}
                    <div class="pt-6 border-t border-gray-200">
                        <label class="text-sm font-medium text-gray-500 mb-2 block">Link Arsip Eksternal</label>
                        <input type="url" name="link_arsip" value="{{ old('link_arsip', $digital->link_arsip) }}"
                            class="w-full text-gray-800 px-4 py-2.5 bg-gray-50 rounded-md border border-gray-200
                            focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="https://example.com/arsip">
                        @error('link_arsip')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Keterangan --}}
                    <div class="pt-6 border-t border-gray-200">
                        <label class="text-sm font-medium text-gray-500 mb-2 block">Keterangan</label>
                        <textarea name="keterangan" rows="3"
                            class="w-full text-gray-800 px-4 py-3 bg-gray-50 rounded-md border border-gray-200
                            focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="Keterangan tambahan atau catatan mengenai arsip">{{ old('keterangan', $digital->keterangan) }}</textarea>
                        @error('keterangan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                        <p class="text-sm text-gray-500 flex items-center gap-2">
                            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            Pastikan semua data sudah benar sebelum menyimpan
                        </p>

                        <div class="flex items-center gap-3">
                            {{-- Tombol Batal --}}
                            <a href="{{ route('year.show', $digital->category_id) }}"
                                class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-md transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Batal
                            </a>

                            {{-- Tombol Update --}}
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                </svg>
                                Update Arsip
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>