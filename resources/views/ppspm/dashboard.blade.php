<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            Dashboard
        </h2>
    </x-slot>
       
    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- WELCOME CARD --}}
            <div class="relative overflow-hidden bg-gradient-to-b from-[#003A8F] to-[#002766] text-white p-10 rounded-2xl shadow-2xl mb-8">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-40 h-40 bg-white opacity-10 rounded-full"></div>
                <div class="absolute bottom-0 left-0 -mb-8 -ml-8 w-32 h-32 bg-white opacity-10 rounded-full"></div>
                <div class="relative z-10">
                    <div class="flex items-center mb-3">
                        <svg class="w-10 h-10 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                        </svg>
                        <h1 class="text-3xl font-bold">Selamat Datang di Dashboard PPSPM</h1>
                    </div>
                    <p class="text-lg opacity-90 ml-13">
                        Validasi dan Verifikasi Dokumen Seperti Dokumen Gaji dan Lainnya
                    </p>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>