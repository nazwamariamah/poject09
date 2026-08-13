<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Pengajuan Keuangan') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            {{-- Main Card --}}
            <div class="bg-white shadow-sm rounded-md overflow-hidden border border-gray-200">
                {{-- Header --}}
                <div class="bg-[#003A8F] p-6">
                    <h2 class="text-xl font-semibold text-white">
                        Buat Pengajuan Keuangan
                    </h2>
                    <p class="text-sm text-white/90 mt-1">
                        Lengkapi formulir untuk mengajukan keuangan
                    </p>
                </div>

                {{-- Form Section --}}
                <div class="p-8">
                    <form action="{{ route('pengajuan.store') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf

                        {{-- Nama Pengajuan --}}
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                Nama Pengajuan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama_pengajuan"
                                class="w-full border border-gray-300 rounded-md px-4 py-2.5 text-gray-900 focus:ring-2 focus:ring-[#003A8F] focus:border-[#003A8F] focus:outline-none transition-colors"
                                placeholder="Contoh: Pengajuan Pembelian Laptop untuk Tim IT" required>
                            <p class="text-xs text-gray-500">
                                Gunakan nama yang jelas dan spesifik untuk memudahkan identifikasi
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
                                    <option value="" selected disabled>Pilih metode pembayaran</option>
                                    @foreach ($payment_method as $payment)
                                        <option value="{{ $payment->id }}">
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
                                    <option value="" selected disabled>Pilih sumber dana</option>
                                    @foreach ($funding_source as $funding)
                                        <option value="{{ $funding->id }}">
                                            {{ $funding->funding_source_name }} - {{ $funding->sub_category }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- File Upload --}}
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                Dokumen PDF Pengajuan <span class="text-red-500">*</span>
                            </label>
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
                                        Pilih berkas pengajuan...
                                    </p>
                                    <p class="text-xs text-gray-500 mt-0.5">Format: PDF | Maksimal: 50MB</p>
                                </div>
                                <span class="text-sm font-medium text-[#003A8F] bg-[#003A8F]/10 px-4 py-2 rounded-md">
                                    Browse
                                </span>
                            </label>
                            <input id="file" name="file" type="file" accept="application/pdf" class="hidden"
                                onchange="document.getElementById('filename').innerText = this.files[0]?.name ?? 'Pilih berkas pengajuan...'"
                                required>
                        </div>

                        {{-- Divider --}}
                        <div class="border-t border-gray-200 pt-6"></div>

                        {{-- Submit Button --}}
                        <div class="flex items-center justify-end space-x-3">
                            <a href="{{ route('pengajuan.index') }}"
                                class="px-6 py-2.5 border border-gray-300 rounded-md text-gray-700 font-medium hover:bg-gray-50 transition-colors">
                                Batal
                            </a>
                            <button type="submit"
                                class="px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-md font-medium transition-colors shadow-sm">
                                Kirim Pengajuan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
