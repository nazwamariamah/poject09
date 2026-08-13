<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Edit Kabinet') }}
        </h2>
    </x-slot>

    {{-- TOMBOL KEMBALI --}}
    <div class="#">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
            <a href="{{ route('admin.archive') }}"
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
                <a href="{{ route('admin.archive') }}" class="text-gray-500 hover:text-blue-600 transition-colors">
                    Input Arsip
                </a>
                <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd" />
                </svg>
                <span class="text-gray-700 font-semibold">Edit Kabinet</span>
            </div>

            <div class="bg-white shadow-2xl rounded-3xl overflow-hidden border border-gray-200">

                {{-- Header Section --}}
                <div class="relative bg-gradient-to-b from-[#003A8F] to-[#002766] p-4">

                    <div class="relative z-10 flex items-center gap-4">
                        <div class="p-4 bg-white bg-opacity-20 rounded-2xl backdrop-blur-sm">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-white">
                                Edit Informasi Kabinet
                            </h3>
                            <p class="text-blue-100 mt-2">Perbarui data kabinet: <span
                                    class="font-semibold">{{ $cabinet->cabinet_name }}</span></p>
                        </div>
                    </div>
                </div>

                {{-- Current Info Card --}}
                <div class="p-6 py-2 bg-gradient-to-r from-blue-50 to-cyan-50 border-b-2 border-gray-200">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 p-3 bg-blue-100 rounded-xl">
                            <svg class="w-7 h-7 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z"
                                    clip-rule="evenodd" />
                                <path d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 002-2v-2z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-bold text-gray-800 mb-2">Informasi Kabinet Saat Ini</h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 text-sm">
                                <div class="flex items-center gap-2 bg-white px-3 py-2 rounded-lg">
                                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-gray-600 font-semibold">{{ $cabinet->cabinet_name }}</span>
                                </div>
                                <div class="flex items-center gap-2 bg-white px-3 py-2 rounded-lg">
                                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-gray-600 font-semibold">{{ $cabinet->cabinet_code }}</span>
                                </div>
                                <div class="flex items-center gap-2 bg-white px-3 py-2 rounded-lg">
                                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-gray-600">ID: #{{ $cabinet->id }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- FORM --}}
                <form action="{{ route('cabinet.update', $cabinet->id) }}" method="POST" class="p-8">
                    @method('PUT')
                    @csrf

                    <div class="space-y-6">

                        {{-- Nama Cabinet --}}
                        <div class="group">
                            <label for="name" class="flex items-center gap-2 text-gray-700 font-semibold mb-3">
                                Nama Kabinet
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="text" name="name" id="name" value="{{ $cabinet->cabinet_name }}"
                                    class="w-full px-5 py-4 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-gray-50 focus:bg-white pl-12"
                                    placeholder="Masukkan nama kabinet" required>
                                <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z"
                                        clip-rule="evenodd" />
                                    <path d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 002-2v-2z" />
                                </svg>
                            </div>
                            <p class="mt-2 text-xs text-gray-500 ml-1">
                                <span class="inline-flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Terakhir diubah:
                                    {{ $cabinet->updated_at ? $cabinet->updated_at->diffForHumans() : 'Belum pernah' }}
                                </span>
                            </p>
                        </div>

                        {{-- Kode Cabinet --}}
                        <div class="group">
                            <label for="code" class="flex items-center gap-2 text-gray-700 font-semibold mb-3">
                                Kode Kabinet
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="text" name="code" id="code"
                                    value="{{ $cabinet->cabinet_code }}"
                                    class="w-full px-5 py-4 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-gray-50 focus:bg-white pl-12 uppercase"
                                    placeholder="Masukkan kode kabinet" required>
                                <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="group">
                            <label for="deskripsi" class="flex items-center gap-2 text-gray-700 font-semibold mb-3">
                                Deskripsi
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <textarea name="deskripsi" id="deskripsi" rows="4"
                                    class="w-full px-5 py-1 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-gray-50 focus:bg-white pl-12 resize-none"
                                    placeholder="Jelaskan fungsi atau isi dari kabinet ini" required>{{ $cabinet->description }}</textarea>
                                <svg class="absolute left-4 top-4 w-5 h-5 text-gray-400" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="mt-2 text-xs text-gray-500 ml-1">Perbarui deskripsi untuk mencerminkan perubahan
                                fungsi atau isi kabinet</p>
                        </div>

                    </div>

                    {{-- Action Buttons --}}
                    <div class="text-right pt-5 mt-5 border-t-2 border-gray-200">
                        {{-- Tombol Update --}}
                        <button type="submit"
                            class="group inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-amber-600 to-orange-600 hover:from-amber-700 hover:to-orange-700 text-white font-bold rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                            <svg class="w-5 h-5 group-hover:rotate-12 transition-transform duration-300"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Update Kabinet
                        </button>
                    </div>
                </form>
            </div>

            {{-- Change Log Info --}}
            <div
                class="mt-6 bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-200 rounded-2xl p-6 shadow-lg">
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0 p-3 bg-blue-100 rounded-xl">
                        <svg class="w-7 h-7 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-blue-900 mb-2 text-lg">Riwayat Kabinet</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-blue-800">
                            <div>
                                <span class="font-semibold">ID Kabinet:</span>
                                <span class="ml-2">#{{ $cabinet->id }}</span>
                            </div>
                            <div>
                                <span class="font-semibold">Dibuat:</span>
                                <span
                                    class="ml-2">{{ $cabinet->created_at ? $cabinet->created_at->format('d M Y') : '-' }}</span>
                            </div>
                            <div>
                                <span class="font-semibold">Terakhir Update:</span>
                                <span
                                    class="ml-2">{{ $cabinet->updated_at ? $cabinet->updated_at->format('d M Y H:i') : '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
