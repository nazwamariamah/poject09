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
                        <h1 class="text-3xl font-bold">Selamat Datang di Dashboard Administrator!</h1>
                    </div>
                    <p class="text-lg opacity-90 ml-13">
                        Kelola dokumen, pantau statistik, dan akses fitur dengan lebih mudah.
                    </p>
                </div>
            </div>

            {{-- STATISTICS CARDS --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

                {{-- Jumlah Arsip --}}
                <div class="group relative p-8 bg-white shadow-lg rounded-2xl border-t-4 border-purple-500 hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Jumlah Arsip</p>
                            <h3 class="text-4xl font-extrabold text-gray-800 mt-3">
                                {{ $arsip ?? $dokumenTersimpan }}
                            </h3>
                            <p class="text-xs text-purple-600 mt-2 font-semibold">Dokumen diarsipkan</p>
                        </div>
                        <div class="p-4 bg-purple-100 rounded-xl group-hover:bg-purple-500 transition-colors duration-300">
                            <svg class="w-8 h-8 text-purple-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Jumlah Pengajuan --}}
                <div class="group relative p-8 bg-white shadow-lg rounded-2xl border-t-4 border-orange-500 hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Jumlah Pengajuan</p>
                            <h3 class="text-4xl font-extrabold text-gray-800 mt-3">
                                {{ $pengajuan ?? ($dokumenTersimpan + $dokumenTidakTersimpan) }}
                            </h3>
                            <p class="text-xs text-orange-600 mt-2 font-semibold">Total pengajuan masuk</p>
                        </div>
                        <div class="p-4 bg-orange-100 rounded-xl group-hover:bg-orange-500 transition-colors duration-300">
                            <svg class="w-8 h-8 text-orange-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Jumlah User --}}
                <div class="group relative p-8 bg-white shadow-lg rounded-2xl border-t-4 border-blue-500 hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Jumlah User</p>
                            <h3 class="text-4xl font-extrabold text-gray-800 mt-3">
                                {{ $akun ?? $jumlahUser }}
                            </h3>
                        </div>
                        <div class="p-4 bg-blue-100 rounded-xl group-hover:bg-blue-500 transition-colors duration-300">
                            <svg class="w-8 h-8 text-blue-600 group-hover:text-white transition-colors duration-300" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                            </svg>
                        </div>
                    </div>
                </div>

            </div>

            {{-- CHART SECTION --}}
            <div class="bg-white p-8 rounded-2xl shadow-lg mb-8">
                <div class="flex items-center justify-between pb-3 border-b-2 border-gray-200 mb-6">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">Statistik Kelengkapan Dokumen</h3>
                    </div>
                </div>
                
                <div class="max-w-xs mx-auto" style="height: 280px;">
                    <canvas id="documentChart"></canvas>
                </div>
            </div>

            {{-- LIST ARSIP SECTION --}}
            <div class="bg-white p-8 rounded-2xl shadow-lg">
                {{-- Section Header --}}
                <div class="flex items-center justify-between pb-3 border-b-2 border-gray-200 mb-6">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-purple-100 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">Daftar Arsip</h3>
                    </div>
                    <span class="px-3 py-1 bg-gray-100 text-gray-700 text-sm font-medium rounded-md">
                        {{ $arsip ?? $dokumenTersimpan }} Arsip
                    </span>
                </div>

                @php
                    $no = 1;
                @endphp

                {{-- List Items --}}
                <div class="space-y-3">
                    @forelse ($arsiplist ?? [] as $ar)
                        <div class="flex items-center p-4 bg-white border border-gray-200 rounded-md hover:border-gray-300 hover:shadow-sm transition-all duration-200">
                            {{-- Number Badge --}}
                            <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-[#003A8F] text-white font-semibold text-sm rounded-md">
                                {{ $no++ }}
                            </div>

                            {{-- Content --}}
                            <a href="#" class="flex-1 px-4">
                                <div class="font-semibold text-gray-800 mb-2">
                                    {{ $ar->archive_name }}
                                </div>
                            </a>

                            {{-- Action Button --}}
                            <a href="{{ route('digital.show', $ar->id) }}" class="flex-shrink-0 ml-4 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition-all duration-300 shadow-md hover:shadow-xl flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                </svg>
                                Lihat
                            </a>
                        </div>
                    @empty
                        <div class="text-center py-12 bg-gray-50 rounded-md">
                            <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                </svg>
                            </div>
                            <p class="text-gray-500 font-medium">Belum ada arsip</p>
                            <p class="text-gray-400 text-sm mt-1">Arsip pengajuan yang selesai akan muncul di sini</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>

    {{-- CHART SCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const ctx = document.getElementById('documentChart').getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($chartLabels ?? ['Dokumen Tersimpan', 'Belum Upload File']) !!},
                    datasets: [{
                        label: 'Jumlah Dokumen',
                        data: [15, 5], // Ini angka dummy (15 tersimpan, 5 belum upload)
                        backgroundColor: ['#4e73df', '#e74a3b'],
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>