<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                {{-- TOMBOL KEMBALI --}}
                <div class="py-4">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <a href="{{ route('keuangan.pengajuan') }}"
                            class="inline-flex items-center gap-2 bg-white text-gray-700 px-4 py-2 rounded-md border border-gray-300 shadow-sm hover:bg-gray-50 hover:border-gray-400 transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            <span class="font-medium">Kembali</span>
                        </a>
                    </div>
                </div>
                <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6 mb-6">
                    <form method="GET" action="{{route('keuangan.search')}}" class="space-y-5">
                        
                        {{-- Search --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Cari Nama Pengajuan</label>
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

                        <div class="block text-sm font-medium text-gray-700 mb-2">
                            Wajib diisi tanggal dibawah ini!
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
                <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6 mb-4">
                    <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Hasil Pencarian</h3>
                            <p class="text-sm text-gray-500 mt-0.5">Total: {{ $submit->count() }} pengajuan</p>
                        </div>
                    </div>

                    <div class="space-y-3">
                        @php $no = 1; @endphp

                        @forelse ($submit as $result)
                            <div
                                class="flex items-center p-4 bg-white border border-gray-200 rounded-md hover:border-gray-300 hover:shadow-sm transition-all duration-200">

                                {{-- NOMOR --}}
                                <div
                                    class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-[#003A8F] text-white font-semibold text-sm rounded-md">
                                    {{ $no++ }}
                                </div>

                                {{-- KONTEN LIST --}}
                                <a href="{{ route('keuangan.check', $result->id) }}" class="flex-1 px-4">
                                    {{-- Nama Pengajuan --}}
                                    <div class="font-semibold text-gray-800 mb-2">
                                        {{ $result->budget_submission_name }}
                                    </div>

                                    {{-- Pengaju --}}
                                    <div class="text-xs text-gray-500 mb-2">
                                        Diajukan oleh: <span class="font-medium text-gray-700">{{ $result->user->name }}</span>
                                    </div>
                                    <div class="text-xs text-gray-500 mb-2">
                                        divisi: <span class="font-medium text-gray-700">{{ $result->user->role }}</span>
                                    </div>

                                    {{-- STATUS --}}
                                    <div class="flex flex-wrap items-center gap-2">
                                        {{-- Status Sedang Proses --}}
                                        @if (
                                            ($result->requirements_status == 'Belum Lengkap' || $result->requirements_status == 'Belum Diperiksa') &&
                                                $result->verification_status == 0)
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-md bg-yellow-100 text-yellow-700">
                                                Sedang Proses
                                            </span>
                                        @endif

                                        {{-- Status Kelengkapan --}}
                                        @if ($result->requirements_status == 'Belum Lengkap')
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-md bg-yellow-100 text-yellow-700">
                                                Belum Lengkap
                                            </span>
                                        @elseif($result->requirements_status == 'Lengkap')
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-md bg-green-100 text-green-700">
                                                Lengkap
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-md bg-red-100 text-red-700">
                                                Belum Diperiksa
                                            </span>
                                        @endif

                                        {{-- Status Verifikasi --}}
                                        @if ($result->verification_status == 1)
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-md bg-green-100 text-green-700">
                                                Diverifikasi
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-md bg-red-100 text-red-700">
                                                Belum Diverifikasi
                                            </span>
                                        @endif

                                        {{-- Status Arsip --}}
                                        @if ($result->is_archive == 1)
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-md bg-blue-100 text-blue-700">
                                                Diarsipkan
                                            </span>
                                        @endif
                                    </div>
                                </a>
                                <span class="text-xs text-gray-500">
                                    {{ $result->created_at->diffForHumans() }}
                                </span>

                                {{-- Arrow Icon --}}
                                <div class="flex-shrink-0">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12 bg-gray-50 rounded-md">
                                <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                        </path>
                                    </svg>
                                </div>
                                <p class="text-gray-500 font-medium">Tidak Ada Pengajuan</p>
                                <p class="text-gray-400 text-sm mt-1">
                                    {{ request('search') || request('status') ? 'Tidak ada pengajuan yang sesuai dengan filter' : 'Belum ada pengajuan yang perlu diperiksa' }}
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
    </div>
</x-app-layout>
