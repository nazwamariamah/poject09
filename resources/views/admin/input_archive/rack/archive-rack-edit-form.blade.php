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
            <a href="{{ route('year.show', $rack->category_id) }}"
                class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-2 py-2 rounded-full border border-gray-200
                    shadow-lg transition-all duration-200 ease-in-out hover:bg-gray-400 hover:shadow-md active:bg-gray-300 active:scale-95">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>             
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- CARD --}}
            <div class="bg-white rounded-3xl border border-gray-100 shadow-2xl overflow-hidden">

                {{-- CARD HEADER --}}
                <div class="bg-gradient-to-b from-[#003A8F] to-[#002766] px-8 py-6">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-12 h-12 rounded-xl bg-white/20 backdrop-blur
                                   flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5
                                         a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9
                                         a2 2 0 00-2-2M5 11V9a2 2 0 012-2
                                         m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-white">
                            Edit Rak Arsip
                        </h3>
                    </div>
                </div>

                {{-- FORM --}}
                <form action="{{ route('rack.update', $rack->id) }}"
                      method="POST"
                      class="p-8 space-y-6">
                    @csrf
                    @method('PUT')

                    {{-- NAMA RAK --}}
                    <div class="group">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Rak Arsip
                        </label>
                        <input type="text" name="name" value="{{ $rack->rack_name }}"
                            class="w-full rounded-xl border-2 border-gray-200
                            focus:border-amber-500 focus:ring-4 focus:ring-amber-100
                            transition px-4 py-2"
                            placeholder="Masukkan nama rak arsip" required>
                        <p class="mt-2 text-xs text-gray-500">
                            Perbarui nama rak sesuai kebutuhan
                        </p>
                    </div>
                    {{-- AKSI --}}
                    <div class="pt-6 border-t flex flex-col sm:flex-row
                                items-center justify-between gap-4">
    
                        <p class="flex items-center gap-2 text-sm text-gray-500">
                            <svg class="w-5 h-5 text-amber-500" fill="none"
                                 stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M12 9v2m0 4h.01m-6.938 4h13.856" />
                            </svg>
                            Perubahan akan tersimpan permanen
                        </p>
    
                        <div class="flex gap-3 w-full sm:w-auto">
                            <button type="submit"
                                class="flex-1 sm:flex-none inline-flex items-center justify-center
                                       px-8 py-2.5 rounded-lg font-semibold text-white
                                       bg-gradient-to-r from-amber-600 to-orange-600
                                       hover:from-amber-700 hover:to-orange-700
                                       shadow-lg hover:shadow-xl
                                       transform hover:-translate-y-0.5 transition">
                                Update
                            </button>
    
                            <a href="{{ route('year.show', $rack->category_id) }}"
                               class="flex-1 sm:flex-none px-6 py-2.5 text-center
                                      rounded-lg font-semibold text-gray-700
                                      bg-gray-300 hover:bg-gray-400
                                      shadow-lg hover:shadow-xl
                                      transform hover:-translate-y-0.5 transition">
                                Batal
                            </a>
                        </div>
                    </div>
                </div>

                </form>
            </div>

        </div>
    </div>
</x-app-layout>
