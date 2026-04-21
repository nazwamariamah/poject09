<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            Pengajuan Terverifikasi
        </h2>
    </x-slot>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- ================= SEARCH & FILTER ================= --}}
            <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6 mb-6">
                <form method="GET" action="{{route('final.search')}}" class="space-y-5">
                    
                    {{-- Search --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cari Pengajuan</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}"
                                class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-md text-gray-900 placeholder-gray-400 focus:ring-1 focus:ring-blue-600 focus:border-blue-600 transition-colors"
                                placeholder="Cari nama pengajuan...">
                        </div>
                    </div>

                    {{-- Date Range & Buttons --}}
                    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
                        
                        {{-- Date Inputs --}}
                        <div class="flex flex-col sm:flex-row gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Mulai Tanggal</label>
                                <input type="date" name="start_date" value="{{ request('start_date') }}"
                                    class="block w-full px-3 py-2.5 border border-gray-300 rounded-md text-gray-900 focus:ring-1 focus:ring-blue-600 focus:border-blue-600 transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Sampai Tanggal</label>
                                <input type="date" name="end_date" value="{{ request('end_date') }}"
                                    class="block w-full px-3 py-2.5 border border-gray-300 rounded-md text-gray-900 focus:ring-1 focus:ring-blue-600 focus:border-blue-600 transition-colors">
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex gap-3">
                            <a href="{{ url()->current() }}"
                                class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium rounded-md transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                    </path>
                                </svg>
                                Reset
                            </a>
                            <button type="submit"
                                class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-[#003A8F] hover:bg-[#003A9F] text-white font-medium rounded-md shadow-sm transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Cari
                            </button>
                        </div>
                    </div>

                </form>
            </div>

            {{-- ================= DAFTAR PENGAJUAN ================= --}}
            <div class="bg-white rounded-md shadow-sm border border-gray-200 overflow-hidden mb-4">
                {{-- Header --}}
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-white rounded-md shadow-sm border border-gray-200">
                            <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Pengajuan belum ditanda tangani</h3>
                            <p class="text-xs text-gray-600 mt-0.5">Total: {{ $submit_sign->count() }} pengajuan</p>
                        </div>
                    </div>
                </div>

                {{-- List Content --}}
                <div class="p-6">
                    @php $no = 1; @endphp

                    @forelse ($submit_sign as $sign)
                        @if ($sign->requirements_status == 'Lengkap' && $sign->verification_status == 1)
                            <div class="group mb-4 last:mb-0">
                                <div
                                    class="flex items-center p-4 bg-gray-50 rounded-md border border-gray-200 hover:bg-gray-100 hover:border-gray-300 transition-all duration-200">

                                    {{-- NOMOR --}}
                                    <div
                                        class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-[#003A8F] text-white font-semibold text-sm rounded-md">
                                        {{ $no++ }}
                                    </div>

                                    {{-- KONTEN LIST --}}
                                    <a href="{{ route('final.show', $sign->id) }}" class="flex-1 px-5">
                                        {{-- Nama Pengajuan --}}
                                        <div class="font-semibold text-base text-gray-900 mb-2">
                                            {{ $sign->budget_submission_name }}
                                        </div>

                                        {{-- Pengaju --}}
                                        <div class="text-xs text-gray-600 mb-3">
                                            Diajukan oleh: <span class="font-medium text-gray-800">{{ $sign->user->name }}</span>
                                        </div>

                                        <div class="text-xs text-gray-600 mb-3">
                                            divisi: <span class="font-medium text-gray-800">{{ $sign->user->role }}</span>
                                        </div>

                                        {{-- STATUS --}}
                                        <div class="flex flex-wrap items-center gap-2">
                                            @if ($sign->is_archive == 1)
                                                <span
                                                    class="px-3 py-1 text-xs font-medium rounded-md bg-green-100 text-green-700 border border-green-200">
                                                    Selesai
                                                </span>
                                            @endif

                                            <span
                                                class="px-3 py-1 text-xs font-medium rounded-md bg-green-100 text-green-700 border border-green-200">
                                                Lengkap
                                            </span>

                                            <span
                                                class="px-3 py-1 text-xs font-medium rounded-md bg-green-100 text-green-700 border border-green-200">
                                                Diverifikasi
                                            </span>

                                            @if ($sign->is_archive == 1)
                                                <span
                                                    class="px-3 py-1 text-xs font-medium rounded-md bg-green-100 text-green-700 border border-green-200">
                                                    Diarsipkan
                                                </span>
                                            @else
                                                <span
                                                    class="px-3 py-1 text-xs font-medium rounded-md bg-orange-100 text-orange-700 border border-orange-200">
                                                    Menunggu Arsip
                                                </span>
                                            @endif
                                            <span class="text-xs text-gray-500">
                                                {{ $sign->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                    </a>

                                    {{-- Arrow Icon --}}
                                    <div class="flex-shrink-0 ml-4">
                                        <div
                                            class="w-10 h-10 flex items-center justify-center bg-white rounded-md border border-gray-200 group-hover:bg-[#003A8F] group-hover:border-[#003A8F] transition-all duration-200">
                                            <svg class="w-5 h-5 text-gray-400 group-hover:text-white transition-all duration-200"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="text-center py-12">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                    </path>
                                </svg>
                            </div>
                            <p class="text-gray-700 font-medium text-base mb-1">Tidak Ada Pengajuan</p>
                            <p class="text-gray-500 text-sm">
                                {{ request('search') || request('status') ? 'Tidak ada pengajuan yang sesuai dengan filter' : 'Belum ada pengajuan yang perlu diverifikasi final' }}
                            </p>
                        </div>
                    @endforelse
                    <div>
                        {{$submit_sign->links()}}
                    </div>
                </div>
            </div>

            {{-- ================= DAFTAR PENGAJUAN ================= --}}
            <div class="bg-white rounded-md shadow-sm border border-gray-200 overflow-hidden">
                {{-- Header --}}
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-white rounded-md shadow-sm border border-gray-200">
                            <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Pengajuan Terverifikasi</h3>
                            <p class="text-xs text-gray-600 mt-0.5">Total: {{ $pengajuans->count() }} pengajuan</p>
                        </div>
                    </div>
                </div>

                {{-- List Content --}}
                <div class="p-6">
                    @php $no = 1; @endphp

                    @forelse ($pengajuans as $pengajuan)
                        @if ($pengajuan->requirements_status == 'Lengkap' && $pengajuan->verification_status == 1)
                            <div class="group mb-4 last:mb-0">
                                <div
                                    class="flex items-center p-4 bg-gray-50 rounded-md border border-gray-200 hover:bg-gray-100 hover:border-gray-300 transition-all duration-200">

                                    {{-- NOMOR --}}
                                    <div
                                        class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-[#003A8F] text-white font-semibold text-sm rounded-md">
                                        {{ $no++ }}
                                    </div>

                                    {{-- KONTEN LIST --}}
                                    <a href="{{ route('final.show', $pengajuan->id) }}" class="flex-1 px-5">
                                        {{-- Nama Pengajuan --}}
                                        <div class="font-semibold text-base text-gray-900 mb-2">
                                            {{ $pengajuan->budget_submission_name }}
                                        </div>

                                        {{-- Pengaju --}}
                                        <div class="text-xs text-gray-600 mb-3">
                                            Diajukan oleh: <span
                                                class="font-medium text-gray-800">{{ $pengajuan->user->name }}</span>
                                        </div>

                                        <div class="text-xs text-gray-600 mb-3">
                                            divisi: <span class="font-medium text-gray-800">{{ $pengajuan->user->role }}</span>
                                        </div>

                                        {{-- STATUS --}}
                                        <div class="flex flex-wrap items-center gap-2">
                                            @if ($pengajuan->is_archive == 1)
                                                <span
                                                    class="px-3 py-1 text-xs font-medium rounded-md bg-green-100 text-green-700 border border-green-200">
                                                    Selesai
                                                </span>
                                            @endif

                                            <span
                                                class="px-3 py-1 text-xs font-medium rounded-md bg-green-100 text-green-700 border border-green-200">
                                                Lengkap
                                            </span>

                                            <span
                                                class="px-3 py-1 text-xs font-medium rounded-md bg-green-100 text-green-700 border border-green-200">
                                                Diverifikasi
                                            </span>

                                            @if ($pengajuan->is_archive == 1)
                                                <span
                                                    class="px-3 py-1 text-xs font-medium rounded-md bg-green-100 text-green-700 border border-green-200">
                                                    Diarsipkan
                                                </span>
                                            @else
                                                <span
                                                    class="px-3 py-1 text-xs font-medium rounded-md bg-orange-100 text-orange-700 border border-orange-200">
                                                    Menunggu Arsip
                                                </span>
                                            @endif
                                            <span class="text-xs text-gray-500">
                                                {{ $pengajuan->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                    </a>

                                    {{-- Arrow Icon --}}
                                    <div class="flex-shrink-0 ml-4">
                                        <div
                                            class="w-10 h-10 flex items-center justify-center bg-white rounded-md border border-gray-200 group-hover:bg-[#003A8F] group-hover:border-[#003A8F] transition-all duration-200">
                                            <svg class="w-5 h-5 text-gray-400 group-hover:text-white transition-all duration-200"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="text-center py-12">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                    </path>
                                </svg>
                            </div>
                            <p class="text-gray-700 font-medium text-base mb-1">Tidak Ada Pengajuan</p>
                            <p class="text-gray-500 text-sm">
                                {{ request('search') || request('status') ? 'Tidak ada pengajuan yang sesuai dengan filter' : 'Belum ada pengajuan yang perlu diverifikasi final' }}
                            </p>
                        </div>
                    @endforelse
                    <div>
                        {{$pengajuans->links()}}
                    </div>
                </div>
            </div>

            {{-- ================= INFO SECTION ================= --}}
            <div class="bg-blue-50 rounded-md p-6 border border-blue-200 mt-6">
                <div class="flex items-start gap-4">
                    <div class="p-2 bg-[#003A8F] rounded-md flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-semibold text-gray-900 mb-2">Informasi Verifikasi Final</h4>
                        <ul class="space-y-1.5 text-sm text-gray-700">
                            <li class="flex items-start gap-2">
                                <span class="text-[#003A8F] mt-0.5">•</span>
                                <span>Verifikasi pengajuan yang telah diperiksa kelengkapannya</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-[#003A8F] mt-0.5">•</span>
                                <span>Setelah diverifikasi, pengajuan akan diarsipkan secara otomatis</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-[#003A8F] mt-0.5">•</span>
                                <span>Pastikan semua dokumen sudah lengkap sebelum melakukan verifikasi final</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
