<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Dashboard Bendahara') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-6">

                {{-- ================= HERO SECTION ================= --}}
                <div class="bg-gradient-to-b from-[#003A8F] to-[#002766] rounded-xl shadow-lg overflow-hidden">
                    <div class="p-8">
                        <div class="flex items-center justify-between">
                            <div>
                                <h1 class="text-3xl font-bold text-white mb-2">
                                    Dashboard Bendahara
                                </h1>
                                <p class="text-violet-100 text-base">
                                    Verifikasi dan arsipkan pengajuan yang telah disetujui
                                </p>
                            </div>
                            <div class="hidden md:block">
                                <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center">
                                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ================= STATISTIK CARDS ================= --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                    {{-- Total Pengajuan Terverifikasi --}}
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <p class="text-sm text-gray-500 mb-1">Total Terverifikasi</p>
                                <p class="text-3xl font-bold text-gray-800">{{ $total_terverifikasi ?? 0 }}</p>
                            </div>
                            <div class="p-2 bg-purple-100 rounded-lg">
                                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Menunggu Verifikasi Final --}}
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <p class="text-sm text-gray-500 mb-1">Menunggu Verifikasi</p>
                                <p class="text-3xl font-bold text-orange-600">{{ $menunggu_verifikasi ?? 0 }}</p>
                            </div>
                            <div class="p-2 bg-orange-100 rounded-lg">
                                <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Sudah Diarsipkan --}}
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <p class="text-sm text-gray-500 mb-1">Sudah Diarsipkan</p>
                                <p class="text-3xl font-bold text-green-600">{{ $sudah_diarsipkan ?? 0 }}</p>
                            </div>
                            <div class="p-2 bg-green-100 rounded-lg">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Selesai Hari Ini --}}
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <p class="text-sm text-gray-500 mb-1">Selesai Hari Ini</p>
                                <p class="text-3xl font-bold text-blue-600">{{ $selesai_hari_ini ?? 0 }}</p>
                            </div>
                            <div class="p-2 bg-blue-100 rounded-lg">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- ================= PROGRESS BAR ================= --}}
                <div class="bg-white border rounded-xl p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">
                        Progress Di Arsipkan
                    </h2>

                    <div class="bg-white rounded-xl shadow p-6">
                        <h3 class="text-gray-600 text-sm font-semibold">
                            Total Pengajuan Terverifikasi
                        </h3>
                    
                        <p class="text-3xl font-bold text-green-600 mt-2">
                            {{ $total_terverifikasi ?? 0 }}
                        </p>
                    </div>
                    
                    <div 
                        x-data="{ progress: {{ $progress ?? 0 }} }"
                        class="h-2 bg-emerald-500 rounded-full"
                        :style="`width: ${progress}%`">
                    </div>


                    <div class="flex justify-between text-sm text-gray-600 mt-2">
                        <span>{{ $sudah_diarsipkan}} diarsipkan</span>
                        <span>{{ $progress }}%</span>
                    </div>
                </div>

                {{-- Aksi Cepat --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center gap-3 mb-4 pb-4 border-b border-gray-200">
                        <div class="p-2 bg-purple-100 rounded-lg">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Aksi Cepat</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    {{-- Lihat Semua Pengajuan --}}
                    <a href="{{ route('final.index') }}"
                        class="flex items-center gap-4 p-3 bg-gradient-to-br from-purple-50 to-purple-100/50 rounded-lg border border-purple-200 hover:shadow-md transition-all">
                        <div class="p-3 bg-purple-500 rounded-lg">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">Semua Pengajuan</p>
                            <p class="text-xs text-gray-600">Kelola pengajuan Anda</p>
                        </div>
                    </a>
                    {{-- Input Arsip --}}
                    <a href="{{ route('admin.archive') }}"
                        class="flex items-center gap-4 p-5 bg-gradient-to-br from-blue-50 to-blue-100/50 rounded-lg border border-blue-200 hover:shadow-md transition-all">
                        <div class="p-3 bg-blue-500 rounded-lg">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">Input Arsip</p>
                            <p class="text-xs text-gray-600">Semua Input Arsip</p>
                        </div>
                    </a>
                    {{-- Input Arsip --}}
                    <a href="{{ route('digital.index') }}"
                        class="flex items-center gap-4 p-5 bg-gradient-to-br from-blue-50 to-blue-100/50 rounded-lg border border-blue-200 hover:shadow-md transition-all">
                        <div class="p-3 bg-blue-500 rounded-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">Digital Arsip</p>
                            <p class="text-xs text-gray-600">Semua Digital Arsip</p>
                        </div>
                    </a>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>
