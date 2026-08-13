<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Semua Status submit') }}
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
                                <h2 class="text-2xl font-bold">submit Saya</h2>
                                <p class="text-white/90 text-sm mt-1">Kelola dan pantau semua submit keuangan Anda
                                    dalam satu tempat</p>
                            </div>
                            {{-- <div class="hidden md:block">
                                <span
                                    class="bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-md text-sm font-semibold">
                                    {{ $submissions->count() }} Total submit
                                </span>
                            </div> --}}
                        </div>
                    </div>

                    {{-- Main Content --}}
                    <div class="space-y-8">

                        {{-- ======================== BAGIAN 1: submit Diproses ======================== --}}
                        <div class="space-y-4">
                            {{-- Section Header --}}
                            <div class="flex items-center justify-between pb-3 border-b-2 border-gray-200">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-blue-100 rounded-md flex items-center justify-center">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-800">submit dalam Proses</h3>
                                </div>
                                <span class="px-3 py-1 bg-gray-100 text-gray-700 text-sm font-medium rounded-md">
                                    {{ $proses_submissions->where('status_kelengkapan', 'Belum Lengkap')->where('status_verifikasi', 0)->count() }}
                                    Item
                                </span>
                            </div>

                            {{-- List Items --}}
                            <div class="space-y-3">
                                @php $no = 1; @endphp

                                @forelse ($proses_submissions as $proses)
                                    @if ($proses->requirements_status == 'Belum Lengkap' && $proses->verification_status == 0)
                                        <div
                                            class="flex items-center p-4 bg-white border border-gray-200 rounded-md hover:border-gray-300 hover:shadow-sm transition-all duration-200">
                                            {{-- Number Badge --}}
                                            <div
                                                class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-[#003A8F] text-white font-semibold text-sm rounded-md">
                                                {{ $no++ }}
                                            </div>

                                            {{-- Content --}}
                                            <a href="{{ route('pengajuan.show', $proses->id) }}" class="flex-1 px-4">
                                                <div class="font-semibold text-gray-800 mb-2">
                                                    {{ $proses->budget_submission_name }}
                                                </div>

                                                <div class="flex flex-wrap items-center gap-2">
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-md bg-blue-100 text-blue-700">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <circle cx="10" cy="10" r="3" />
                                                        </svg>
                                                        Proses
                                                    </span>

                                                    @if ($proses->requirements_status == 'Belum Lengkap')
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-md bg-yellow-100 text-yellow-700">
                                                            <svg class="w-3 h-3 mr-1" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                            </svg>
                                                            Belum Lengkap
                                                        </span>
                                                    @endif

                                                    <span
                                                        class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-md bg-red-100 text-red-700">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                        Belum Diverifikasi
                                                    </span>

                                                    @if ($proses->is_return == 1)
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-md bg-orange-100 text-orange-700">
                                                            <svg class="w-3 h-3 mr-1" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                                            </svg>
                                                            Dikembalikan
                                                        </span>
                                                    @endif

                                                    @if ($proses->is_archive == 1)
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-md bg-purple-100 text-purple-700">
                                                            <svg class="w-3 h-3 mr-1" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                                            </svg>
                                                            Diarsipkan
                                                        </span>
                                                    @endif

                                                    <span class="text-xs text-gray-500">
                                                        {{ $proses->updated_at->diffForHumans() }}
                                                    </span>
                                                </div>
                                            </a>

                                            {{-- Action Buttons --}}
                                            <div class="flex gap-2 flex-shrink-0">
                                                <a href="{{ route('pengajuan.edit', $proses->id) }}"
                                                    class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-md transition-colors"
                                                    title="Edit">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>

                                                <form action="{{ route('pengajuan.destroy', $proses->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus submit ini?');">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button
                                                        class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-md transition-colors"
                                                        title="Hapus">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                @empty
                                    <div class="text-center py-12 bg-gray-50 rounded-md">
                                        <div
                                            class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-3">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <p class="text-gray-500 font-medium">Belum ada submit dalam proses</p>
                                        <p class="text-gray-400 text-sm mt-1">submit yang sedang diproses akan
                                            muncul di sini</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        {{-- ======================== BAGIAN 2: SEMUA submit ======================== --}}
                        <div class="space-y-4">
                            {{-- Section Header --}}
                            <div class="flex items-center justify-between pb-3 border-b-2 border-gray-200">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-gray-100 rounded-md flex items-center justify-center">
                                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-800">Semua submit</h3>
                                </div>
                                <span class="px-3 py-1 bg-gray-100 text-gray-700 text-sm font-medium rounded-md">
                                    {{ $all_submissions->count() }} Item
                                </span>
                            </div>

                            {{-- List Items --}}
                            <div class="space-y-3">
                                @php $no = 1; @endphp

                                @forelse ($all_submissions as $all)
                                    <div
                                        class="flex items-center p-4 bg-white border border-gray-200 rounded-md hover:border-gray-300 hover:shadow-sm transition-all duration-200">
                                        {{-- Number Badge --}}
                                        <div
                                            class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-[#003A8F] text-white font-semibold text-sm rounded-md">
                                            {{ $no++ }}
                                        </div>

                                        {{-- Content --}}
                                        <a href="{{ route('pengajuan.show', $all->id) }}" class="flex-1 px-4">
                                            <div class="font-semibold text-gray-800 mb-2">
                                                {{ $all->budget_submission_name }}
                                            </div>

                                            <div class="flex flex-wrap items-center gap-2">
                                                @if ($all->requirements_status == 'Belum Lengkap')
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-md bg-yellow-100 text-yellow-700">
                                                        <svg class="w-3 h-3 mr-1" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                        </svg>
                                                        Belum Lengkap
                                                    </span>
                                                @elseif($all->requirements_status == 'Lengkap')
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-md bg-green-100 text-green-700">
                                                        <svg class="w-3 h-3 mr-1" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        Lengkap
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-md bg-red-100 text-red-700">
                                                        <svg class="w-3 h-3 mr-1" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                        Belum Diperiksa
                                                    </span>
                                                @endif

                                                @if ($all->verification_status == 1)
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-md bg-green-100 text-green-700">
                                                        <svg class="w-3 h-3 mr-1" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                                        </svg>
                                                        Diverifikasi
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-md bg-red-100 text-red-700">
                                                        <svg class="w-3 h-3 mr-1" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                        Belum Diverifikasi
                                                    </span>
                                                @endif

                                                @if ($all->is_archive == 1)
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-md bg-blue-100 text-blue-700">
                                                        <svg class="w-3 h-3 mr-1" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                                        </svg>
                                                        Diarsipkan
                                                    </span>
                                                @endif

                                                <span class="text-xs text-gray-500">
                                                    {{ $all->created_at->diffForHumans() }}
                                                </span>
                                            </div>
                                        </a>

                                        {{-- Action Buttons --}}
                                        @if (!$all->is_archive)
                                            <div class="flex gap-2 flex-shrink-0">
                                                <a href="{{ route('pengajuan.edit', $all->id) }}"
                                                    class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-md transition-colors"
                                                    title="Edit">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                    </svg>
                                                </a>

                                                <form action="{{ route('pengajuan.destroy', $all->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus submit ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-md transition-colors"
                                                        title="Hapus">
                                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                @empty
                                    <div class="text-center py-12 bg-gray-50 rounded-md">
                                        <div
                                            class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-3">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                            </svg>
                                        </div>
                                        <p class="text-gray-500 font-medium">Belum ada submit</p>
                                        <p class="text-gray-400 text-sm mt-1">Buat submit baru untuk memulai</p>
                                    </div>
                                @endforelse

                                {{ $all_submissions->links() }}
                            </div>
                        </div>

                        {{-- ======================== BAGIAN 3: submit Selesai ======================== --}}
                        <div class="space-y-4">
                            {{-- Section Header --}}
                            <div class="flex items-center justify-between pb-3 border-b-2 border-gray-200">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-green-100 rounded-md flex items-center justify-center">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-800">submit Diverifikasi atau Selesai
                                    </h3>
                                </div>
                                <span class="px-3 py-1 bg-gray-100 text-gray-700 text-sm font-medium rounded-md">
                                    {{ $archive_submit->where('status_kelengkapan', 'Lengkap')->where('status_verifikasi', 1)->count() }}
                                    Item
                                </span>
                            </div>

                            {{-- List Items --}}
                            <div class="space-y-3">
                                @php $no = 1; @endphp

                                @forelse ($archive_submit as $archived)
                                    @if ($archived->requirements_status == 'Lengkap' && $archived->verification_status == 1)
                                        <div
                                            class="flex items-center p-4 bg-white border border-gray-200 rounded-md hover:border-gray-300 hover:shadow-sm transition-all duration-200">
                                            {{-- Number Badge --}}
                                            <div
                                                class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-[#003A8F] text-white font-semibold text-sm rounded-md">
                                                {{ $no++ }}
                                            </div>

                                            {{-- Content --}}
                                            <a href="{{ route('pengajuan.show', $archived->id) }}"
                                                class="flex-1 px-4">
                                                <div class="font-semibold text-gray-800 mb-2">
                                                    {{ $archived->budget_submission_name }}
                                                </div>

                                                <div class="flex flex-wrap items-center gap-2">
                                                    @if ($archived->verification_status == 1)
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-md bg-green-100 text-green-700">
                                                            <svg class="w-3 h-3 mr-1" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                            Selesai
                                                        </span>
                                                    @endif

                                                    <span
                                                        class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-md bg-green-100 text-green-700">
                                                        <svg class="w-3 h-3 mr-1" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        Lengkap
                                                    </span>

                                                    <span
                                                        class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-md bg-green-100 text-green-700">
                                                        <svg class="w-3 h-3 mr-1" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                                        </svg>
                                                        Diverifikasi
                                                    </span>

                                                    @if ($archived->is_archive == 1)
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-md bg-blue-100 text-blue-700">
                                                            <svg class="w-3 h-3 mr-1" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                                            </svg>
                                                            Diarsipkan
                                                        </span>
                                                    @endif

                                                    <span class="text-xs text-gray-500">
                                                        {{ $all->created_at->diffForHumans() }}
                                                    </span>
                                                </div>
                                            </a>

                                            {{-- Action Buttons --}}
                                            @if (!$archived->is_archive)
                                                <div class="flex gap-2 flex-shrink-0">
                                                    <a href="{{ route('pengajuan.edit', $archived->id) }}"
                                                        class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-md transition-colors"
                                                        title="Edit">
                                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                            <path
                                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                        </svg>
                                                    </a>

                                                    <form action="{{ route('pengajuan.destroy', $archived->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Yakin ingin menghapus submit ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-md transition-colors"
                                                            title="Hapus">
                                                            <svg class="w-4 h-4" fill="currentColor"
                                                                viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd"
                                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                @empty
                                    <div class="text-center py-12 bg-gray-50 rounded-md">
                                        <div
                                            class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-3">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <p class="text-gray-500 font-medium">Belum ada submit yang selesai</p>
                                    </div>
                                @endforelse

                                {{ $archive_submit->links() }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
