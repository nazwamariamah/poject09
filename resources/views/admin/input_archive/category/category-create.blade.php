<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Tambah Kategori Arsip') }}
        </h2>
    </x-slot>

    {{-- TOMBOL KEMBALI --}}
    <div class="#">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
            <a href="{{ route('cabinet.show', $cabinet->id) }}"
                class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-2 py-2 rounded-full border border-gray-200
                    shadow-lg transition-all duration-200 ease-in-out hover:bg-gray-400 hover:shadow-md active:bg-gray-300 active:scale-95">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>             
        </div>
    </div>

    <div class="min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            {{-- Breadcrumb --}}
            <div class="mb-6 flex items-center gap-2 text-sm">
                <a href="{{ route('admin.archive') }}" class="text-gray-500 hover:text-purple-600 transition-colors">
                    Input Arsip
                </a>
                <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd" />
                </svg>
                <a href="{{ route('cabinet.show', $cabinet->id) }}"
                    class="text-gray-500 hover:text-purple-600 transition-colors">
                    {{ $cabinet->cabinet_name }}
                </a>
                <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd" />
                </svg>
                <span class="text-gray-700 font-semibold">Tambah Kategori</span>
            </div>

            <div class="bg-white shadow-2xl rounded-3xl overflow-hidden border border-gray-200">

                {{-- Header Section --}}
                <div class="relative bg-gradient-to-b from-[#003A8F] to-[#002766] p-4">
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-20 h-20 bg-white opacity-10 rounded-full"></div>
                    <div class="absolute bottom-0 left-0 -mb-8 -ml-8 w-20 h-20 bg-white opacity-10 rounded-full"></div>

                    <div class="relative z-10 flex items-center gap-4">
                        <div class="p-4 bg-white bg-opacity-20 rounded-2xl backdrop-blur-sm">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-white">
                                Buat Kategori Baru
                            </h3>
                            <p class="text-pink-100 mt-2">Tambahkan kategori untuk: <span
                                    class="font-semibold">{{ $cabinet->cabinet_name }}</span></p>
                        </div>
                    </div>
                </div>

                {{-- FORM --}}
                <form action="{{ route('category.store') }}" method="POST" class="p-8">
                    @csrf

                    <input type="hidden" name="cabinet_id" value="{{ $cabinet->id }}">

                    <div class="space-y-6">

                        {{-- Nama Kategori --}}
                        <div class="group">
                            <label for="name" class="flex items-center gap-2 text-gray-700 font-semibold mb-3">
                                <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                                </svg>
                                Nama Kategori Arsip
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="text" name="name" id="name"
                                    class="w-full px-5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 bg-gray-50 focus:bg-white pl-12"
                                    placeholder="Contoh: Surat Masuk, Laporan Keuangan, Dokumen Legal" required>
                                <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                                </svg>
                            </div>
                            <p class="mt-2 text-xs text-gray-500 ml-1">Gunakan nama yang spesifik dan mudah dikenali</p>
                        </div>

                        {{-- Jenis Kategori --}}
                        <div class="group">
                            <label class="flex items-center gap-2 text-gray-700 font-semibold mb-2">
                                <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                Jenis Kategori
                            </label>

                            {{-- Info Box --}}
                            <div class="mb-3 bg-amber-50 border border-amber-200 rounded-lg p-3">
                                <p class="text-xs text-amber-800">
                                    <strong>Pilih salah satu</strong> jenis kategori atau <strong>kosongkan
                                        keduanya</strong> jika akan membuat sub-kategori. Kode arsip akan dibuat di
                                    sub-kategori nanti.
                                </p>
                            </div>

                            {{-- Selection Grid --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                {{-- Payment Method Card --}}
                                <div
                                    class="bg-white border border-gray-200 rounded-lg p-3 hover:border-blue-400 transition-colors">
                                    <div class="flex items-center gap-2 mb-2">
                                        <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                                            <path fill-rule="evenodd"
                                                d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <h4 class="font-semibold text-gray-800 text-sm">Metode Pembayaran</h4>
                                    </div>

                                    <select name="payment_method"
                                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all bg-white">
                                        <option value="">-- Kosongkan jika tidak dipilih --</option>
                                        @foreach ($payment as $pay)
                                            <option value="{{ $pay->id }}">
                                                {{ $pay->payment_method_name }}{{ $pay->sub_category ? ' → ' . $pay->sub_category : '' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Funding Source Card --}}
                                <div
                                    class="bg-white border border-gray-200 rounded-lg p-3 hover:border-purple-400 transition-colors">
                                    <div class="flex items-center gap-2 mb-2">
                                        <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <h4 class="font-semibold text-gray-800 text-sm">Sumber Dana</h4>
                                    </div>

                                    <select name="funding_source"
                                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all bg-white">
                                        <option value="">-- Kosongkan jika tidak dipilih --</option>
                                        @foreach ($funding as $fun)
                                            <option value="{{ $fun->id }}">
                                                {{ $fun->funding_source_name }}{{ $fun->sub_category ? ' → ' . $fun->sub_category : '' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="group">
                            <label for="deskripsi" class="flex items-center gap-2 text-gray-700 font-semibold mb-3">
                                <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                        clip-rule="evenodd" />
                                </svg>
                                Deskripsi
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <textarea name="deskripsi" id="deskripsi" rows="4"
                                    class="w-full px-5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 bg-gray-50 focus:bg-white pl-12 resize-none"
                                    placeholder="Jelaskan jenis dokumen apa saja yang masuk dalam kategori ini. Contoh: Kategori untuk menyimpan semua surat masuk dari instansi eksternal"></textarea>
                                <svg class="absolute left-4 top-4 w-5 h-5 text-gray-400" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="mt-2 text-xs text-gray-500 ml-1">Berikan deskripsi yang detail tentang isi
                                kategori</p>
                        </div>

                        {{-- URL Icon --}}
                        <div class="group">
                            <label for="url" class="flex items-center gap-2 text-gray-700 font-semibold mb-3">
                                <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                </svg>
                                URL Icon
                            </label>

                            {{-- Instructions Box --}}
                            <div class="mb-4 bg-gradient-to-r from-blue-50 to-indigo-50 border-2 border-blue-200 rounded-xl p-5 shadow-sm">
                                <div class="flex items-start gap-3 mb-3">
                                    <div class="flex-shrink-0 p-2 bg-blue-100 rounded-lg">
                                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h5 class="font-bold text-blue-900 mb-2">Panduan Memasukkan URL Icon dari Icons8</h5>
                                        <ol class="text-sm text-blue-800 space-y-2">
                                            <li class="flex items-start gap-2">
                                                <span class="inline-flex items-center justify-center w-6 h-6 bg-blue-600 text-white text-xs font-bold rounded-full flex-shrink-0 mt-0.5">1</span>
                                                <div>
                                                    <span>Buka situs</span>
                                                    <a href="https://icons8.com" target="_blank" class="text-red-600 hover:text-red-700 font-bold underline ml-1">icons8.com</a>
                                                    <span> dan cari icon yang diinginkan</span>
                                                </div>
                                            </li>
                                            <li class="flex items-start gap-2">
                                                <span class="inline-flex items-center justify-center w-6 h-6 bg-blue-600 text-white text-xs font-bold rounded-full flex-shrink-0 mt-0.5">2</span>
                                                <span>Klik icon tersebut hingga terbuka halaman detailnya, lalu pilih copy  <strong>link to png </strong>"jumlahnya hurufnya harus sama"</span>
                                            </li>
                                            <li class="flex items-start gap-2">
                                                <span class="inline-flex items-center justify-center w-6 h-6 bg-blue-600 text-white text-xs font-bold rounded-full flex-shrink-0 mt-0.5">3</span>
                                                <span>Ganti warna icon menjadi <code class="bg-blue-100 px-2 py-1 rounded text-xs">color=000000</code> → <code class="bg-blue-100 px-2 py-1 rounded text-xs">
                                                    putih pada bagian “color=000000 menjadi color=ffffff”</code></span>
                                            </li>
                                            <li class="flex items-start gap-2">
                                                <span class="inline-flex items-center justify-center w-6 h-6 bg-blue-600 text-white text-xs font-bold rounded-full flex-shrink-0 mt-0.5">4</span>
                                                <span>Ganti ukuran (size) menjadi. <code class="bg-blue-100 px-2 py-1 rounded text-xs">contohnya size=100 </code></span>
                                            </li>
                                        </ol>
                                    </div>
                                </div>

                                {{-- Example URL --}}
                                <div class="mt-4 pt-4 border-t border-blue-200">
                                    <p class="text-sm font-bold text-blue-900 mb-2">Contoh URL yang benar:</p>
                                    <div class="bg-white p-3 rounded-lg border border-blue-200 shadow-sm">
                                        <code class="text-xs text-gray-700 break-all">https://img.icons8.com/?size=100&id=2HU1G5leSjOg&format=png&color=ffffff</code>
                                    </div>
                                </div>
                            </div>

                            {{-- URL Input --}}
                            <div class="relative">
                                <input type="text" 
                                       name="url" 
                                       id="url"
                                       class="w-full px-5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 bg-gray-50 focus:bg-white pl-12"
                                       placeholder="https://img.icons8.com/?size=100&id=...&format=png&color=ffffff">
                                <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <p class="mt-2 text-xs text-gray-500 ml-1 flex items-center gap-1">
                                <svg class="w-3 h-3 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                Kosongkan jika tidak ingin menambahkan icon saat ini
                            </p>
                        </div>

                    </div>

                    {{-- Action Buttons --}}
                    <div class="text-right pt-8 mt-8 border-t-2 border-gray-200">

                        {{-- Tombol Buat Kategori --}}
                        <button type="submit"
                            class="group inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                            <svg class="w-5 h-5 group-hover:rotate-90 transition-transform duration-300"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            Buat Kategori
                        </button>
                    </div>
                </form>
            </div>

            {{-- Info Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">

                {{-- Card 1 --}}
                <div
                    class="bg-white p-5 rounded-xl shadow-lg border-l-4 border-purple-500 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-start gap-3">
                        <div class="p-2 bg-purple-100 rounded-lg">
                            <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm mb-1">Kategori Spesifik</h4>
                            <p class="text-xs text-gray-600">Buat kategori yang jelas untuk memudahkan klasifikasi
                                dokumen</p>
                        </div>
                    </div>
                </div>

                {{-- Card 2 --}}
                <div
                    class="bg-white p-5 rounded-xl shadow-lg border-l-4 border-pink-500 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-start gap-3">
                        <div class="p-2 bg-pink-100 rounded-lg">
                            <svg class="w-6 h-6 text-pink-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm mb-1">Deskripsi Lengkap</h4>
                            <p class="text-xs text-gray-600">Jelaskan detail isi kategori untuk referensi tim</p>
                        </div>
                    </div>
                </div>

                {{-- Card 3 --}}
                <div
                    class="bg-white p-5 rounded-xl shadow-lg border-l-4 border-blue-500 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-start gap-3">
                        <div class="p-2 bg-blue-100 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm mb-1">Icon Visual</h4>
                            <p class="text-xs text-gray-600">Tambahkan icon untuk identifikasi visual yang lebih mudah
                            </p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
