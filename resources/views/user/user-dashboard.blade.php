<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-6">

                {{-- ================= HERO SECTION ================= --}}
                <div class="bg-gradient-to-b from-[#003A8F] to-[#002766] rounded-xl shadow-lg overflow-hidden">
                    <div class="p-8">
                        <div class="flex items-center justify-between">
                            <div>
                                <h1 class="text-xl font-bold text-white mb-2">
                                    Halo, {{ Auth::user()->name }}!
                                </h1>
                                <p class="text-blue-100 text-base">
                                    Selamat datang di Sistem Pengajuan Keuangan
                                </p>
                            </div>
                            <div class="hidden md:block">
                                <div class="w-14 h-14 bg-white/20 rounded-full flex items-center justify-center">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ================= STATISTIK CARDS ================= --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                    {{-- Total Pengajuan --}}
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <p class="text-sm text-gray-500 mb-1">Total Pengajuan</p>
                                <p class="text-3xl font-bold text-gray-800">{{ $all_submit ?? 0 }}</p>
                            </div>
                            <div class="p-4 bg-blue-100 rounded-lg">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Belum Lengkap --}}
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <p class="text-sm text-gray-500 mb-1">Belum Lengkap</p>
                                <p class="text-3xl font-bold text-yellow-600">{{ $belum_lengkap ?? 0 }}</p>
                            </div>
                            <div class="p-4 bg-yellow-100 rounded-lg">
                                <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Belum Diverifikasi --}}
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <p class="text-sm text-gray-500 mb-1">Belum Diverifikasi</p>
                                <p class="text-3xl font-bold text-red-600">{{ $belum_diverifikasi ?? 0 }}</p>
                            </div>
                            <div class="p-4 bg-red-100 rounded-lg">
                                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Selesai --}}
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <p class="text-sm text-gray-500 mb-1">Selesai</p>
                                <p class="text-3xl font-bold text-green-600">{{ $selesai ?? 0 }}</p>
                            </div>
                            <div class="p-4 bg-green-100 rounded-lg">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- ================= QUICK ACTIONS ================= --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-200">
                        <div class="p-2 bg-purple-100 rounded-lg">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Aksi Cepat</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Buat Pengajuan Baru --}}
                        <a href="{{ route('submit.index') }}"
                            class="flex items-center gap-4 p-5 bg-gradient-to-br from-blue-50 to-blue-100/50 rounded-lg border border-blue-200 hover:shadow-md transition-all">
                            <div class="p-3 bg-blue-500 rounded-lg flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800">Buat Pengajuan</p>
                                <p class="text-xs text-gray-600">Ajukan keuangan baru</p>
                            </div>
                        </a>

                        {{-- Lihat Semua Pengajuan --}}
                        <a href="{{ route('user.monitoring') }}"
                            class="flex items-center gap-4 p-5 bg-gradient-to-br from-purple-50 to-purple-100/50 rounded-lg border border-purple-200 hover:shadow-md transition-all">
                            <div class="p-3 bg-purple-500 rounded-lg flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800">Lihat Pengajuan</p>
                                <p class="text-xs text-gray-600">Kelola pengajuan Anda</p>
                            </div>
                        </a>
                    </div>
                </div>

                {{-- ================= PENGAJUAN TERBARU ================= --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-indigo-100 rounded-lg">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">Pengajuan Terbaru</h3>
                        </div>
                        <a href="{{ route('user.monitoring') }}"
                            class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                            Lihat Semua →
                        </a>
                    </div>

                    @forelse ($submission_new ?? [] as $submit)
                        <div class="flex items-center justify-between p-4 mb-3 last:mb-0 bg-gray-50 rounded-lg border border-gray-200 hover:shadow-sm transition gap-4">
                            <div class="flex items-center gap-3 flex-1 min-w-0">
                                {{-- Nomor Urut Dinamis yang Berlanjut per Halaman --}}
                                <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-gradient-to-br from-blue-500 to-blue-600 text-white font-bold text-sm rounded-lg">
                                    {{ method_exists($submission_new, 'firstItem') ? $submission_new->firstItem() + $loop->index : $loop->iteration }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-semibold text-gray-800 text-sm line-clamp-2 break-words">
                                        {{ $submit->budget_submission_name }}
                                    </p>
                                    <div class="flex items-center gap-2 mt-1 flex-wrap">
                                        <span class="text-xs text-gray-500">
                                            {{ $submit->created_at->diffForHumans() }}
                                        </span>
                                        @if ($submit->requirements_status == 'Lengkap')
                                            <span class="px-2 py-0.5 text-xs font-medium rounded-full bg-green-100 text-green-700">
                                                Lengkap
                                            </span>
                                        @else
                                            <span class="px-2 py-0.5 text-xs font-medium rounded-full bg-yellow-100 text-yellow-700">
                                                Belum Lengkap
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('pengajuan.show', $submit->id) }}"
                                class="flex-shrink-0 px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-lg transition-colors">
                                Detail
                            </a>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-3-3v6m-2 10h4a2 2 0 002-2V7a2 2 0 00-2-2H9a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <p class="text-gray-500 text-sm mb-4">Belum ada pengajuan</p>
                            <a href="{{ route('pengajuan.index') }}"
                                class="inline-flex items-center gap-2 px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-lg transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                                Buat Pengajuan Pertama
                            </a>
                        </div>
                    @endforelse

                    @if(method_exists($submission_new, 'links'))
                        <div class="mt-4">
                            {{ $submission_new->links() }}
                        </div>
                    @endif
                </div>

                {{-- ================= INFO & BANTUAN ================= --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Tips --}}
                    <div class="bg-gradient-to-br from-green-50 to-emerald-100/50 rounded-xl p-6 border border-green-200">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-2 bg-green-500 rounded-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z">
                                    </path>
                                </svg>
                            </div>
                            <h4 class="font-semibold text-gray-800">Tips Pengajuan</h4>
                        </div>
                        <ul class="space-y-2 text-sm text-gray-700">
                            <li class="flex items-start gap-2">
                                <span class="text-green-600 mt-0.5">✓</span>
                                <span>Pastikan dokumen lengkap sebelum mengajukan</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-green-600 mt-0.5">✓</span>
                                <span>Gunakan format PDF untuk file pengajuan</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-green-600 mt-0.5">✓</span>
                                <span>Periksa status pengajuan secara berkala</span>
                            </li>
                        </ul>
                    </div>

                    {{-- Status Info --}}
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-100/50 rounded-xl p-6 border border-blue-200">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-2 bg-blue-500 rounded-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h4 class="font-semibold text-gray-800">Tentang Status</h4>
                        </div>
                        <ul class="space-y-2 text-sm text-gray-700">
                            <li class="flex items-start gap-2">
                                <span class="px-2 py-0.5 text-xs font-medium rounded-full bg-yellow-100 text-yellow-700">Belum Lengkap</span>
                                <span>Dokumen perlu dilengkapi</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="px-2 py-0.5 text-xs font-medium rounded-full bg-red-100 text-red-700">Belum Diverifikasi</span>
                                <span>Menunggu verifikasi</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="px-2 py-0.5 text-xs font-medium rounded-full bg-green-100 text-green-700">Selesai</span>
                                <span>Pengajuan telah selesai</span>
                            </li>
                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>