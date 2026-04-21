<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Verifikasi Pengajuan PPSPM') }}
        </h2>
    </x-slot>

    {{-- TOMBOL KEMBALI --}}
    <div class="py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <a href="{{ route('validation.index') }}"
                class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-4 py-2 rounded-md border border-gray-200 hover:bg-gray-200 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span class="font-medium">Kembali</span>
            </a>
        </div>
    </div>

    <div class="pb-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-md p-6 space-y-6">

                {{-- Nama Dokumen --}}
                <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
                    <div class="border-l-4 border-[#003A8F] pl-4">
                        <h3 class="text-xl font-semibold text-gray-800">
                            {{ $doc->budget_submission_name }}
                        </h3>
                    </div>
                </div>

                {{-- Nama File --}}
                <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center gap-2 mb-4">
                        {{-- <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg> --}}
                        <label class="font-semibold text-gray-800">Periksa Dokumen</label>
                    </div>
                    <p class="text-sm text-gray-600 mb-3">Nama File</p>
                    <p class="text-base font-medium text-gray-800 mb-4">
                        {{ basename($doc->path_file_submission) ?? '-' }}
                    </p>
                    <div class="flex gap-3">
                        <a href="{{ route('file.stream', $doc->id) }}" target="_blank"
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition-colors">
                            Lihat
                        </a>
                        <a href="{{ route('file.download', $doc->id) }}"
                            class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-md transition-colors">
                            Download
                        </a>
                    </div>
                </div>

                <div class="p-6 space-y-6">
                    {{-- Info Pemohon --}}
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <h4 class="font-semibold text-gray-800">Informasi Dokumen</h4>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div class="bg-gray-50 rounded-md p-4 border border-gray-200">
                                <p class="text-xs text-gray-600 mb-1 font-medium">Nama Pemohon</p>
                                <p class="text-sm font-semibold text-gray-900">{{ $doc->user->name }}</p>
                            </div>

                            <div class="bg-gray-50 rounded-md p-4 border border-gray-200">
                                <p class="text-xs text-gray-600 mb-1 font-medium">Email</p>
                                <p class="text-sm font-medium text-gray-900 break-all">
                                    {{ $doc->user->email }}</p>
                            </div>

                            <div class="bg-gray-50 rounded-md p-4 border border-gray-200">
                                <p class="text-xs text-gray-600 mb-1 font-medium">Divisi</p>
                                <p class="text-sm font-medium text-gray-900 capitalize">
                                    {{ $doc->user->role }}</p>
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
                                {{ $doc->payment_method->payment_method_name . ' - ' ?? '-' }}{{ $doc->payment_method->sub_category }}
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
                                {{ $doc->funding_source->funding_source_name . ' - ' ?? '-' }}{{ $doc->funding_source->sub_category }}
                            </p>
                        </div>
                    </div>

                    {{-- Timeline --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-center gap-3 bg-gray-50 rounded-md p-4 border border-gray-200">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <div>
                                <p class="text-xs text-gray-600 font-medium">Tanggal Dibuat</p>
                                <p class="text-sm font-semibold text-gray-900">
                                    {{ $doc->created_at->translatedFormat('d M Y — H:i') }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 bg-gray-50 rounded-md p-4 border border-gray-200">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <p class="text-xs text-gray-600 font-medium">Terakhir Diupdate</p>
                                <p class="text-sm font-semibold text-gray-900">
                                    {{ $doc->updated_at->translatedFormat('d M Y — H:i') }}
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
                            <h4 class="font-semibold text-gray-800">Status Dokumen</h4>
                        </div>

                        <div class="flex flex-wrap gap-2">
                            @if ($doc->requirements_status == 'Belum Lengkap' && $doc->verification_status == 0)
                                <span
                                    class="px-3 py-1.5 rounded-md text-xs font-medium bg-blue-100 text-blue-700 border border-blue-200">
                                    Dalam Proses
                                </span>
                            @endif

                            <span
                                class="px-3 py-1.5 rounded-md text-xs font-medium border
                                        {{ $doc->requirements_status == 'Lengkap'
                                            ? 'bg-green-100 text-green-700 border-green-200'
                                            : 'bg-yellow-100 text-yellow-700 border-yellow-200' }}">
                                {{ ucfirst($doc->requirements_status) }}
                            </span>

                            <span
                                class="px-3 py-1.5 rounded-md text-xs font-medium border
                                        {{ $doc->verification_status
                                            ? 'bg-green-100 text-green-700 border-green-200'
                                            : 'bg-red-100 text-red-700 border-red-200' }}">
                                {{ $doc->verification_status ? 'Terverifikasi' : 'Belum Diverifikasi' }}
                            </span>

                            <span
                                class="px-3 py-1.5 rounded-md text-xs font-medium border
                                        {{ $doc->is_archive ? 'bg-teal-100 text-teal-700 border-teal-200' : 'bg-gray-100 text-gray-700 border-gray-200' }}">
                                {{ $doc->is_archive ? 'Diarsipkan' : 'Belum Diarsipkan' }}
                            </span>
                        </div>
                    </div>
                </div>

                @if ($doc->is_archive == 0)
                    
                    <form action="{{route('validation.update', $doc->id)}}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="flex items-center gap-2 mb-4">
                            {{-- <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg> --}}
                            <label class="font-semibold text-gray-800">Verifikasi Dokumen</label>
                        </div>
                        {{-- Upload File --}}
                        <div class="bg-gray-50 rounded-md p-5 border border-gray-200">
                            <div class="flex items-center gap-2 mb-4">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <label class="font-semibold text-gray-800">Upload File Bertanda Tangan jika
                                    Diperlukan</label>
                            </div>

                            <input type="file" name="file_pengajuan" accept="application/pdf"
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
                                <input type="number" name="biaya" value="{{ $pengajuan->biaya ?? '' }}"
                                    placeholder="0" min="0"
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

                        {{-- Payment & Funding --}}
                        <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                {{-- Payment Method --}}
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">
                                        Metode Pembayaran <span class="text-red-500">*</span>
                                    </label>
                                    <select name="payment_method" id="payment_method"
                                        class="w-full border border-gray-300 rounded-md px-4 py-2.5 text-gray-900 focus:ring-2 focus:ring-[#003A8F] focus:border-[#003A8F] focus:outline-none transition-colors">
                                        <option value="">Pilih metode pembayaran</option>
                                        @foreach ($payment_method as $payment)
                                            <option value="{{ $payment->id }}"
                                                {{ $doc->payment_method_id == $payment->id ? 'selected' : '' }}>
                                                {{ $payment->payment_method_name }} - {{ $payment->sub_category }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Funding Source --}}
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">
                                        Sumber Dana <span class="text-red-500">*</span>
                                    </label>
                                    <select name="funding_source" id="funding_source"
                                        class="w-full border border-gray-300 rounded-md px-4 py-2.5 text-gray-900 focus:ring-2 focus:ring-[#003A8F] focus:border-[#003A8F] focus:outline-none transition-colors">
                                        <option value="">Pilih sumber dana</option>
                                        @foreach ($funding_source as $funding)
                                            <option value="{{ $funding->id }}"
                                                {{ $doc->funding_source_id == $funding->id ? 'selected' : '' }}>
                                                {{ $funding->funding_source_name }} - {{ $funding->sub_category }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
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

                            <select name="cabinet_id"
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

                        <div class="flex justify-end gap-3 mt-6">
                            <button type="submit"
                                class="px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white font-medium rounded-md transition-colors">
                                Verifikasi dan Validasi
                            </button>
                        </div>
                    </form>

                    {{-- Tombol Aksi --}}
                    <div class="flex justify-end gap-3 mt-6">
                        <form action="{{route('validation.return', $doc->id)}}" method="POST">
                            @method('PUT')
                            @csrf
                            <button type="submit" class="px-6 py-2.5 bg-yellow-500 hover:bg-yellow-600 text-white font-medium rounded-md transition-colors">
                                Kembalikan Dokumen
                            </button>
                        </form>
                    </div>
                @else
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

            </div>
        </div>
    </div>
</x-app-layout>
