<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Dashboard Keuangan') }}
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
                                    Dashboard Verifikasi Keuangan
                                </h1>
                                <p class="text-emerald-100 text-base">
                                    Kelola dan verifikasi pengajuan keuangan dengan mudah
                                </p>
                            </div>
                            <div class="hidden md:block">
                                <div class="w-24 h-24 bg-white/20 rounded-full flex items-center justify-center">
                                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
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
                                <p class="text-3xl font-bold text-gray-800">{{ $total_pengajuan ?? 0 }}</p>
                            </div>
                            <div class="p-4 bg-gray-100 rounded-lg">
                                <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Perlu Diperiksa --}}
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <p class="text-sm text-gray-500 mb-1">Perlu Diperiksa</p>
                                <p class="text-3xl font-bold text-orange-600">{{ $perlu_diperiksa ?? 0 }}</p>
                            </div>
                            <div class="p-4 bg-orange-100 rounded-lg">
                                <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
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

                    {{-- Sudah Diverifikasi --}}
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <p class="text-sm text-gray-500 mb-1">Sudah Diverifikasi</p>
                                <p class="text-3xl font-bold text-green-600">{{ $sudah_diverifikasi ?? 0 }}</p>
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

                {{-- ================= PROGRESS BAR ================= --}}
                <div class="bg-white border rounded-xl p-4">
                    <h2 class="text-lg font-semibold text-gray-800 mb-2">
                        Progress Verifikasi
                    </h2>

                    @php
                        $progress = $total_pengajuan > 0 ? round(($sudah_diverifikasi / $total_pengajuan) * 100) : 0;
                    @endphp

                    {{-- Filter Status
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select name="status"
                            class="block w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 focus:outline-none">
                            <option value="">Semua Status</option>
                            <option value="belum_diperiksa"
                                {{ request('status') == 'belum_diperiksa' ? 'selected' : '' }}>
                                Belum Diperiksa
                            </option>
                            <option value="belum_lengkap" {{ request('status') == 'belum_lengkap' ? 'selected' : '' }}>
                                Belum Lengkap
                            </option>
                            <option value="lengkap" {{ request('status') == 'lengkap' ? 'selected' : '' }}>
                                Lengkap
                            </option>
                            <option value="belum_diverifikasi"
                                {{ request('status') == 'belum_diverifikasi' ? 'selected' : '' }}>
                                Belum Diverifikasi
                            </option>
                            <option value="diverifikasi" {{ request('status') == 'diverifikasi' ? 'selected' : '' }}>
                                Diverifikasi
                            </option>
                            <option value="diarsipkan" {{ request('status') == 'diarsipkan' ? 'selected' : '' }}>
                                Diarsipkan
                            </option>
                        </select>
                    </div>
                </div>

                Buttons
                <div class="flex gap-3">
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-b from-[#003A8F] to-[#002766] text-white font-medium rounded-lg shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                            </path>
                        </svg>
                        Filter
                    </button>
                    <a href="#"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-200 text-gray-700 font-medium rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>
                        </svg>
                        Reset
                    </a>
                </div> --}}
                </form>
            </div>

            {{-- ================= DAFTAR PENGAJUAN ================= --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-emerald-100 rounded-lg">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Daftar Pengajuan</h3>
                            <p class="text-xs text-gray-500 mt-0.5">Total: {{ $pengajuans->count() }} pengajuan
                            </p>
                        </div>
                    </div>
                    <div x-data="{ progress: {{ $progress ?? 0 }} }" class="h-2 bg-emerald-500 rounded-full"
                        :style="`width: ${progress}%`">

                    </div>


                    <div class="flex justify-between text-sm text-gray-600 mt-2">
                        <span>{{ $sudah_diverifikasi }} diverifikasi</span>
                        <span>{{ $progress }}%</span>
                    </div>
                </div>

                {{-- @php
                    $no = 1;
                @endphp
                @foreach ($pengajuans as $pengajuan)
                    NOMOR
                    <div
                        class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-gradient-to-b from-[#003A8F] to-[#002766] text-white font-bold text-sm rounded-lg shadow-md">
                        {{ $no++ }}
                    </div>

                    KONTEN LIST
                    <a href="{{ route('keuangan.check', $pengajuan->id) }}" class="flex-1 px-6">
                        Nama Pengajuan
                        <div class="font-semibold text-base text-gray-800 mb-3 break-words">
                            {{ $pengajuan->pengajuan_name }}
                        </div>

                        Pengaju
                        <div class="text-xs text-gray-500 mb-2">
                            Diajukan oleh: <span class="font-medium text-gray-700">{{ $pengajuan->user->name }}</span>
                        </div>

                        STATUS
                        <div class="flex flex-wrap items-center gap-2">
                            Status Sedang Proses
                            @if (
                                ($pengajuan->status_kelengkapan == 'Belum Lengkap' || $pengajuan->status_kelengkapan == 'Belum Diperiksa') &&
                                    $pengajuan->status_verifikasi == 0)
                                <span class="px-3 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-700">
                                    Sedang Proses
                                </span>
                            @endif

                            Status Kelengkapan
                            @if ($pengajuan->status_kelengkapan == 'Belum Lengkap')
                                <span class="px-3 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-700">
                                    Belum Lengkap
                                </span>
                            @elseif($pengajuan->status_kelengkapan == 'Lengkap')
                                <span class="px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">
                                    Lengkap
                                </span>
                            @else
                                <span class="px-3 py-1 text-xs font-medium rounded-full bg-red-100 text-red-700">
                                    Belum Diperiksa
                                </span>
                            @endif

                            Status Verifikasi
                            @if ($pengajuan->status_verifikasi == 1)
                                <span class="px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">
                                    Diverifikasi
                                </span>
                            @else
                                <span class="px-3 py-1 text-xs font-medium rounded-full bg-red-100 text-red-700">
                                    Belum Diverifikasi
                                </span>
                            @endif

                            Status Arsip
                            @if ($pengajuan->status_diarsipkan == 1)
                                <span class="px-3 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-700">
                                    Diarsipkan
                                </span>
                            @endif
                        </div>
                    </a>

                    Arrow Icon
                    <div class="flex-shrink-0 ml-4">
                        <div
                            class="w-10 h-10 flex items-center justify-center bg-gray-100 rounded-lg group-hover:bg-emerald-500 transition-all duration-300">
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-white transition-all duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
            </div>
            @endforeach --}}
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
                    <a href="{{ route('verification.index') }}"
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
                            <p class="font-semibold text-gray-800">Lihat Pengajuan</p>
                            <p class="text-xs text-gray-600">Verifikasi Pengajuan yang diajukan</p>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>
    </div>
</x-app-layout>
