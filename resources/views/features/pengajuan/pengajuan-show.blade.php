<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pengajuan') }}
        </h2>
    </x-slot>

    {{-- TOMBOL KEMBALI --}}
    <div class="py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <a href="{{ route('user.monitoring') }}"
                class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-4 py-2 rounded-md border border-gray-200 hover:bg-gray-200 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span class="font-medium">Kembali</span>
            </a>
        </div>
    </div>

    <div class="pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-md">
                <div class="p-8 space-y-6">

                    {{-- Header Informasi --}}
                    <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
                        {{-- Header dengan border biru --}}
                        <div class="border-l-4 border-[#003A8F] pl-4 mb-6">
                            <h3 class="text-xl font-semibold text-gray-800">
                                {{ $pengajuan->budget_submission_name }}
                            </h3>
                        </div>

                        {{-- Timestamp --}}
                        <div class="flex flex-wrap gap-6 pb-4 border-b border-gray-200 mb-4">
                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>Dibuat: <span
                                        class="font-medium text-gray-800">{{ $pengajuan->created_at->translatedFormat('d M Y — H:i') }}</span></span>
                            </div>

                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Update: <span
                                        class="font-medium text-gray-800">{{ $pengajuan->updated_at->translatedFormat('d M Y — H:i') }}</span></span>
                            </div>
                        </div>

                        {{-- Metode Pembayaran & Sumber Dana --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div class="bg-gray-50 rounded-md p-4 border border-gray-200">
                                <p class="text-xs text-gray-500 mb-1 font-medium">Metode Pembayaran</p>
                                <p class="text-sm font-semibold text-gray-800">
                                    {{ $pengajuan->payment_method->payment_method_name . ' - ' ?? '-' }}
                                    {{ $pengajuan->payment_method->sub_category }}
                                </p>
                            </div>

                            <div class="bg-gray-50 rounded-md p-4 border border-gray-200">
                                <p class="text-xs text-gray-500 mb-1 font-medium">Sumber Dana</p>
                                <p class="text-sm font-semibold text-gray-800">
                                    {{ $pengajuan->funding_source->funding_source_name . ' - ' ?? '-' }}
                                    {{ $pengajuan->funding_source->sub_category }}
                                </p>
                            </div>
                        </div>

                        {{-- Status Badges --}}
                        <div class="flex flex-wrap gap-2 pb-4 mb-4 border-b border-gray-200">
                            @if ($pengajuan->requirements_status == 'Belum Lengkap' && $pengajuan->requirements_status == 0)
                                <span class="px-3 py-1 rounded-md text-xs font-medium bg-blue-100 text-blue-700">
                                    Tahapan: Dalam Proses
                                </span>
                            @endif

                            <span
                                class="px-3 py-1 rounded-md text-xs font-medium {{ $pengajuan->requirements_status == 'Lengkap' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                Kelengkapan: {{ ucfirst($pengajuan->requirements_status) }}
                            </span>

                            <span
                                class="px-3 py-1 rounded-md text-xs font-medium {{ $pengajuan->verification_status ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $pengajuan->verification_status ? 'Sudah Diverifikasi' : 'Belum Diverifikasi' }}
                            </span>

                            <span
                                class="px-3 py-1 rounded-md text-xs font-medium {{ $pengajuan->is_archive ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                {{ $pengajuan->is_archive ? 'Diarsipkan' : 'Belum Diarsipkan' }}
                            </span>
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

                    {{-- Message --}}
                    <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
                        <div class="border-l-4 border-yellow-400 pl-4 mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Pesan Kritik dan Saran</h3>
                        </div>

                        @if (isset($pengajuan->message) && !empty($pengajuan->message))
                            <div class="bg-yellow-50 rounded-md p-4 border border-yellow-200">
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-yellow-600 mt-0.5 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                    </svg>
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-800 leading-relaxed whitespace-pre-line">
                                            {{ $pengajuan->message }}</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="bg-gray-50 rounded-md p-4 border border-gray-200">
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-gray-400 mt-0.5 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-500 italic">Tidak ada pesan kritik dan saran</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- File Pengajuan --}}
                    <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
                        <h3 class="font-semibold text-gray-800 mb-4">File Pengajuan</h3>

                        {{-- File Saat Ini --}}
                        <div
                            class="flex items-center justify-between bg-gray-50 rounded-md p-4 mb-4 border border-gray-200">
                            <div class="flex-1 min-w-0">
                                <p class="text-xs text-gray-500 mb-1">File Saat Ini:</p>
                                <p class="text-sm font-medium text-gray-800 break-all">
                                    {{ basename($pengajuan->path_file_submission) ?? '-' }}
                                </p>
                            </div>
                            <a href="{{ route('file.stream', $pengajuan->id) }}" target="_blank"
                                class="ml-4 px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-md transition-colors">
                                Lihat File
                            </a>
                        </div>

                        {{-- Form Upload Perbaikan --}}
                        @if (!$pengajuan->verification_status && !$pengajuan->is_archive)
                            <form action="{{ route('submit.fixing', $pengajuan->id) }}" method="POST"
                                enctype="multipart/form-data" class="space-y-4">
                                @method('PUT')
                                @csrf

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Upload File Pengajuan Baru (Perbaikan)
                                    </label>

                                    {{-- Metode Pembayaran & Sumber Dana --}}
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        {{-- Metode Pembayaran --}}
                                        <div class="space-y-2">
                                            <label class="block text-sm font-medium text-gray-700">
                                                Metode Pembayaran <span class="text-red-500">*</span>
                                            </label>
                                            <select name="payment_method" id="payment_method"
                                                class="w-full border border-gray-300 rounded-md px-4 py-2.5 text-gray-900 focus:ring-2 focus:ring-[#003A8F] focus:border-[#003A8F] focus:outline-none transition-colors"
                                                required>
                                                <option value="">Pilih metode pembayaran</option>
                                                @foreach ($payment_method as $payment)
                                                    <option value="{{ $payment->id }}"
                                                        {{ $pengajuan->payment_method_id == $payment->id ? 'selected' : '' }}>
                                                        {{ $payment->payment_method_name }} -
                                                        {{ $payment->sub_category }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- Sumber Dana --}}
                                        <div class="space-y-2">
                                            <label class="block text-sm font-medium text-gray-700">
                                                Sumber Dana <span class="text-red-500">*</span>
                                            </label>
                                            <select name="funding_source" id="funding_source"
                                                class="w-full border border-gray-300 rounded-md px-4 py-2.5 text-gray-900 focus:ring-2 focus:ring-[#003A8F] focus:border-[#003A8F] focus:outline-none transition-colors"
                                                required>
                                                <option value="">Pilih sumber dana</option>
                                                @foreach ($funding_source as $funding)
                                                    <option value="{{ $funding->id }}"
                                                        {{ $pengajuan->funding_source_id == $funding->id ? 'selected' : '' }}>
                                                        {{ $funding->funding_source_name }} -
                                                        {{ $funding->sub_category }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Upload File --}}
                                    <div class="space-y-2">
                                        <label class="block text-sm font-medium text-gray-700">
                                            File Pengajuan (PDF) <span class="text-red-500">*</span>
                                        </label>
                                        <input type="file" name="file_pengajuan" accept="application/pdf"
                                            class="w-full border border-gray-300 rounded-md px-4 py-2.5 text-gray-900 focus:ring-2 focus:ring-[#003A8F] focus:border-[#003A8F] focus:outline-none transition-colors file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-[#003A8F] file:text-white hover:file:bg-[#002766]"
                                            required>
                                        <p class="text-xs text-gray-500 mt-1">Format: PDF | Maksimal: 50MB</p>
                                    </div>
                                </div>

                                <button type="submit"
                                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-green-600 hover:bg-green-700 text-white font-medium rounded-md transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    Upload Perbaikan
                                </button>
                            </form>
                        @else
                            <div class="bg-blue-50 border border-blue-200 rounded-md p-4">
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-blue-800 mb-1">File Tidak Dapat Diperbarui
                                        </p>
                                        <p class="text-xs text-blue-700">
                                            @if ($pengajuan->status_verifikasi && $pengajuan->status_diarsipkan)
                                                File pengajuan sudah diverifikasi dan diarsipkan.
                                            @elseif ($pengajuan->status_verifikasi)
                                                File pengajuan sudah diverifikasi.
                                            @elseif ($pengajuan->status_diarsipkan)
                                                File pengajuan sudah diarsipkan.
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Catatan --}}
                    @if (isset($pengajuan->message) && $pengajuan->message)
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 rounded-md p-4">
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-yellow-600 mt-0.5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                <div>
                                    <h3 class="text-sm font-semibold text-yellow-800 mb-1">Catatan Pengajuan</h3>
                                    <p class="text-sm text-yellow-900">{{ $pengajuan->message }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Tabel Dokumen --}}
                    <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
                        <h3 class="font-semibold text-gray-800 mb-4">Checklist Dokumen</h3>

                        <div class="overflow-x-auto rounded-md border border-gray-200">
                            <table class="min-w-full bg-white text-sm">
                                <thead class="bg-gray-100 text-gray-700 text-xs">
                                    <tr>
                                        <th rowspan="2" class="px-4 py-3 border border-gray-300 text-center">No
                                        </th>
                                        <th rowspan="2" class="px-4 py-3 border border-gray-300">Nama Dokumen & TTD
                                        </th>
                                        <th colspan="3" class="px-4 py-3 border border-gray-300 text-center">
                                            Dokumen</th>
                                        <th colspan="2" class="px-4 py-3 border border-gray-300 text-center">Tanda
                                            Tangan</th>
                                        <th rowspan="2" class="px-4 py-3 border border-gray-300 text-center">
                                            Keterangan</th>
                                    </tr>
                                    <tr>
                                        <th class="px-4 py-2 border border-gray-300 text-center">Ada</th>
                                        <th class="px-4 py-2 border border-gray-300 text-center">Tidak Ada</th>
                                        <th class="px-4 py-2 border border-gray-300 text-center">Tidak diperlukan</th>
                                        <th class="px-4 py-2 border border-gray-300 text-center">Lengkap</th>
                                        <th class="px-4 py-2 border border-gray-300 text-center">Belum</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($syaratDoc as $index => $dokumen)
                                    <tr class="hover:bg-gray-50">
                                        <td
                                        class="px-4 py-3 border border-gray-300 text-gray-900 font-medium text-center">
                                        {{ $no++ }}
                                    </td>
                                    
                                            <td class="px-4 py-3 border border-gray-300 text-gray-900">
                                                {{$dokumen}}
                                                {{-- @php
                                                    if (preg_match('/^[IVX]+\.\d+/', $dokumen)) {
                                                        echo "<span class='font-bold text-blue-700'>$dokumen</span>";
                                                    } elseif (preg_match('/^\d+\.\d+/', $dokumen)) {
                                                        echo "<span class='pl-6 text-gray-800'>$dokumen</span>";
                                                    } else {
                                                        echo "<span class='text-gray-800'>$dokumen</span>";
                                                    }
                                                @endphp --}}
                                            </td>

                                            <td class="px-4 py-3 border border-gray-300 text-center">
                                                <input type="radio" class="w-4 h-4 text-green-600" disabled
                                                    {{ isset($ada[$index]) && $ada[$index] ? 'checked' : '' }}>
                                            </td>

                                            <td class="px-4 py-3 border border-gray-300 text-center">
                                                <input type="radio" class="w-4 h-4 text-red-600" disabled
                                                    {{ isset($tidakada[$index]) && $tidakada[$index] ? 'checked' : '' }}>
                                            </td>

                                            <td class="px-4 py-3 border border-gray-300 text-center">
                                                <input type="radio" class="w-4 h-4 text-yellow-600" disabled
                                                    {{ isset($tidakperlu[$index]) && $tidakperlu[$index] ? 'checked' : '' }}>
                                            </td>

                                            <td class="px-4 py-3 border border-gray-300 text-center">
                                                <input type="radio" class="w-4 h-4 text-blue-600" disabled
                                                    {{ isset($lengkap[$index]) && $lengkap[$index] ? 'checked' : '' }}>
                                            </td>

                                            <td class="px-4 py-3 border border-gray-300 text-center">
                                                <input type="radio" class="w-4 h-4 text-gray-600" disabled
                                                    {{ isset($belum[$index]) && $belum[$index] ? 'checked' : '' }}>
                                            </td>

                                            <td class="px-4 py-3 border border-gray-300 text-gray-900">
                                                {{ $keterangan[$index] ?? '-' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
