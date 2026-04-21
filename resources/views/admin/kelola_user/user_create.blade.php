<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Create User
        </h2>
    </x-slot>

    {{-- TOMBOL KEMBALI --}}
    <div class="#">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
            <a href="{{ route('account.index') }}"
                class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-2 py-2 rounded-full border border-gray-200
                    shadow-lg transition-all duration-200 ease-in-out hover:bg-gray-400 hover:shadow-md active:bg-gray-300 active:scale-95">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>             
        </div>
    </div>

    <div class="py-10 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            {{-- Breadcrumb --}}
            <div class="mb-6 flex items-center gap-2 text-sm">
                <a href="{{ route('account.index') }}" class="text-gray-500 hover:text-blue-600 transition-colors">
                    Kelola User
                </a>
                <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd" />
                </svg>
                <span class="text-gray-700 font-semibold">Create User</span>
            </div>

            <div class="bg-white shadow-2xl rounded-3xl overflow-hidden border border-gray-200">

                {{-- Header Section --}}
                <div class="relative bg-gradient-to-b from-[#003A8F] to-[#002766] p-4">
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-20 h-20 bg-white opacity-10 rounded-full"></div>
                    <div class="absolute bottom-0 left-0 -mb-8 -ml-8 w-20 h-20 bg-white opacity-10 rounded-full"></div>

                    <div class="relative z-10 flex items-center gap-4">
                        <div class="p-4 bg-white bg-opacity-20 rounded-2xl backdrop-blur-sm">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-white">
                                Daftarkan Akun Baru
                            </h3>
                            <p class="text-green-100 mt-2">Tambahkan pengguna baru ke dalam sistem</p>
                        </div>
                    </div>
                </div>

                {{-- Info Banner --}}
                <div class="p-6 bg-gradient-to-r from-green-50 to-emerald-50 border-b-2 border-gray-200">
                    <div class="flex items-start gap-3">
                        <div class="flex-shrink-0 p-2 bg-green-100 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 mb-1">Pastikan Data yang Diisi Benar</h4>
                            <p class="text-sm text-gray-600">Semua field dengan tanda (<span
                                    class="text-red-500 font-bold">*</span>) wajib diisi dengan data yang valid dan
                                akurat.</p>
                        </div>
                    </div>
                </div>

                {{-- FORM --}}
                <form action="{{ route('account.store') }}" method="POST" class="p-8">
                    @csrf

                    <div class="space-y-4">

                        {{-- NAME --}}
                        <div class="group">
                            <label class="flex items-center gap-2 text-gray-700 font-semibold mb-3">
                                Nama Lengkap
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="text" name="name"
                                    class="w-full px-5 py-2 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-300 bg-gray-50 focus:bg-white pl-12"
                                    placeholder="Masukkan nama lengkap" required>
                                <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>

                        {{-- EMAIL --}}
                        <div class="group">
                            <label class="flex items-center gap-2 text-gray-700 font-semibold mb-3">
                                Email
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="email" name="email"
                                    class="w-full px-5 py-2 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-300 bg-gray-50 focus:bg-white pl-12"
                                    placeholder="contoh@email.com" required>
                                <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                            </div>
                        </div>

                        {{-- PASSWORD --}}
                        <div class="group">
                            <label class="flex items-center gap-2 text-gray-700 font-semibold mb-3">
                                Password
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="password" name="password"
                                    class="w-full px-5 py-2 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-300 bg-gray-50 focus:bg-white pl-12"
                                    placeholder="Masukkan password" required>
                                <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div
                                class="mt-2 flex items-start gap-2 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                                <svg class="w-5 h-5 text-yellow-600 flex-shrink-0 mt-0.5" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                <div class="text-xs text-yellow-800">
                                    <strong>Tips keamanan password:</strong> Gunakan minimal 8 karakter dengan kombinasi
                                    huruf besar, kecil, angka, dan simbol
                                </div>
                            </div>
                        </div>

                        {{-- ROLE --}}
                        <div class="group">
                            <label class="flex items-center gap-2 text-gray-700 font-semibold mb-3">
                                Role / Hak Akses
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select name="role"
                                    class="w-full px-5 py-2 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-300 bg-gray-50 focus:bg-white appearance-none cursor-pointer pl-12"
                                    required>
                                    <option value="" selected disabled>-- Pilih Role --</option>
                                    <option value="Kepala Kantor TVRI" class="bg-yellow-100">Kepala Kantor TVRI</option>
                                    <option value="Bendahara" class="bg-blue-100">Bendahara</option>
                                    <option value="PPSPM" class="bg-blue-100">PPSPM</option>
                                    <option value="Keuangan" class="bg-blue-100">Keuangan</option>
                                    <option value="Program">Program</option>
                                    <option value="Berita">Berita</option>
                                    <option value="Teknik">Teknik</option>
                                    <option value="KMB">KMB</option>
                                    <option value="Promo">Promo</option>
                                    <option value="Umum">Umum</option>
                                    <option value="Tata usaha">Tata usaha</option>
                                    <option value="Pengembangan usaha">Pengembangan usaha</option>
                                </select>
                                <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z"
                                        clip-rule="evenodd" />
                                    <path
                                        d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z" />
                                </svg>
                                <svg class="absolute right-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="mt-2 text-xs text-gray-500 ml-1">Pilih level akses sesuai dengan tanggung jawab
                                user</p>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="text-right pt-8 mt-8 border-t-2 border-gray-200">
                        {{-- Tombol Buat Akun --}}
                        <button type="submit"
                            class="group inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                            <svg class="w-5 h-5 group-hover:rotate-90 transition-transform duration-300"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            Buat Akun
                        </button>
                    </div>
                </form>
            </div>

            {{-- Additional Info Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">

                {{-- Card 1 --}}
                <div
                    class="bg-white p-5 rounded-xl shadow-lg border-l-4 border-blue-500 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-start gap-3">
                        <div class="p-2 bg-blue-100 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm mb-1">Data Valid</h4>
                            <p class="text-xs text-gray-600">Pastikan semua data yang dimasukkan benar dan akurat</p>
                        </div>
                    </div>
                </div>

                {{-- Card 2 --}}
                <div
                    class="bg-white p-5 rounded-xl shadow-lg border-l-4 border-yellow-500 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-start gap-3">
                        <div class="p-2 bg-yellow-100 rounded-lg">
                            <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm mb-1">Password Kuat</h4>
                            <p class="text-xs text-gray-600">Gunakan password yang sulit ditebak untuk keamanan</p>
                        </div>
                    </div>
                </div>

                {{-- Card 3 --}}
                <div
                    class="bg-white p-5 rounded-xl shadow-lg border-l-4 border-green-500 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-start gap-3">
                        <div class="p-2 bg-green-100 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z"
                                    clip-rule="evenodd" />
                                <path
                                    d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm mb-1">Role Tepat</h4>
                            <p class="text-xs text-gray-600">Pilih role sesuai tugas dan tanggung jawab user</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
