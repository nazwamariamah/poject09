<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Periksa Kelengkapan Pengajuan') }}
        </h2>
    </x-slot>

    {{-- TOMBOL KEMBALI --}}
    <div class="py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <a href="{{ route('keuangan.pengajuan') }}"
                class="inline-flex items-center gap-2 bg-white text-gray-700 px-4 py-2 rounded-md border border-gray-300 shadow-sm hover:bg-gray-50 hover:border-gray-400 transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span class="font-medium">Kembali</span>
            </a>
        </div>
    </div>

    <div class="min-h-screen pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-md">
                <div class="p-6 md:p-8 space-y-6">

                    {{-- Informasi Pengajuan --}}
                    <div class="bg-white rounded-md shadow-sm border border-gray-200 overflow-hidden">
                        {{-- Header --}}
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-5 border-b border-gray-200">
                            <div class="flex items-start gap-4">
                                <div class="p-3 bg-white rounded-md shadow-sm border border-gray-200">
                                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-1">
                                        {{ $pengajuan->budget_submission_name }}
                                    </h3>
                                    <p class="text-sm text-gray-600">Dokumen Pengajuan Resmi</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 space-y-6">
                            {{-- Info Pengaju --}}
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="bg-gray-50 rounded-md p-4 border border-gray-200">
                                    <div class="flex items-center gap-2 mb-2">
                                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        <p class="text-xs text-gray-600 font-medium">Pengaju</p>
                                    </div>
                                    <p class="text-sm font-semibold text-gray-900">{{ $pengajuan->user->name }}</p>
                                </div>

                                <div class="bg-gray-50 rounded-md p-4 border border-gray-200">
                                    <div class="flex items-center gap-2 mb-2">
                                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        <p class="text-xs text-gray-600 font-medium">Email</p>
                                    </div>
                                    <p class="text-sm font-medium text-gray-900 break-all">{{ $pengajuan->user->email }}
                                    </p>
                                </div>

                                <div class="bg-gray-50 rounded-md p-4 border border-gray-200">
                                    <div class="flex items-center gap-2 mb-2">
                                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                        <p class="text-xs text-gray-600 font-medium">Divisi</p>
                                    </div>
                                    <p class="text-sm font-medium text-gray-900">{{ $pengajuan->user->role }}</p>
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

                            {{-- Timestamp --}}
                            <div class="flex flex-wrap items-center gap-6 pt-4 border-t border-gray-200">
                                <div class="flex items-center gap-2 text-gray-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-sm">Dibuat: <span
                                            class="font-semibold text-gray-900">{{ $pengajuan->created_at->translatedFormat('d M Y — H:i') }}</span></span>
                                </div>
                                <div class="flex items-center gap-2 text-gray-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-sm">Update: <span
                                            class="font-semibold text-gray-900">{{ $pengajuan->updated_at->translatedFormat('d M Y — H:i') }}</span></span>
                                </div>
                            </div>
                            {{-- Diperiksa Oleh --}}
                            <div>
                                <p class="text-sm font-semibold text-gray-700 mb-3">Diperiksa Oleh</p>
                                <div class="bg-gray-50 rounded-md p-4 border border-gray-200">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <p class="text-xs text-gray-500 mb-1 font-medium">Nama</p>
                                            <p class="text-sm font-semibold text-gray-800">
                                                {{ $pengajuan->finance_officer->name ?? '-' }}
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 mb-1 font-medium">Email</p>
                                            <p class="text-sm font-semibold text-gray-800 break-all">
                                                {{ $pengajuan->finance_officer->email ?? '-' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Diperiksa Oleh --}}
                            <div>
                                <p class="text-sm font-semibold text-gray-700 mb-3 mt-3">Diperiksa Oleh Bendahara</p>
                                <div class="bg-gray-50 rounded-md p-4 border border-gray-200">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <p class="text-xs text-gray-500 mb-1 font-medium">Nama</p>
                                            <p class="text-sm font-semibold text-gray-800">
                                                {{ $pengajuan->revenue_officer->name ?? '-' }}
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 mb-1 font-medium">Email</p>
                                            <p class="text-sm font-semibold text-gray-800 break-all">
                                                {{ $pengajuan->revenue_officer->email ?? '-' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- File Pengajuan --}}
                    <div class="bg-white rounded-md shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-white rounded-md shadow-sm border border-gray-200">
                                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <h3 class="font-semibold text-lg text-gray-900">File Pengajuan</h3>
                            </div>
                        </div>

                        <div class="p-6">
                            <div
                                class="flex items-center justify-between bg-gradient-to-r from-gray-50 to-red-50/30 rounded-md p-4 border border-gray-200">
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
                                            {{ basename($pengajuan->path_file_submission) }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex gap-2 flex-shrink-0 ml-4">
                                    <a href="{{ route('view.file', $pengajuan->id) }}" target="_blank"
                                        class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-md shadow-sm transition-all duration-200">
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
                                        class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-md shadow-sm transition-all duration-200">
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
                    </div>

                    {{-- Form Checklist --}}
                    <form action="{{ route('keuangan.checkandupate', $pengajuan->id) }}" method="POST">
                        @method('PUT')
                        @csrf

                        {{-- Tabel Checklist --}}
                        <div class="bg-white rounded-md shadow-sm border border-gray-200 overflow-hidden">
                            <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                                <div class="flex items-center gap-3">
                                    <div class="p-2 bg-white rounded-md shadow-sm border border-gray-200">
                                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                        </svg>
                                    </div>
                                    <h3 class="font-semibold text-lg text-gray-900">Checklist Dokumen & Tanda Tangan
                                    </h3>
                                </div>
                            </div>

                            <div class="p-6">
                                <div class="overflow-x-auto rounded-md border border-gray-200">
                                    <table class="min-w-full bg-white text-sm">
                                        <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                                            <tr>
                                                <th rowspan="2"
                                                    class="px-4 py-3 border border-gray-300 text-center">No</th>
                                                <th rowspan="2" class="px-4 py-3 border border-gray-300">Nama
                                                    Dokumen & TTD</th>
                                                <th colspan="3"
                                                    class="px-4 py-3 border border-gray-300 text-center">Dokumen</th>
                                                <th colspan="2"
                                                    class="px-4 py-3 border border-gray-300 text-center">Tanda Tangan
                                                </th>
                                                <th rowspan="2"
                                                    class="px-4 py-3 border border-gray-300 text-center">Keterangan
                                                </th>
                                            </tr>
                                            <tr>
                                                <th class="px-4 py-2 border border-gray-300 text-center">Ada</th>
                                                <th class="px-4 py-2 border border-gray-300 text-center">Tidak Ada</th>
                                                <th class="px-4 py-2 border border-gray-300 text-center">Tidak
                                                    Diperlukan</th>
                                                <th class="px-4 py-2 border border-gray-300 text-center">Lengkap</th>
                                                <th class="px-4 py-2 border border-gray-300 text-center">Belum</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($syaratDoc as $index => $dokumen)
                                
                                                <tr class="hover:bg-gray-50 transition-colors">
                                                    <td
                                                        class="px-4 py-3 border border-gray-300 text-center font-medium text-gray-900">
                                                        {{ $index + 1 }}
                                                    </td>

                                                    <td class="px-4 py-3 border border-gray-300 text-gray-900">
                                                        @php
                                                            if (preg_match('/^[IVX]+\.\d+/', $dokumen)) {
                                                                echo "<span class='font-bold text-blue-700'>$dokumen</span>";
                                                            } elseif (preg_match('/^\d+\.\d+/', $dokumen)) {
                                                                echo "<span class='pl-6 text-gray-800'>$dokumen</span>";
                                                            } else {
                                                                echo "<span class='text-gray-800'>$dokumen</span>";
                                                            }
                                                        @endphp
                                                    </td>

                                                    <td class="px-4 py-3 border border-gray-300 text-center">
                                                        <input type="radio" name="ada[{{ $index }}]"
                                                            value="1"
                                                            {{ isset($ada[$index]) && $ada[$index] ? 'checked' : '' }}
                                                            class="w-5 h-5 text-green-600 focus:ring-green-500">
                                                    </td>

                                                    <td class="px-4 py-3 border border-gray-300 text-center">
                                                        <input type="radio" name="ada[{{ $index }}]"
                                                            value="0"
                                                            {{ isset($tidakada[$index]) && $tidakada[$index] ? 'checked' : '' }}
                                                            class="w-5 h-5 text-red-600 focus:ring-red-500">
                                                    </td>

                                                    <td class="px-4 py-3 border border-gray-300 text-center">
                                                        <input type="radio" name="ada[{{ $index }}]"
                                                            value="2"
                                                            {{ isset($tidakperlu[$index]) && $tidakperlu[$index] ? 'checked' : '' }}
                                                            class="w-5 h-5 text-yellow-600 focus:ring-yellow-500">
                                                    </td>

                                                    <td class="px-4 py-3 border border-gray-300 text-center">
                                                        <input type="radio" name="ttd[{{ $index }}]"
                                                            value="1"
                                                            {{ isset($lengkap[$index]) && $lengkap[$index] ? 'checked' : '' }}
                                                            class="w-5 h-5 text-blue-600 focus:ring-blue-500">
                                                    </td>

                                                    <td class="px-4 py-3 border border-gray-300 text-center">
                                                        <input type="radio" name="ttd[{{ $index }}]"
                                                            value="0"
                                                            {{ isset($belum[$index]) && $belum[$index] ? 'checked' : '' }}
                                                            class="w-5 h-5 text-gray-600 focus:ring-gray-500">
                                                    </td>

                                                    <td class="px-4 py-3 border border-gray-300">
                                                        <input type="text" name="keterangan[{{ $index }}]"
                                                            value="{{ $keterangan[$index] ?? '' }}"
                                                            class="w-full border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                                            placeholder="Catatan...">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        {{-- File Kelengkapan (Metadata) --}}
                        <div class="bg-blue-50 border border-blue-200 rounded-md p-5 my-4">
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-blue-900 mb-1">Informasi Tambahan</p>
                                    <p class="text-xs text-blue-700 mb-3">File metadata excel kelengkapan pengajuan
                                        (opsional)</p>
                                    <a href="{{ route('download.metadata', $pengajuan->id) }}"
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md shadow-sm transition-all duration-200 font-medium text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        Download File Metadata
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Catatan Pengembalian --}}
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 rounded-md p-5 mb-4">
                            <div class="flex items-start gap-3 mb-3">
                                <div class="text-2xl">📝</div>
                                <div class="flex-1">
                                    <h3 class="text-base font-semibold text-yellow-900 mb-1">Catatan Jika Belum Lengkap
                                    </h3>
                                    <p class="text-xs text-yellow-700">Tuliskan alasan pengembalian jika dokumen belum
                                        lengkap atau saran perbaikan</p>
                                </div>
                            </div>
                            <textarea name="catatan" rows="4"
                                class="w-full p-3 border border-yellow-200 rounded-md bg-white shadow-sm focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 text-sm"
                                placeholder="Contoh: Dokumen tanda tangan kepala divisi belum lengkap dan sarankan metode pembayaran dan sumber dana yang lebih baik jika perlu...">{{ $pengajuan->message }}</textarea>
                        </div>

                        {{-- Tombol Submit --}}
                        @if ($pengajuan->is_archive == 1)
                            <div class="flex justify-end">
                                <div
                                    class="inline-flex items-center gap-2 px-8 py-3 border border-gray-300 bg-gray-100 text-gray-500 font-semibold rounded-md shadow-sm text-base cursor-not-allowed">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    File Sudah Diarsipkan
                                </div>
                            </div>
                        @else
                            <div class="flex justify-end">
                                <button type="submit" name="aksi" value="lengkap"
                                    class="inline-flex items-center gap-2 px-8 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-md shadow-sm transition-all duration-200 text-base">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Selesaikan Pemeriksaan
                                </button>
                            </div>
                        @endif
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
