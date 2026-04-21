<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Dashboard Kepala Kantor') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            {{-- Header Dashboard --}}
            <div class="bg-gradient-to-r from-[#003A8F] to-[#0052CC] text-white p-8 rounded-lg shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold">Selamat Datang, Kepala Kantor</h1>
                        <p class="text-white/90 text-sm mt-2">Monitoring dan Pengawasan Sistem Pengajuan Anggaran</p>
                        <p class="text-white/80 text-xs mt-1">{{ now()->isoFormat('dddd, D MMMM YYYY') }}</p>
                    </div>
                    {{-- <div class="hidden md:block">
                        <div class="bg-white/20 backdrop-blur-sm px-6 py-3 rounded-lg">
                            <p class="text-xs text-white/80">Total Arsip</p>
                            <p class="text-3xl font-bold">{{ $total_arsip ?? 0 }}</p>
                        </div>
                    </div> --}}
                </div>
            </div>

            {{-- Statistik Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {{-- Card 1: Menunggu Verifikasi --}}
                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-yellow-500 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 font-medium">Arsip Lengkap</p>
                            {{-- <p class="text-3xl font-bold text-gray-800 mt-2">{{ $pending_verification ?? 0 }}</p> --}}
                            <p class="text-xs text-gray-500 mt-1">Arsip dengan data yang sudah lengkap: {{$arsip_lengkap}}</p>
                        </div>
                        <div class="w-14 h-14 bg-yellow-100 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Card 2: Dokumen Belum Lengkap --}}
                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-orange-500 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 font-medium">Arsip Belum Lengkap</p>
                            {{-- <p class="text-3xl font-bold text-gray-800 mt-2">{{ $incomplete_docs ?? 0 }}</p> --}}
                            <p class="text-xs text-gray-500 mt-1">Arsip dengan data yang Belum lengkapi: {{$arsip_belum_lengkap}}</p>
                        </div>
                        <div class="w-14 h-14 bg-orange-100 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Card 3: Terverifikasi --}}
                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 font-medium">Total Arsip</p>
                            {{-- <p class="text-3xl font-bold text-gray-800 mt-2">{{ $verified ?? 0 }}</p> --}}
                            <p class="text-xs text-gray-500 mt-1">jumlah arsip: {{$total_arsip}}</p>
                        </div>
                        <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Card 4: Diarsipkan --}}
                {{-- <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 font-medium">Diarsipkan</p>
                            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $archived ?? 0 }}</p>
                            <p class="text-xs text-gray-500 mt-1">Pengajuan</p>
                        </div>
                        <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                            </svg>
                        </div>
                    </div>
                </div> --}}
            </div>

            {{-- Charts Section --}}
            {{-- <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                Status Overview Chart
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Status Pengajuan</h3>
                        <span class="text-xs text-gray-500">Overview</span>
                    </div>
                    <div class="space-y-4">
                        Progress Bar: Belum Verifikasi
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span class="text-gray-600">Belum Diverifikasi</span>
                                <span class="font-semibold text-gray-800">{{ $pending_verification ?? 0 }}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3">
                                <div class="bg-yellow-500 h-3 rounded-full" style="width: {{ $total_submissions > 0 ? ($pending_verification / $total_submissions * 100) : 0 }}%"></div>
                            </div>
                        </div>

                        Progress Bar: Dokumen Belum Lengkap
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span class="text-gray-600">Dokumen Belum Lengkap</span>
                                <span class="font-semibold text-gray-800">{{ $incomplete_docs ?? 0 }}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3">
                                <div class="bg-orange-500 h-3 rounded-full" style="width: {{ $total_submissions > 0 ? ($incomplete_docs / $total_submissions * 100) : 0 }}%"></div>
                            </div>
                        </div>

                        Progress Bar: Terverifikasi
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span class="text-gray-600">Terverifikasi</span>
                                <span class="font-semibold text-gray-800">{{ $verified ?? 0 }}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3">
                                <div class="bg-green-500 h-3 rounded-full" style="width: {{ $total_submissions > 0 ? ($verified / $total_submissions * 100) : 0 }}%"></div>
                            </div>
                        </div>

                        Progress Bar: Diarsipkan
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span class="text-gray-600">Diarsipkan</span>
                                <span class="font-semibold text-gray-800">{{ $archived ?? 0 }}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3">
                                <div class="bg-blue-500 h-3 rounded-full" style="width: {{ $total_submissions > 0 ? ($archived / $total_submissions * 100) : 0 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                Aktivitas Terkini
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Aktivitas Sistem</h3>
                        <span class="text-xs text-gray-500">Real-time</span>
                    </div>
                    <div class="space-y-4">
                        Metric: Pengajuan Hari Ini
                        <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-800">Pengajuan Hari Ini</p>
                                    <p class="text-xs text-gray-500">Baru masuk</p>
                                </div>
                            </div>
                            <span class="text-2xl font-bold text-blue-600">{{ $today_submissions ?? 0 }}</span>
                        </div>

                        Metric: Dikembalikan
                        <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-800">Dikembalikan</p>
                                    <p class="text-xs text-gray-500">Perlu revisi</p>
                                </div>
                            </div>
                            <span class="text-2xl font-bold text-red-600">{{ $returned ?? 0 }}</span>
                        </div>

                        Metric: Rata-rata Waktu Proses
                        <div class="flex items-center justify-between p-3 bg-purple-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-800">Rata-rata Proses</p>
                                    <p class="text-xs text-gray-500">Waktu verifikasi</p>
                                </div>
                            </div>
                            <span class="text-2xl font-bold text-purple-600">{{ $avg_process_days ?? 0 }}<span class="text-sm">hari</span></span>
                        </div>
                    </div>
                </div>
            </div> --}}

            {{-- List Arsip --}}
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gray-100 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Semua Arsip</h3>
                    </div>
                    <a href="{{ route('admin.archive') }}" class="text-sm text-[#003A8F] hover:text-[#0052CC] font-medium">
                        Lihat Semua →
                    </a>
                </div>

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
                                    {{ $ar->archive_name ?? 'Nama Pengajuan' }}
                                </div>

                                {{-- <div class="flex flex-wrap items-center gap-2">
                                    @if ($ar->requirements_status == 'Belum Lengkap')
                                        <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-md bg-yellow-100 text-yellow-700">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                            </svg>
                                            Belum Lengkap
                                        </span>
                                    @elseif($ar->requirements_status == 'Lengkap')
                                        <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-md bg-green-100 text-green-700">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            Lengkap
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-md bg-red-100 text-red-700">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                            Belum Diperiksa
                                        </span>
                                    @endif
                                    
                                    @if ($submission->verification_status == 1)
                                        <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-md bg-green-100 text-green-700">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                            </svg>
                                            Diverifikasi
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-md bg-red-100 text-red-700">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                            Belum Diverifikasi
                                        </span>
                                    @endif

                                    @if ($submission->is_archive == 1)
                                        <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-md bg-blue-100 text-blue-700">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                                            </svg>
                                            Diarsipkan
                                        </span>
                                    @endif
                                    
                                    <span class="text-xs text-gray-500">
                                        {{ $submission->created_at->diffForHumans() ?? '-' }}
                                    </span>
                                </div> --}}
                            </a>
                            
                            <a href="{{ route('digital.show', $ar->id) }}" class="flex-shrink-0 px-4 py-2 bg-[#003A8F] hover:bg-[#0052CC] text-white text-sm font-medium rounded-md transition-colors">
                                Lihat Detail
                            </a>
                        </div>
                    @empty
                        <div class="text-center py-12 bg-gray-50 rounded-md">
                            <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                </svg>
                            </div>
                            <p class="text-gray-500 font-medium">Belum ada arsip</p>
                            <p class="text-gray-400 text-sm mt-1">Arsip yang tersedia akan muncul di sini</p>
                        </div>
                    @endforelse

                    <div>
                        {{$arsip->links()}}
                    </div>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Akses Cepat</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Button: Lihat Laporan --}}
                    <a href="{{route('kepala.report')}}" class="flex items-center justify-center p-4 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-lg shadow-md transition-all">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span class="font-semibold">Lihat Laporan</span>
                    </a>

                    {{-- Button: Audit Trail --}}
                    {{-- <a href="#" class="flex items-center justify-center p-4 bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white rounded-lg shadow-md transition-all">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                        <span class="font-semibold">Audit Trail</span>
                    </a> --}}

                    {{-- Button: Semua Pengajuan --}}
                    <a href="{{route('admin.archive')}}" class="flex items-center justify-center p-4 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white rounded-lg shadow-md transition-all">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                        </svg>
                        <span class="font-semibold">Semua Arsip</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>