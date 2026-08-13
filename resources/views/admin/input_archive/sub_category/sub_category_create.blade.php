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
            <a href="{{ route('category.show', $category->id) }}"
                class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-2 py-2 rounded-full border border-gray-200
                    shadow-lg transition-all duration-200 ease-in-out hover:bg-gray-400 hover:shadow-md active:bg-gray-300 active:scale-95">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>             
        </div>
    </div>

    <div class="min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- CARD UTAMA --}}
            <div class="bg-white border border-gray-100 rounded-xl shadow-2xl overflow-hidden">

                {{-- HEADER CARD --}}
                <div class="relative px-6 py-5 bg-gradient-to-b from-[#003A8F] to-[#002766]">
                    <div class="absolute inset-0 bg-black/10"></div>

                    <div class="relative flex items-center gap-4">
                        <div
                            class="w-11 h-11 flex items-center justify-center
                                   bg-white/20 backdrop-blur rounded-xl shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-xl font-semibold text-white">
                                Tambah Sub Kategori
                            </h3>
                            <p class="text-sm text-indigo-200">
                                Lengkapi data sub kategori arsip
                            </p>
                        </div>
                    </div>
                </div>

                {{-- FORM --}}
                <form action="{{ route('subcategory.store', $category->id) }}"
                      method="POST"
                      class="space-y-6 p-6">
                    @csrf

                    <input type="hidden" name="category_id" value="{{ $category->id }}">

                    {{-- NAMA SUB KATEGORI --}}
                    <div>
                        <label class="flex items-center gap-2 mb-2 text-sm font-semibold text-gray-700">
                            <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            Nama Sub Kategori
                        </label>

                        <input type="text"
                               name="name"
                               required
                               placeholder="format: Sub kategory dan nama sumber dana"
                               class="w-full px-4 py-2 border-2 border-gray-200 rounded-xl
                                      transition focus:border-indigo-600 focus:ring-4 focus:ring-indigo-100">

                        <p class="mt-1 text-xs text-gray-500">
                            Gunakan nama yang mudah dipahami
                        </p>
                    </div>
                    {{-- JENIS KATEGORI --}}
                    <div>
                        <label class="flex items-center gap-2 mb-2 font-semibold text-gray-700">
                            <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                      clip-rule="evenodd"/>
                            </svg>
                            Jenis Kategori
                        </label>

                        <div class="mb-3 p-3 bg-amber-50 border border-amber-200 rounded-lg text-xs text-amber-800">
                            <strong>Pilih salah satu</strong> jenis kategori atau
                            <strong>kosongkan keduanya</strong> jika akan membuat sub-kategori.
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            {{-- METODE PEMBAYARAN --}}
                            <div class="p-3 border border-gray-200 rounded-lg hover:border-blue-400 transition">
                                <h4 class="mb-2 text-sm font-semibold text-gray-800 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                                    </svg>
                                    Metode Pembayaran
                                </h4>

                                <select name="payment_method"
                                        class="w-full px-3 py-2 text-sm border rounded-lg
                                               focus:ring-2 focus:ring-blue-500">
                                    <option value="">-- Kosongkan jika tidak dipilih --</option>
                                    @foreach ($payment as $pay)
                                        <option value="{{ $pay->id }}">
                                            {{ $pay->payment_method_name }}
                                            {{ $pay->sub_category ? ' → ' . $pay->sub_category : '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- SUMBER DANA --}}
                            <div class="p-3 border border-gray-200 rounded-lg hover:border-purple-400 transition">
                                <h4 class="mb-2 text-sm font-semibold text-gray-800 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4z"/>
                                    </svg>
                                    Sumber Dana
                                </h4>

                                <select name="funding_source"
                                        class="w-full px-3 py-2 text-sm border rounded-lg
                                               focus:ring-2 focus:ring-purple-500">
                                    <option value="">-- Kosongkan jika tidak dipilih --</option>
                                    @foreach ($funding as $fun)
                                        <option value="{{ $fun->id }}">
                                            {{ $fun->funding_source_name }}
                                            {{ $fun->sub_category ? ' → ' . $fun->sub_category : '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- AKSI --}}
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-4">
                        <p class="text-sm text-gray-500 flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            Semua field wajib diisi
                        </p>

                        <div class="flex gap-3 w-full sm:w-auto">
                            <button type="submit"
                                    class="flex-1 px-8 py-2.5 rounded-lg text-white font-semibold
                                           bg-gradient-to-r from-green-600 to-emerald-600
                                           shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition">
                                Simpan
                            </button>

                            <a href="{{ route('category.show', $category->id) }}"
                               class="flex-1 px-5 py-2.5 rounded-lg font-semibold text-gray-700
                                      bg-gray-300 hover:bg-gray-400 shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition text-center">
                                Batal 
                            </a>
                        </div>
                    </div>
                </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
