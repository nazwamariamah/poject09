<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aplikasi Pengajuan dan Arsip Keuangan</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-gradient-to-br from-slate-50 to-blue-50">
    <!-- Navigation -->
    <nav class="bg-white/80 backdrop-blur-sm border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-gradient-to-br from-blue-600 to-cyan-500 rounded-md"></div>
                        <h1 class="text-xl font-bold text-slate-900">VVeP APP</h1>
                    </div>
                </div>
                @if (Route::has('login'))
                    <div class="flex items-center space-x-3">
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="text-slate-700 hover:text-blue-600 px-4 py-2 text-sm font-medium transition-colors">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="text-slate-700 hover:text-blue-600 px-4 py-2 text-sm font-medium transition-colors">
                                Masuk
                            </a>
                            @if (Route::has('register'))
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-white py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-4xl mx-auto">
                <div class="inline-block mb-4 px-4 py-1.5 bg-blue-50 text-blue-700 rounded-full text-sm font-medium">
                    Sistem Verifikasi dan Validasi Elektronik Pembayaran
                </div>
                <h2 class="text-4xl font-bold text-slate-900 sm:text-5xl md:text-6xl leading-relaxed">
                    Kelola Pengajuan dengan<br>
                    <span class="block mt-6 text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-500">Lebih Efisien</span>
                </h2>
                <p class="mt-6 text-lg text-slate-600 max-w-2xl mx-auto">
                    Platform terintegrasi untuk pengajuan kegiatan, barang, dan administrasi lainnya dengan proses verifikasi yang terstruktur dan mudah dipantau.
                </p>

                <!-- CTA Buttons -->
                @if (Route::has('login'))
                    <div class="mt-10 flex justify-center gap-4">
                        @guest
                            <a href="{{ route('login') }}"
                                class="bg-gradient-to-r from-blue-600 to-cyan-500 text-white px-8 py-3.5 rounded-md text-base font-medium hover:from-blue-700 hover:to-cyan-600 transition-all">
                                Masuk
                            </a>
                        @else
                            <a href="{{ url('/dashboard') }}"
                                class="bg-gradient-to-r from-blue-600 to-cyan-500 text-white px-8 py-3.5 rounded-md text-base font-medium hover:from-blue-700 hover:to-cyan-600 transition-all">
                                Buka Dashboard
                            </a>
                        @endguest
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Features Grid -->
    <section class="py-20 bg-gradient-to-br from-slate-50 to-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h3 class="text-3xl font-bold text-slate-900">Fitur Unggulan</h3>
                <p class="mt-3 text-lg text-slate-600">Solusi lengkap untuk pengajuan dan verifikasi digital</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Feature 1 -->
                <div class="bg-white p-8 rounded-md border border-slate-200 hover:border-blue-300 transition-colors">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-cyan-500 rounded-md flex items-center justify-center mb-5">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-slate-900 mb-3">Pengajuan Digital</h4>
                    <p class="text-slate-600 leading-relaxed">Ajukan kegiatan, barang, atau administrasi lainnya secara online dengan formulir yang mudah diisi.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-8 rounded-md border border-slate-200 hover:border-blue-300 transition-colors">
                    <div class="w-12 h-12 bg-gradient-to-br from-cyan-500 to-teal-500 rounded-md flex items-center justify-center mb-5">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-slate-900 mb-3">Arsip Terorganisir</h4>
                    <p class="text-slate-600 leading-relaxed">Simpan dan kelola semua dokumen pengajuan dalam sistem terstruktur yang mudah diakses.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-8 rounded-md border border-slate-200 hover:border-blue-300 transition-colors">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-cyan-500 rounded-md flex items-center justify-center mb-5">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-slate-900 mb-3">Tracking Real-time</h4>
                    <p class="text-slate-600 leading-relaxed">Pantau status verifikasi pengajuan dengan notifikasi otomatis di setiap tahapan.</p>
                </div>

                <!-- Feature 4 -->
                <div class="bg-white p-8 rounded-md border border-slate-200 hover:border-blue-300 transition-colors">
                    <div class="w-12 h-12 bg-gradient-to-br from-cyan-500 to-teal-500 rounded-md flex items-center justify-center mb-5">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-slate-900 mb-3">Keamanan Terjamin</h4>
                    <p class="text-slate-600 leading-relaxed">akses berbasis role pengguna.</p>
                </div>

                <!-- Feature 5 -->
                <div class="bg-white p-8 rounded-md border border-slate-200 hover:border-blue-300 transition-colors">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-cyan-500 rounded-md flex items-center justify-center mb-5">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-slate-900 mb-3">Sistem Verifikasi</h4>
                    <p class="text-slate-600 leading-relaxed">Proses persetujuan bertingkat oleh divisi keuangan dan bendahara yang terstruktur.</p>
                </div>

                <!-- Feature 6 -->
                <div class="bg-white p-8 rounded-md border border-slate-200 hover:border-blue-300 transition-colors">
                    <div class="w-12 h-12 bg-gradient-to-br from-cyan-500 to-teal-500 rounded-md flex items-center justify-center mb-5">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-slate-900 mb-3">Multi User Role</h4>
                    <p class="text-slate-600 leading-relaxed">Kelola akses untuk pengaju, verifikator, dan bendahara dengan izin berbeda.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div>
                    <h3 class="text-3xl font-bold text-slate-900 mb-8">Mengapa Memilih Kami?</h3>
                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-cyan-500 text-white flex items-center justify-center rounded-md font-semibold">1</div>
                            </div>
                            <div>
                                <h4 class="font-semibold text-slate-900 mb-1.5">Efisiensi Waktu</h4>
                                <p class="text-slate-600">Proses pengajuan dan verifikasi lebih cepat hingga 70% dibanding metode manual.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-gradient-to-br from-cyan-500 to-teal-500 text-white flex items-center justify-center rounded-md font-semibold">2</div>
                            </div>
                            <div>
                                <h4 class="font-semibold text-slate-900 mb-1.5">Paperless System</h4>
                                <p class="text-slate-600">Hemat biaya operasional dan ramah lingkungan dengan sistem digital.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-cyan-500 text-white flex items-center justify-center rounded-md font-semibold">3</div>
                            </div>
                            <div>
                                <h4 class="font-semibold text-slate-900 mb-1.5">Transparansi Penuh</h4>
                                <p class="text-slate-600">Tingkatkan akuntabilitas dengan riwayat persetujuan yang jelas dan terperinci.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-gradient-to-br from-cyan-500 to-teal-500 text-white flex items-center justify-center rounded-md font-semibold">4</div>
                            </div>
                            <div>
                                <h4 class="font-semibold text-slate-900 mb-1.5">Akses Fleksibel</h4>
                                <p class="text-slate-600">Akses sistem dari mana saja dan kapan saja melalui perangkat apapun.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-blue-50 to-cyan-50 p-16 rounded-md">
                    <div class="bg-white p-8 rounded-md border border-slate-200">
                        <div class="text-center">
                            <div class="w-20 h-20 bg-gradient-to-br from-blue-600 to-cyan-500 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <h4 class="text-xl font-bold text-slate-900 mb-2">Sistem Terpercaya</h4>
                            <p class="text-slate-600">Dipercaya oleh TVRI Stasiun Kalimanatan Selatan untuk mengelola pengajuan mereka</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-3 gap-12">
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 bg-gradient-to-br from-blue-600 to-cyan-500 rounded-md"></div>
                        <h4 class="text-lg font-semibold">VVeP APP</h4>
                    </div>
                    <p class="text-slate-400 leading-relaxed">
                        Solusi digital untuk mengelola pengajuan dan arsip dokumen dengan efisien dan aman.
                    </p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2.5">
                        @if (Route::has('login'))
                            @guest
                                <li><a href="{{ route('login') }}" class="text-slate-400 hover:text-cyan-400 transition-colors">Masuk</a></li>
                                {{-- <li><a href="{{ route('register') }}" class="text-slate-400 hover:text-cyan-400 transition-colors">Daftar</a></li> --}}
                            @else
                                <li><a href="{{ url('/dashboard') }}" class="text-slate-400 hover:text-cyan-400 transition-colors">Dashboard</a></li>
                            @endguest
                        @endif
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Developer</h4>
                    <div class="space-y-4">
                        <div>
                            <p class="text-white font-medium">Ryandy Rhamadhany</p>
                            <p class="text-slate-500 text-sm mb-1">Backend Developer</p>
                            <a href="https://www.instagram.com/ryandyrhamadhany23?igsh=bXYwNzl1d2dxZmd1" target="_blank" class="text-slate-400 hover:text-cyan-400 text-sm transition-colors">
                                @ryandyrhamadhany23
                            </a>
                        </div>
                        <div>
                            <p class="text-white font-medium">Muhammad Maulidi</p>
                            <p class="text-slate-500 text-sm mb-1">Frontend Developer</p>
                            <a href="https://instagram.com/username2" target="_blank" class="text-slate-400 hover:text-cyan-400 text-sm transition-colors">
                                @username2
                            </a>
                        </div>
                        <div>
                            <p class="text-white font-medium">Muhammad Rio Bisma Saputra</p>
                            <p class="text-slate-500 text-sm mb-1">Frontend Developer</p>
                            <a href="https://instagram.com/username3" target="_blank" class="text-slate-400 hover:text-cyan-400 text-sm transition-colors">
                                @username3
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-t border-slate-800 mt-12 pt-8 text-center text-sm text-slate-400">
                <p>&copy; {{ date('Y') }} VVeP. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>

</html>