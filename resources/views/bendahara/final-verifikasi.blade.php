<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Verifikasi Final Pengajuan') }}
        </h2>
    </x-slot>

    {{-- TOMBOL KEMBALI --}}
    <div class="py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <a href="{{ route('bendahara.pengajuan') }}"
                class="inline-flex items-center gap-2 bg-white text-gray-700 px-4 py-2 rounded-md border border-gray-300 shadow-sm hover:bg-gray-50 hover:border-gray-400 transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span class="font-medium">Kembali</span>
            </a>
        </div>
    </div>

    <div class="pb-12 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-md border border-gray-200 overflow-hidden">
                <div class="p-6 md:p-8 space-y-6">

                    {{-- SECTION 1: HEADER INFORMASI PENGAJUAN --}}
                    <div class="bg-white rounded-md shadow-sm border border-gray-200 overflow-hidden">
                        {{-- Header --}}
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-5 border-b border-gray-200">
                            <div class="flex items-start gap-4">
                                <div class="p-3 bg-white rounded-md shadow-sm border border-gray-200">
                                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-1">
                                        {{ $pengajuan->pengajuan_name }}
                                    </h3>
                                    <p class="text-sm text-gray-600">ID Pengajuan: #{{ $pengajuan->id }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 space-y-6">
                            {{-- Info Pemohon --}}
                            <div>
                                <div class="flex items-center gap-2 mb-4">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <h4 class="font-semibold text-gray-800">Informasi Pemohon</h4>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="bg-gray-50 rounded-md p-4 border border-gray-200">
                                        <p class="text-xs text-gray-600 mb-1 font-medium">Nama Pemohon</p>
                                        <p class="text-sm font-semibold text-gray-900">{{ $pengajuan->user->name }}</p>
                                    </div>

                                    <div class="bg-gray-50 rounded-md p-4 border border-gray-200">
                                        <p class="text-xs text-gray-600 mb-1 font-medium">Email</p>
                                        <p class="text-sm font-medium text-gray-900 break-all">
                                            {{ $pengajuan->user->email }}</p>
                                    </div>

                                    <div class="bg-gray-50 rounded-md p-4 border border-gray-200">
                                        <p class="text-xs text-gray-600 mb-1 font-medium">Divisi</p>
                                        <p class="text-sm font-medium text-gray-900 capitalize">
                                            {{ $pengajuan->user->role }}</p>
                                    </div>
                                </div>
                            </div>

                            {{-- Metode Pembayaran & Sumber Dana --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="bg-gray-50 rounded-md p-4 border border-gray-200">
                                    <div class="flex items-center gap-2 mb-3">
                                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                        </svg>
                                        <h4 class="text-sm font-semibold text-gray-700">Metode Pembayaran</h4>
                                    </div>
                                    <p class="text-sm font-medium text-gray-900 pl-6">
                                        {{ $pengajuan->payment_method->payment_method_name . ' - ' ?? '-' }}{{ $pengajuan->payment_method->sub_category }}
                                    </p>
                                </div>

                                <div class="bg-gray-50 rounded-md p-4 border border-gray-200">
                                    <div class="flex items-center gap-2 mb-3">
                                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <h4 class="text-sm font-semibold text-gray-700">Sumber Dana</h4>
                                    </div>
                                    <p class="text-sm font-medium text-gray-900 pl-6">
                                        {{ $pengajuan->funding_source->funding_source_name . ' - ' ?? '-' }}{{ $pengajuan->funding_source->sub_category }}
                                    </p>
                                </div>
                            </div>

                            {{-- Timeline --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="flex items-center gap-3 bg-gray-50 rounded-md p-4 border border-gray-200">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <div>
                                        <p class="text-xs text-gray-600 font-medium">Tanggal Dibuat</p>
                                        <p class="text-sm font-semibold text-gray-900">
                                            {{ $pengajuan->created_at->translatedFormat('d M Y — H:i') }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-3 bg-gray-50 rounded-md p-4 border border-gray-200">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <div>
                                        <p class="text-xs text-gray-600 font-medium">Terakhir Diupdate</p>
                                        <p class="text-sm font-semibold text-gray-900">
                                            {{ $pengajuan->updated_at->translatedFormat('d M Y — H:i') }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- Status Badges --}}
                            <div class="bg-gray-50 rounded-md p-4 border border-gray-200">
                                <div class="flex items-center gap-2 mb-3">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <h4 class="font-semibold text-gray-800">Status Pengajuan</h4>
                                </div>

                                <div class="flex flex-wrap gap-2">
                                    @if ($pengajuan->requirements_status == 'Belum Lengkap' && $pengajuan->verification_status == 0)
                                        <span
                                            class="px-3 py-1.5 rounded-md text-xs font-medium bg-blue-100 text-blue-700 border border-blue-200">
                                            Dalam Proses
                                        </span>
                                    @endif

                                    <span
                                        class="px-3 py-1.5 rounded-md text-xs font-medium border
                                        {{ $pengajuan->requirements_status == 'Lengkap'
                                            ? 'bg-green-100 text-green-700 border-green-200'
                                            : 'bg-yellow-100 text-yellow-700 border-yellow-200' }}">
                                        {{ ucfirst($pengajuan->requirements_status) }}
                                    </span>

                                    <span
                                        class="px-3 py-1.5 rounded-md text-xs font-medium border
                                        {{ $pengajuan->verification_status
                                            ? 'bg-green-100 text-green-700 border-green-200'
                                            : 'bg-red-100 text-red-700 border-red-200' }}">
                                        {{ $pengajuan->verification_status ? 'Terverifikasi' : 'Belum Diverifikasi' }}
                                    </span>

                                    <span
                                        class="px-3 py-1.5 rounded-md text-xs font-medium border
                                        {{ $pengajuan->is_archive
                                            ? 'bg-teal-100 text-teal-700 border-teal-200'
                                            : 'bg-gray-100 text-gray-700 border-gray-200' }}">
                                        {{ $pengajuan->is_archive ? 'Diarsipkan' : 'Belum Diarsipkan' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- SECTION 2: PEMERIKSA --}}
                    <div class="bg-white rounded-md shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-white rounded-md shadow-sm border border-gray-200">
                                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h3 class="font-semibold text-lg text-gray-900">Diperiksa Oleh</h3>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="bg-gray-50 rounded-md p-4 border border-gray-200">
                                    <p class="text-xs text-gray-600 mb-1 font-medium">Nama</p>
                                    <p class="text-sm font-semibold text-gray-900">
                                        {{ $pengajuan->finance_officer->name ?? '-' }}</p>
                                </div>

                                <div class="bg-gray-50 rounded-md p-4 border border-gray-200">
                                    <p class="text-xs text-gray-600 mb-1 font-medium">Email</p>
                                    <p class="text-sm font-medium text-gray-900 break-all">
                                        {{ $pengajuan->finance_officer->email ?? '-' }}</p>
                                </div>

                                <div class="bg-gray-50 rounded-md p-4 border border-gray-200">
                                    <p class="text-xs text-gray-600 mb-1 font-medium">Divisi</p>
                                    <p class="text-sm font-medium text-gray-900 capitalize">
                                        {{ $pengajuan->finance_officer->role ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- SECTION 2: PEMERIKSA --}}
                    <div class="bg-white rounded-md shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-white rounded-md shadow-sm border border-gray-200">
                                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h3 class="font-semibold text-lg text-gray-900">Diperiksa Oleh Bendahara</h3>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="bg-gray-50 rounded-md p-4 border border-gray-200">
                                    <p class="text-xs text-gray-600 mb-1 font-medium">Nama</p>
                                    <p class="text-sm font-semibold text-gray-900">
                                        {{ $pengajuan->revenue_officer->name ?? '-' }}</p>
                                </div>

                                <div class="bg-gray-50 rounded-md p-4 border border-gray-200">
                                    <p class="text-xs text-gray-600 mb-1 font-medium">Email</p>
                                    <p class="text-sm font-medium text-gray-900 break-all">
                                        {{ $pengajuan->revenue_officer->email ?? '-' }}</p>
                                </div>

                                <div class="bg-gray-50 rounded-md p-4 border border-gray-200">
                                    <p class="text-xs text-gray-600 mb-1 font-medium">Divisi</p>
                                    <p class="text-sm font-medium text-gray-900 capitalize">
                                        {{ $pengajuan->revenue_officer->role ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- SECTION 3: FILE PENGAJUAN --}}
                    <div class="bg-white rounded-md shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-white rounded-md shadow-sm border border-gray-200">
                                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <h3 class="font-semibold text-lg text-gray-900">File Pengajuan</h3>
                            </div>
                        </div>

                        <div class="p-6 space-y-6">
                            {{-- Info Notice --}}
                            <div class="bg-blue-50 border border-blue-200 rounded-md p-4">
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-sm text-blue-800">
                                        Mohon untuk <span class="font-semibold">menandatangani dokumen pengajuan</span>
                                        sebelum dilakukan proses verifikasi final.
                                    </p>
                                </div>
                            </div>

                            {{-- File Info --}}
                            <div
                                class="bg-gradient-to-r from-gray-50 to-red-50/30 rounded-md p-4 border border-gray-200">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-4 flex-1 min-w-0">
                                        <div class="p-3 bg-white rounded-md shadow-sm border border-gray-200">
                                            <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs text-gray-500 mb-1 font-medium">Nama File</p>
                                            <p class="text-sm font-semibold text-gray-900 truncate">
                                                {{ basename($pengajuan->path_file_submission) ?? '-' }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex gap-2 flex-shrink-0 ml-4">
                                        <a href="{{ route('view.file', $pengajuan->id) }}" target="_blank"
                                            class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-md shadow-sm transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Lihat
                                        </a>

                                        <a href="{{ route('download.file', $pengajuan->id) }}"
                                            class="inline-flex items-center gap-2 px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold rounded-md shadow-sm transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                            </svg>
                                            Download
                                        </a>
                                    </div>
                                </div>
                            </div>

                            {{-- Upload Form --}}
                            <form action="{{ route('bendahara.verification', $pengajuan->id) }}" method="POST"
                                enctype="multipart/form-data" class="space-y-6">
                                @method('PUT')
                                @csrf

                                @if (!$pengajuan->requirements_status || !$pengajuan->is_archive)
                                    {{-- Upload File --}}
                                    <div class="bg-gray-50 rounded-md p-5 border border-gray-200">
                                        <div class="flex items-center gap-2 mb-4">
                                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                            </svg>
                                            <label class="font-semibold text-gray-800">Upload File Bertanda
                                                Tangan</label>
                                        </div>

                                        <input type="file" name="file_pengajuan" accept="application/pdf" required
                                            class="block w-full text-sm text-gray-700 file:mr-4 file:py-2.5 file:px-4
                                            file:rounded-md file:border-0 file:text-sm file:font-semibold
                                            file:bg-blue-600 file:text-white hover:file:bg-blue-700
                                            file:shadow-sm hover:file:shadow-md file:transition-all file:duration-200 cursor-pointer">
                                        <p class="text-xs text-gray-500 mt-2">Format: PDF | Maksimal: 50MB</p>
                                    </div>

                                    {{-- Biaya --}}
                                    <div class="bg-gray-50 rounded-md p-5 border border-gray-200">
                                        <div class="flex items-center gap-2 mb-4">
                                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <label class="font-semibold text-gray-800">Biaya yang Dibayarkan</label>
                                        </div>

                                        <div class="relative">
                                            <span
                                                class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-600 font-medium">Rp</span>
                                            <input type="number" name="biaya"
                                                value="{{ $pengajuan->biaya ?? '' }}" placeholder="0" min="0" required 
                                                class="w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-md text-sm text-gray-800 bg-white
                                                    focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                                        </div>
                                        <p class="text-xs text-gray-500 mt-2">Masukkan nominal biaya sesuai dokumen
                                            pengajuan</p>
                                    </div>

                                    {{-- Nomor Kuitansi --}}
                                    <div class="bg-gray-50 rounded-md p-5 border border-gray-200">
                                        <div class="flex items-center gap-2 mb-4">
                                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                                            </svg>
                                            <label class="font-semibold text-gray-800">Nomor Kuitansi</label>
                                        </div>

                                        <input type="text" name="kuitansi" value="{{ $kuitansi ?? '' }}"
                                            placeholder="Contoh: KWT/2024/001"
                                            class="w-full px-3 py-2.5 border border-gray-300 rounded-md text-sm text-gray-800 bg-white
                                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                                        <p class="text-xs text-gray-500 mt-2">Opsional - Gunakan format sesuai standar
                                            institusi</p>
                                    </div>

                                    {{-- Nomor SPBy --}}
                                    <div class="bg-gray-50 rounded-md p-5 border border-gray-200">
                                        <div class="flex items-center gap-2 mb-4">
                                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <label class="font-semibold text-gray-800">Nomor SPBy</label>
                                        </div>

                                        <input type="text" name="no_spby" value="{{ $no_spm ?? '' }}"
                                            placeholder="Contoh: SPBy/2024/001"
                                            class="w-full px-3 py-2.5 border border-gray-300 rounded-md text-sm text-gray-800 bg-white
                                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                                        <p class="text-xs text-gray-500 mt-2">Opsional - Nomor Surat Perintah Bayar</p>
                                    </div>

                                    {{-- Metode Pembayaran & Sumber Dana --}}
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="bg-gray-50 rounded-md p-5 border border-gray-200">
                                            <div class="flex items-center gap-2 mb-4">
                                                <svg class="w-5 h-5 text-gray-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                                </svg>
                                                <label class="font-semibold text-gray-800">Metode Pembayaran</label>
                                            </div>

                                            <select name="payment_method" required
                                                class="w-full border border-gray-300 rounded-md p-2.5 text-sm text-gray-800 bg-white
                                                    focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                                                <option value="" disabled selected>--- Pilih metode pembayaran
                                                    ---</option>
                                                @foreach ($payment_method as $payment)
                                                    <option value="{{ $payment->id }}">
                                                        {{ $payment->payment_method_name }} -
                                                        {{ $payment->sub_category }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="bg-gray-50 rounded-md p-5 border border-gray-200">
                                            <div class="flex items-center gap-2 mb-4">
                                                <svg class="w-5 h-5 text-gray-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <label class="font-semibold text-gray-800">Sumber Dana</label>
                                            </div>

                                            <select name="funding_source" required
                                                class="w-full border border-gray-300 rounded-md p-2.5 text-sm text-gray-800 bg-white
                                                    focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                                                <option value="" disabled selected>--- Pilih sumber dana ---
                                                </option>
                                                @foreach ($funding_source as $funding)
                                                    <option value="{{ $funding->id }}">
                                                        {{ $funding->funding_source_name }} -
                                                        {{ $funding->sub_category }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Cabinet Arsip --}}
                                    <div class="bg-gray-50 rounded-md p-5 border border-gray-200">
                                        <div class="flex items-center gap-2 mb-4">
                                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                            </svg>
                                            <label class="font-semibold text-gray-800">Cabinet Arsip</label>
                                        </div>

                                        <select name="cabinet_id" required
                                            class="w-full border border-gray-300 rounded-md p-2.5 text-sm text-gray-800 bg-white
                                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                                            <option value="" disabled selected>— Pilih cabinet arsip —</option>
                                            @foreach ($cabinets as $cabinet)
                                                <option value="{{ $cabinet->id }}">{{ $cabinet->cabinet_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <p class="text-xs text-gray-500 mt-2">Pilih cabinet sesuai kategori agar arsip
                                            mudah dicari</p>
                                    </div>

                                    {{-- Submit Button --}}
                                    <button type="submit"
                                        class="w-full px-8 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-md shadow-sm transition-all duration-200 flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Upload dan Verifikasi Final
                                    </button>
                                @else
                                    {{-- Status Locked --}}
                                    <div class="bg-gray-50 border border-gray-200 rounded-md p-6 text-center">
                                        <div class="flex justify-center mb-3">
                                            <div
                                                class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center">
                                                <svg class="w-6 h-6 text-gray-500" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                                </svg>
                                            </div>
                                        </div>
                                        <p class="text-sm text-gray-700 font-semibold mb-1">File Sudah Diarsipkan</p>
                                        <p class="text-xs text-gray-500">Tidak dapat diperbarui lagi</p>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
