<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Report') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-md">
                <div class="p-8 space-y-8">
                    {{-- Header Dashboard --}}
                    <div class="bg-[#003A8F] text-white p-8 rounded-md shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-2xl font-bold">Report</h2>
                                <p class="text-white/90 text-sm mt-1">Buat Laporan Singkat Disini</p>
                            </div>
                        </div>
                    </div>

                    {{-- Filter & Report Section --}}
                    <div class="space-y-6">
                        {{-- Filter Tanggal --}}
                        <div class="bg-gray-50 p-6 rounded-md border border-gray-200">
                            <div class="flex items-center space-x-3 mb-4">
                                <div class="w-10 h-10 bg-blue-100 rounded-md flex items-center justify-center">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">Filter Berdasarkan Tanggal</h3>
                            </div>
                            
                            <form method="GET" action="{{route('kepala.report')}}" class="flex flex-wrap gap-4 items-end">
                                <div class="flex-1 min-w-[200px]">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Dari Tanggal</label>
                                    <input type="date" name="from_date" value="{{ request('from_date') }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                </div>
                                
                                <div class="flex-1 min-w-[200px]">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Sampai Tanggal</label>
                                    <input type="date" name="target_date" value="{{ request('target_date') }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                </div>
                                
                                <button type="ar" 
                                    class="px-6 py-2 bg-[#003A8F] hover:bg-blue-800 text-white font-medium rounded-md transition-colors duration-200 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    Terapkan Filter
                                </button>
                            </form>
                        </div>

                        {{-- Report Links --}}
                        <div class="grid md:grid-cols-2 gap-4">
                            <a href="{{route('kepala.report_aktif' ,[
                                'from_date' => request('from_date'),
                                'target_date' => request('target_date'),
                            ])}}" target="blank" class="group p-6 bg-white border-2 border-gray-200 rounded-md hover:border-blue-500 hover:shadow-md transition-all duration-200">
                                <div class="flex items-start space-x-4">
                                    <div class="w-12 h-12 bg-blue-100 rounded-md flex items-center justify-center group-hover:bg-blue-200 transition-colors">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-800 group-hover:text-blue-600 transition-colors">Laporan Arisp Aktif</h4>
                                        <p class="text-sm text-gray-500 mt-1">Semua Arsip Berstatus Aktif</p>
                                    </div>
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </a>

                            <a href="{{route('kepala.report_approved' ,[
                                'from_date' => request('from_date'),
                                'target_date' => request('target_date'),
                            ])}}" target="blank" class="group p-6 bg-white border-2 border-gray-200 rounded-md hover:border-green-500 hover:shadow-md transition-all duration-200">
                                <div class="flex items-start space-x-4">
                                    <div class="w-12 h-12 bg-green-100 rounded-md flex items-center justify-center group-hover:bg-green-200 transition-colors">
                                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-800 group-hover:text-green-600 transition-colors">Laporan Arsip yang disetujui</h4>
                                        <p class="text-sm text-gray-500 mt-1">Laporan arsip dengan data lengkap yang disetujui</p>
                                    </div>
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-green-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </a>
                        </div>
                    </div>

                    {{-- Daftar Pengajuan --}}
                    <div class="space-y-4">
                        {{-- Section Header --}}
                        <div class="flex items-center justify-between pb-3 border-b-2 border-gray-200">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gray-100 rounded-md flex items-center justify-center">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">Daftar Pengajuan</h3>
                            </div>
                            <span class="px-3 py-1 bg-gray-100 text-gray-700 text-sm font-medium rounded-md">
                                {{ $arsip->count() }} Item
                            </span>
                        </div>

                        {{-- List Items --}}
                        <div class="space-y-3">
                            @php $no = 1; @endphp

                            @forelse ($arsip as $ar)
                                <div class="flex items-center p-4 bg-white border border-gray-200 rounded-md hover:border-gray-300 hover:shadow-sm transition-all duration-200">
                                    {{-- Number Badge --}}
                                    <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-[#003A8F] text-white font-semibold text-sm rounded-md">
                                        {{ $no++ }}
                                    </div>

                                    {{-- Content --}}
                                    <a href="{{ route('pengajuan.show', $ar->id) }}" class="flex-1 px-4">
                                        <div class="font-semibold text-gray-800 mb-2">
                                            {{ $ar->archive_name }}
                                        </div>

                                        <div class="flex flex-wrap items-center gap-3 text-sm">
                                            <div class="flex items-center text-gray-600">
                                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                Dibuat: {{ $ar->created_at->format('d M Y') }}
                                            </div>
                                            
                                            <div class="flex items-center text-gray-600">
                                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Diperbarui: {{ $ar->updated_at->diffForHumans() }}
                                            </div>

                                            <div class="flex items-center text-gray-600">
                                                {{-- <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg> --}}
                                                Divisi: {{ $ar->from_division }}
                                            </div>
                                        </div>
                                    </a>

                                    {{-- Arrow Icon --}}
                                    <div class="flex-shrink-0">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-12 bg-gray-50 rounded-md">
                                    <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                        </svg>
                                    </div>
                                    <p class="text-gray-500 font-medium">Belum ada pengajuan</p>
                                    <p class="text-gray-400 text-sm mt-1">Pengajuan yang Anda buat akan muncul di sini</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>