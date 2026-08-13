<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-900 tracking-tight">
            {{ __('Edit Sub Kategori') }}
        </h2>
    </x-slot>

    {{-- TOMBOL KEMBALI --}}
    <div class="#">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
            <a href="{{ route('cabinet.show', $subcategory->cabinet_id) }}"
                class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-2 py-2 rounded-full border border-gray-200
                    shadow-lg transition-all duration-200 ease-in-out hover:bg-gray-400 hover:shadow-md active:bg-gray-300 active:scale-95">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
        </div>
    </div>

    <div class="min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- CARD UTAMA --}}
            <div class="rounded-xl shadow-2xl overflow-hidden border border-gray-100 bg-white">

                {{-- HEADER GRADIENT (MENYATU) --}}
                <div class="relative bg-gradient-to-b from-[#003A8F] to-[#002766] p-6 py-5">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-11 h-11 bg-white/15 backdrop-blur rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-xl font-semibold text-white">
                                Edit Sub Kategori
                            </h3>
                            <p class="text-blue-100 mt-1">
                                <span class="font-medium">Sub Kategori:</span>
                                {{ $subcategory->sub_category_name }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- FORM --}}
                <div class="p-8 sm:p-6">
                    <form action="{{ route('subcategory.update', $subcategory->id) }}" method="POST" class="space-y-6">
                        @method('PUT')
                        @csrf

                        <div class="py-6 min-h-screen">
                            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

                                {{-- Nama Rak Arsip --}}
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                                        Nama Sub Kategori
                                    </label>
                                    <input type="text" name="name" id="name"
                                        value="{{ $subcategory->sub_category }}"
                                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                                        placeholder="Masukkan nama rak arsip" required>
                                </div>

                                {{-- <div class="group">
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            Nama Sub Kategori
                        </label>
                        <div class="relative">
                            <input type="text" name="name" id="name"
                                value="{{ $subcategory->sub_category_name }}"
                                class="w-full rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 px-4 text-gray-900 placeholder-gray-400"
                                placeholder="Contoh: Surat Masuk, Laporan Keuangan, dll" required>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                </svg>
                            </div>
                        </div>
                        <p class="mt-2 text-xs text-gray-500">Perbarui nama sub kategori sesuai kebutuhan</p>
                    </div> --}}

                                @php
                                    // nilai code tersimpan (integer / null)
                                    $currentCode = old('code', $subcategory->category_code);

                                    // mapping berdasarkan NAMA
                                    $paymentByName = $payment->keyBy('payment_method_name');
                                    $fundingByName = $funding->keyBy('funding_source_name');

                                    $selectedPayment = null;
                                    $selectedFunding = null;

                                    // PAYMENT SELALU MENANG
                                    if ($paymentByName->has($subcategory->sub_category)) {
                                        $selectedPayment = $paymentByName[$subcategory->sub_category];
                                    } elseif ($fundingByName->has($subcategory->sub_category)) {
                                        $selectedFunding = $fundingByName[$subcategory->sub_category];
                                    }
                                @endphp


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
                                                keduanya</strong> jika akan membuat sub-kategori. Kode arsip akan dibuat
                                            di
                                            sub-kategori nanti.
                                        </p>
                                    </div>

                                    {{-- Selection Grid --}}
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                        {{-- Payment Method Card --}}
                                        <div
                                            class="bg-white border border-gray-200 rounded-lg p-3 hover:border-blue-400 transition-colors">
                                            <div class="flex items-center gap-2 mb-2">
                                                <svg class="w-5 h-5 text-blue-600" fill="currentColor"
                                                    viewBox="0 0 20 20">
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
                                                    <option value="{{ $pay->id }}"
                                                        {{ $subcategory->payment_method_id == $pay->id ? 'selected' : '' }}>
                                                        {{ $pay->payment_method_name }}{{ $pay->sub_category ? ' → ' . $pay->sub_category : '' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- Funding Source Card --}}
                                        <div
                                            class="bg-white border border-gray-200 rounded-lg p-3 hover:border-purple-400 transition-colors">
                                            <div class="flex items-center gap-2 mb-2">
                                                <svg class="w-5 h-5 text-purple-600" fill="currentColor"
                                                    viewBox="0 0 20 20">
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
                                                    <option value="{{ $fun->id }}"
                                                        {{ $subcategory->funding_source_id == $fun->id ? 'selected' : '' }}>
                                                        {{ $fun->funding_source_name }}{{ $fun->sub_category ? ' → ' . $fun->sub_category : '' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                </div>

                                {{-- AKSI --}}
                                <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-4 border-t">
                                    <p class="text-sm text-gray-500 flex items-center gap-2">
                                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                        Perubahan akan disimpan
                                    </p>

                                    <div class="flex gap-3 w-full sm:w-auto">
                                        <button type="submit"
                                            class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-8 py-2.5 bg-gradient-to-r from-amber-600 to-orange-600 hover:from-amber-700 hover:to-orange-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                            Update
                                        </button>

                                        <a href="{{ route('cabinet.show', $subcategory->cabinet_id) }}"
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
</x-app-layout>
