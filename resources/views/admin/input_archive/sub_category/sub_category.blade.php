<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Input Arsip') }}
        </h2>
    </x-slot>

    {{-- TOMBOL KEMBALI --}}
    <div class="#">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
            <a href="{{ route('cabinet.show', $category->cabinet_id) }}"
                class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-2 py-2 rounded-full border border-gray-200
                    shadow-lg transition-all duration-200 ease-in-out hover:bg-gray-400 hover:shadow-md active:bg-gray-300 active:scale-95">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
        </div>
    </div>

    <div class="py-4 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Header Category --}}
            <div class="bg-white/90 backdrop-blur-xl shadow-lg rounded-2xl p-6 border border-gray-200 mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Daftar Sub Kategori</h3>
                        <p class="text-sm font-semibold text-gray-500">
                            Total Sub Kategori : {{ $subcategories->count() }} Item</p>
                    </div>

                    <div class="flex gap-4">
                        <a href="{{ route('subcategory.create', $category->id) }}"
                            class="inline-flex items-center gap-2 px-4 py-2
                                   bg-gradient-to-r from-emerald-500 to-teal-600
                                   hover:from-emerald-600 hover:to-teal-700
                                   text-white font-medium rounded-lg
                                   shadow-lg hover:shadow-xl
                                   transform hover:-translate-y-0.5
                                   transition-all duration-200">
                            <img src="https://img.icons8.com/?size=20&id=EkK2AS8KSyo0&format=png&color=ffffff"
                                class="w-5" />
                            Tambah sub kategori
                        </a>
                    </div>
                </div>

                {{-- Daftar Category --}}

                @if ($subcategories->count() > 0)
                    <div class="mt-10 space-y-4">

                        @php $no = 1; @endphp

                        @foreach ($subcategories as $subcategory)
                            @continue(is_null($subcategory->sub_category))

                            <div
                                class="flex items-center justify-between p-4 bg-white border border-gray-300 rounded-lg
                    shadow-sm hover:shadow-md hover:bg-gray-100 transition-all duration-200">

                                {{-- Link utama --}}
                                <a href="{{ route('subcategory.show', $subcategory->id) }}"
                                    class="flex items-center gap-4 flex-1">

                                    <div
                                        class="w-8 h-8 flex items-center justify-center rounded-full
                            bg-gradient-to-b from-[#003A8F] to-[#002766]
                            text-white font-semibold">
                                        {{ $no++ }}
                                    </div>

                                    <div>
                                        <p class="text-gray-900 font-semibold">
                                            {{ $subcategory->sub_category }}
                                        </p>
                                    </div>
                                </a>

                                {{-- Tombol Aksi --}}
                                <div class="flex items-center gap-2 ml-4">
                                    <a href="{{ route('subcategory.edit', $subcategory->id) }}"
                                        class="bg-amber-500 hover:bg-amber-600 p-2 rounded-lg shadow">
                                        <img src="https://img.icons8.com/?size=24&id=88584&format=png&color=ffffff">
                                    </a>

                                    <form action="{{ route('subcategory.delete', $subcategory->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus sub kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 p-2 rounded-lg shadow">
                                            <img src="https://img.icons8.com/?size=24&id=43949&format=png&color=ffffff">
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="mt-10 text-center text-gray-500 italic">
                        Belum ada sub kategori
                    </div>
                @endif

            </div>
        </div>
</x-app-layout>
