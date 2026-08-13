<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 tracking-tight">
            {{ __('Edit Tahun Arsip') }}
        </h2>
    </x-slot>

    {{-- TOMBOL KEMBALI --}}
    <div class="#">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
            <a href="{{ route('cabinet.show', $year->cabinet_id) }}"
                class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-2 py-2 rounded-full border border-gray-200
                    shadow-lg transition-all duration-200 ease-in-out hover:bg-gray-400 hover:shadow-md active:bg-gray-300 active:scale-95">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>             
        </div>
    </div>

    <div class="py-6 min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- CARD UTAMA --}}
            <div class="rounded-3xl shadow-2xl overflow-hidden border border-gray-100 bg-white">

                {{-- HEADER GRADIENT (MENYATU) --}}
                <div class="relative bg-gradient-to-b from-[#003A8F] to-[#002766] p-8 py-5">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-12 h-12 bg-white/20 backdrop-blur rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-white">
                                Edit Tahun Arsip
                            </h3>
                            <p class="text-orange-100 mt-1">
                                Perbarui tahun untuk organisasi arsip
                            </p>
                        </div>
                    </div>
                </div>

                {{-- FORM --}}
                <div class="p-8 sm:p-6">
                    <form action="{{ route('year.update', $year->id) }}" method="POST" class="space-y-4">
                        @method('PUT')
                        @csrf

                        {{-- Tahun --}}
                        <div
                            class="bg-gradient-to-r from-rose-50 to-pink-50 border-l-4 border-rose-500 rounded-xl p-4">
                            <div class="flex gap-3">
                                <svg class="w-6 h-6 text-rose-600 mt-0.5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div class="text-sm">
                                    <p class="font-semibold text-gray-800">Anda sedang mengedit:</p>
                                    <p class="text-gray-700">
                                        <span class="font-bold">Tahun:</span> {{ $year->year }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- INPUT TAHUN --}}
                        <div class="space-y-3">
                            <label for="year" class="block text-sm font-semibold text-gray-700">
                                Perbarui Tahun
                            </label>

                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>

                                <input type="number" name="year" id="year"
                                    min="1900" max="2100"
                                    value="{{ $year->year }}"
                                    class="w-full pl-14 pr-4 py-2 rounded-xl border-2 border-gray-200
                                    focus:border-amber-500 focus:ring-4 focus:ring-amber-100
                                    text-lg font-semibold transition"
                                    placeholder="2025" required>
                            </div>
                        </div>

                        {{-- AKSI --}}
                        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-4 border-t">
                            <p class="text-sm text-gray-500 flex items-center gap-2">
                                <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856"/>
                                </svg>
                                Perubahan akan tersimpan permanen
                            </p>

                            <div class="flex gap-3 w-full sm:w-auto">
                                <button type="submit"
                                class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-8 py-2.5 bg-gradient-to-r from-amber-600 to-orange-600 hover:from-amber-700 hover:to-orange-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                    Update
                                </button>

                                <a href="{{ route('cabinet.show', $year->cabinet_id) }}"
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
