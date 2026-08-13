<x-app-layout>
    {{-- HEADER --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Input Arsip') }}
        </h2>
    </x-slot>

    {{-- TOMBOL KEMBALI --}}
    {{-- <div class="#">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
            <a href="{{ route('cabinet.show', $category->cabinet_id) }}"
                class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-2 py-2 rounded-full border border-gray-200
                    shadow-lg transition-all duration-200 ease-in-out hover:bg-gray-400 hover:shadow-md active:bg-gray-300 active:scale-95">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
        </div>
    </div>

    <div class="py-4 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            Header SubCategory
            <div class="relative overflow-hidden bg-white rounded-xl shadow-xl p-6 mb-6 border border-gray-100">

                <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gradient-to-b from-[#003A8F] to-[#002766] rounded-lg flex items-center justify-center shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-lg font-semibold text-gray-700 mb-1">Daftar Tahun</p>
                            <h3 class="text-2xl font-bold text-gray-900">
                                {{ $category->sub_category_name }}
                            </h3>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <a href="{{ route('subcategory.create_with_category', $category->id) }}"
                            class="inline-flex items-center gap-2 px-4 py-2
                                   bg-gradient-to-r from-emerald-500 to-teal-600
                                   hover:from-emerald-600 hover:to-teal-700
                                   text-white font-medium rounded-lg
                                   shadow-lg hover:shadow-xl
                                   transform hover:-translate-y-0.5
                                   transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Tambah Sub Category
                        </a>
                        <a href="{{ route('year.create_with_category', $category->id) }}"
                            class="inline-flex items-center gap-2 px-4 py-2
                                   bg-gradient-to-r from-emerald-500 to-teal-600
                                   hover:from-emerald-600 hover:to-teal-700
                                   text-white font-medium rounded-lg
                                   shadow-lg hover:shadow-xl
                                   transform hover:-translate-y-0.5
                                   transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Tambah Tahun
                        </a>
                    </div>
                </div>


            Daftar Tahun
                @if ($years->count() > 0)
                <div class="mt-10 space-y-4 rounded-lg">
                    @php $no = 1; @endphp
                    @foreach ($years as $year)
                        <div class="flex items-center justify-between p-4 bg-white border border-gray-400 rounded-lg
                                    shadow-sm hover:shadow-md hover:bg-gray-300 transition-all duration-200 group">

                            KIRI: Nomor + Tahun
                            <a href="{{ route('year.show', $year->id) }}" class="flex items-center gap-4 flex-1">

                                Nomor
                                <div class="w-9 h-9 flex items-center justify-center rounded-full bg-gradient-to-b from-[#003A8F] to-[#002766] text-white font-bold">
                                    {{ $no++ }}
                                </div>

                                Info Tahun
                                <div>
                                    <p class="text-lg font-semibold text-gray-900 group-hover:text-indigo-600 transition">
                                        Tahun {{ $year->year }}
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        Klik untuk melihat detail
                                    </p>
                                </div>
                            </a>

                            KANAN: AKSI
                            <div class="flex items-center gap-2 ml-4">

                                Edit
                                <a href="{{ route('year.edit', $year->id) }}"
                                    class="flex items-center justify-center bg-amber-500 hover:bg-orange-600 rounded-md p-2 transition"
                                    title="Edit">
                                    <img src="https://img.icons8.com/?size=24&id=88584&format=png&color=ffffff"
                                        alt="edit">
                                </a>

                                Hapus
                                <form action="{{ route('year.destroy', $year->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus tahun ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="flex items-center justify-center bg-red-500 hover:bg-red-600 rounded-md p-2 transition"
                                        title="Hapus">
                                        <img src="https://img.icons8.com/?size=24&id=43949&format=png&color=ffffff"
                                            alt="delete">
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                Empty State
                <div class="border-2 border-dashed border-red-400 rounded-xl bg-white/70 backdrop-blur-sm py-20 px-6 text-center shadow-sm">
                    <div class="inline-flex items-center justify-center w-20 h-20
                                bg-red-50 rounded-full mb-6 border border-red-200">
                        <svg class="w-10 h-10 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <p class="text-lg font-semibold text-gray-800 mb-2">
                        Belum Ada Tahun
                    </p>
                    <p class="text-gray-500 mb-8 max-w-md mx-auto">
                        Area ini masih kosong. Silakan tambahkan tahun terlebih dahulu agar arsip dapat dikelola dengan rapi.
                    </p>
                </div>
            @endif
        </div> --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
        <a href="{{ route('cabinet.show', $category->cabinet_id) }}"
            class="inline-flex items-center gap-2 px-2 py-2
                  bg-gray-100 text-gray-700 border border-gray-200 rounded-full
                  shadow-lg transition-all duration-200
                  hover:bg-gray-400 hover:shadow-md
                  active:bg-gray-300 active:scale-95">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
    </div>

    <div class="py-6 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- HEADER SUB CATEGORY --}}
            <div class="relative bg-white rounded-xl shadow-xl p-6 mb-6 border border-gray-100">

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-12 h-12 bg-gradient-to-b from-[#003A8F] to-[#002766]
                                   rounded-lg flex items-center justify-center shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>

                        <div>
                            <p class="text-lg font-semibold text-gray-700 mb-1">
                                Daftar Tahun
                            </p>
                            <h3 class="text-2xl font-bold text-gray-900">
                                {{ $category->sub_category_name }}
                            </h3>
                        </div>
                    </div>

                    {{-- AKSI --}}
                    <div class="flex gap-4">
                        @if($category->sub_category == null)
                            <a href="{{ route('subcategory.create', $category->id) }}"
                                class="inline-flex items-center gap-2 px-4 py-2
                                      bg-gradient-to-r from-emerald-500 to-teal-600
                                      hover:from-emerald-600 hover:to-teal-700
                                      text-white font-medium rounded-lg
                                      shadow-lg hover:shadow-xl
                                      transform hover:-translate-y-0.5
                                      transition-all duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Tambah Sub Category
                            </a>
                        @endif

                        <a href="{{ route('year.create', $category->id) }}"
                            class="inline-flex items-center gap-2 px-4 py-2
                                  bg-gradient-to-r from-emerald-500 to-teal-600
                                  hover:from-emerald-600 hover:to-teal-700
                                  text-white font-medium rounded-lg
                                  shadow-lg hover:shadow-xl
                                  transform hover:-translate-y-0.5
                                  transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Tambah Tahun
                        </a>
                    </div>
                </div>

                {{-- FILTER DATA TAHUN --}}
                @php
                    $validYears = $years->whereNotNull('year');
                @endphp

                {{-- DAFTAR TAHUN --}}
                @if ($validYears->count() > 0)
                    <div class="mt-10 space-y-4">
                        @php $no = 1; @endphp

                        @foreach ($validYears as $year)
                            <div
                                class="flex items-center justify-between p-4
                                       bg-white border border-gray-400 rounded-lg
                                       shadow-sm hover:shadow-md hover:bg-gray-300
                                       transition-all duration-200 group">

                                {{-- LINK UTAMA --}}
                                <a href="{{ route('year.show', $year->id) }}" class="flex items-center gap-4 flex-1">
                                    <div
                                        class="w-9 h-9 flex items-center justify-center
                                               rounded-full bg-gradient-to-b
                                               from-[#003A8F] to-[#002766]
                                               text-white font-bold">
                                        {{ $no++ }}
                                    </div>

                                    <div>
                                        <p
                                            class="text-lg font-semibold text-gray-900
                                                   group-hover:text-indigo-600 transition">
                                            Tahun {{ $year->year }}
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            Klik untuk melihat detail
                                        </p>
                                    </div>
                                </a>

                                {{-- AKSI --}}
                                <div class="flex items-center gap-2 ml-4">
                                    <a href="{{ route('year.edit', $year->id) }}"
                                        class="bg-amber-500 hover:bg-orange-600
                                              rounded-lg p-2 shadow transition">
                                        <img src="https://img.icons8.com/?size=24&id=88584&format=png&color=ffffff">
                                    </a>

                                    <form action="{{ route('year.delete', $year->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus tahun ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600
                                                       rounded-lg p-2 shadow transition">
                                            <img src="https://img.icons8.com/?size=24&id=43949&format=png&color=ffffff">
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    {{-- EMPTY STATE --}}
                    <div class="mt-10 text-center bg-white rounded-2xl shadow-md border border-gray-200 py-24">
                        <div
                            class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full mb-6 shadow-inner">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <p class="text-xl font-semibold text-gray-700 mb-3">Belum Ada Tahun</p>
                        <p class="text-gray-500 max-w-md mx-auto">Area ini masih kosong. Silakan tambahkan tahun
                            terlebih dahulu agar arsip dapat dikelola dengan rapi.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
