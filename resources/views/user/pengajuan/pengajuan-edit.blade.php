<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Pengajuan') }}
        </h2>
    </x-slot>

    {{-- TOMBOL KEMBALI --}}
    <div class="py-4">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <a href="{{ route('user.worklist') }}"
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
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            {{-- MAIN CARD --}}
            <div class="bg-white overflow-hidden shadow-sm rounded-md border border-gray-200">
                {{-- Header --}}
                <div class="bg-[#003A8F] p-6">
                    <h2 class="text-xl font-semibold text-white">
                        Edit/Perbaiki Pengajuan Keuangan
                    </h2>
                    <p class="text-sm text-white/90 mt-1">
                        Perbarui informasi pengajuan Anda dengan data terbaru
                    </p>
                </div>

                <div class="p-8">
                    <form action="{{ route('pengajuan.update', $pengajuan->id) }}" method="POST"
                        enctype="multipart/form-data" class="space-y-6">
                        @method('PUT')
                        @csrf

                        {{-- Nama Pengajuan --}}
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                Nama Pengajuan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama_pengajuan" value="{{ $pengajuan->budget_submission_name }}"
                                class="w-full border border-gray-300 rounded-md px-4 py-2.5 text-gray-900 focus:ring-2 focus:ring-[#003A8F] focus:border-[#003A8F] focus:outline-none transition-colors"
                                placeholder="Contoh: Pengajuan Pembelian Alat Tulis Kantor" required>
                            <p class="text-xs text-gray-500">
                                Gunakan nama yang jelas dan deskriptif agar mudah diidentifikasi
                            </p>
                        </div>

                        {{-- Metode Pembayaran & Sumber Dana --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
                                            {{ $pengajuan->assigned_payment_method == $payment->id ? 'selected' : '' }}>
                                            {{ $payment->payment_method_name }} - {{ $payment->sub_category }}
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
                                            {{ $pengajuan->assigned_funding_source == $funding->id ? 'selected' : '' }}>
                                            {{ $funding->funding_source_name }} - {{ $funding->sub_category }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- File Upload --}}
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                File PDF Pengajuan
                            </label>

                            {{-- File Saat Ini --}}
                            @if ($pengajuan->path_file_submission)
                                <div class="mb-4">
                                    <p class="text-xs text-gray-500 mb-2">File Saat Ini:</p>
                                    <div
                                        class="flex items-center justify-between bg-gray-50 rounded-md p-4 border border-gray-200">
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-800 break-all">
                                                {{ basename($pengajuan->path_file_submission) }}
                                            </p>
                                        </div>
                                        <a href="{{ route('view.file', $pengajuan->id) }}" target="_blank"
                                            class="ml-4 px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-md transition-colors">
                                            Lihat File
                                        </a>
                                    </div>
                                </div>
                            @endif

                            {{-- Upload File Baru --}}
                            <div>
                                <label for="file"
                                    class="flex items-center space-x-3 p-4 border border-gray-300 rounded-md cursor-pointer hover:bg-[#003A8F]/5 hover:border-[#003A8F] transition-colors bg-gray-50">
                                    <div
                                        class="flex-shrink-0 w-10 h-10 bg-[#003A8F] rounded-md flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p id="filename" class="text-sm font-medium text-gray-700">
                                            {{ $pengajuan->path_file_submission ? 'Pilih file baru (opsional)' : 'Pilih berkas pengajuan...' }}
                                        </p>
                                        <p class="text-xs text-gray-500 mt-0.5">Format: PDF | Maksimal: 50MB</p>
                                    </div>
                                    <span
                                        class="text-sm font-medium text-[#003A8F] bg-[#003A8F]/10 px-4 py-2 rounded-md">
                                        Browse
                                    </span>
                                </label>
                                <input id="file" name="file" type="file" accept="application/pdf"
                                    class="hidden"
                                    onchange="document.getElementById('filename').innerText = this.files[0]?.name ?? '{{ $pengajuan->path_file_pengajuan ? 'Pilih file baru (opsional)' : 'Pilih berkas pengajuan...' }}'">
                                @if ($pengajuan->path_file_pengajuan)
                                    <p class="text-xs text-gray-500 mt-2">
                                        Biarkan kosong jika tidak ingin mengubah file
                                    </p>
                                @endif
                            </div>
                        </div>

                        {{-- Divider --}}
                        <div class="border-t border-gray-200 pt-6"></div>

                        {{-- Buttons --}}
                        <div class="flex items-center justify-end space-x-3">
                            <a href="{{ route('user.worklist') }}"
                                class="px-6 py-2.5 border border-gray-300 rounded-md text-gray-700 font-medium hover:bg-gray-50 transition-colors">
                                Batal
                            </a>
                            <button type="submit"
                                class="px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-md font-medium transition-colors shadow-sm">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
