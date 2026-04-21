<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit User
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

    <div class="py-6 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
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
                <span class="text-gray-700 font-semibold">Edit User</span>
            </div>

            <div class="bg-white shadow-2xl rounded-3xl overflow-hidden border border-gray-200">
                {{-- Header Section --}}
                <div class="relative bg-gradient-to-b from-[#003A8F] to-[#002766] p-2 rounded-xl overflow-hidden">
                    <div class="absolute top-0 right-0 -mt-6 -mr-6 w-40 h-40 bg-white/10 rounded-full"></div>
                    <div class="absolute bottom-0 left-0 -mb-8 -ml-8 w-20 h-20 bg-white/10 rounded-full"></div>
                    <div class="relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-6 items-center">
                        <div class="flex items-center gap-4">
                            <div class="p-4 bg-white/20 rounded-2xl backdrop-blur-sm">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                            </div>

                            <div>
                                <h3 class="text-lg font-bold text-white">Update Informasi User</h3>
                                <p class="text-blue-100 mt-2">Edit data pengguna:
                                    <span class="font-semibold">{{ $user->name }}</span>
                                </p>
                            </div>
                        </div>

                        <!-- RIGHT : USER INFO CARD -->
                        <div class="bg-white/90 backdrop-blur-xl p-2 rounded-xl shadow-lg">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 rounded-full bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center text-white font-bold text-2xl shadow-md">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <h4 class="text-lg font-bold text-gray-800">{{ $user->name }}</h4>
                                    <p class="text-gray-600 text-sm">{{ $user->email }}</p>

                                    <span
                                        class="inline-block mt-2 px-3 py-1 rounded-full text-xs font-bold
                                        {{ $user->role === 'admin' ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700' }}">{{ ucfirst($user->role ?? 'User') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- FORM --}}
                <form action="{{ route('account.update', $user->id) }}" method="POST" class="p-8">
                    @method('PUT')
                    @csrf

                    <div class="space-y-4">
                        {{-- NAME --}}
                        <div class="group">
                            <label class="flex items-center gap-2 text-gray-700 font-semibold mb-3">
                                Nama Lengkap
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="text" name="name" value="{{ $user->name }}"
                                    class="w-full px-5 py-2 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-gray-50 focus:bg-white pl-12"
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
                                <input type="email" name="email" value="{{ $user->email }}"
                                    class="w-full px-5 py-2 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-gray-50 focus:bg-white pl-12"
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
                                <span class="text-gray-400 text-xs font-normal">(Opsional)</span>
                            </label>
                            <div class="relative">
                                <input type="password" name="password"
                                    class="w-full px-5 py-2 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-gray-50 focus:bg-white pl-12"
                                    placeholder="Biarkan kosong jika tidak ingin mengubah">
                                <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>

                        {{-- ROLE --}}
                        <div class="group">
                            <label class="flex items-center gap-2 text-gray-700 font-semibold mb-3">
                                Divisi / Role
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select name="role"
                                    class="w-full px-5 py-2 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-gray-50 focus:bg-white appearance-none cursor-pointer pl-12"
                                    required>
                                    <option value="" disabled>Pilih Divisi</option>
                                    <option value="Kepala" {{ $user->role == 'Kepala' ? 'selected' : '' }}>Kepala
                                        Kantor</option>
                                    <option value="Bendahara" {{ $user->role == 'Bendahara' ? 'selected' : '' }}>
                                        Bendahara</option>
                                    <option value="PPSPM" {{ $user->role == 'PPSPM' ? 'selected' : '' }}>
                                        Bendahara</option>
                                    <option value="Keuangan" {{ $user->role == 'Keuangan' ? 'selected' : '' }}>Keuangan
                                    </option>
                                    <option value="Program" {{ $user->role == 'Program' ? 'selected' : '' }}>Program
                                    </option>
                                    <option value="Berita" {{ $user->role == 'Berita' ? 'selected' : '' }}>Berita
                                    </option>
                                    <option value="Teknik" {{ $user->role == 'Teknik' ? 'selected' : '' }}>Teknik
                                    </option>
                                    <option value="KMB" {{ $user->role == 'KMB' ? 'selected' : '' }}>KMB</option>
                                    <option value="Promo" {{ $user->role == 'Promo' ? 'selected' : '' }}>Promo
                                    </option>
                                    <option value="Umum" {{ $user->role == 'Umum' ? 'selected' : '' }}>Umum</option>
                                    <option value="Tata usaha" {{ $user->role == 'Tata usaha' ? 'selected' : '' }}>Tata
                                        Usaha</option>
                                    <option value="Pengembangan usaha"
                                        {{ $user->role == 'Pengembangan usaha' ? 'selected' : '' }}>Pengembangan Usaha
                                    </option>
                                    <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin
                                    </option>
                                </select>
                                <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z"
                                        clip-rule="evenodd" />
                                    <path
                                        d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- ROLE --}}
                    <div class="group">
                        <label class="flex items-center gap-2 text-gray-700 font-semibold mb-3 mt-3">
                            Sub Divisi
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select name="sub_role"
                                class="w-full px-5 py-2 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-gray-50 focus:bg-white appearance-none cursor-pointer pl-12"
                                required>
                                <option value="" disabled>Pilih kode Akun</option>
                                <option value="GC" {{ $user->sub_role == 'GC' ? 'selected' : '' }}>GC - (Program
                                    Penyiaran Publik)</option>
                                <option value="WA" {{ $user->sub_role == 'WA' ? 'selected' : '' }}>WA - (Program
                                    Dukungan Manajemen)</option>
                            </select>
                            <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z"
                                    clip-rule="evenodd" />
                                <path
                                    d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z" />
                            </svg>
                        </div>
                    </div>

                    {{-- Izinkan Akses Arsip (Radio Version) --}}
                    <div class="group mt-6">
                        <label class="flex items-center gap-2 text-gray-700 font-semibold mb-3">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                            Akses Arsip Digital
                            <span class="text-gray-400 text-xs font-normal">(Opsional)</span>
                        </label>

                        <div
                            class="bg-gradient-to-br from-purple-50 to-indigo-50 border-2 border-purple-200 rounded-xl p-5">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="p-2 bg-purple-100 rounded-lg">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">Izinkan Akses ke Arsip Digital</p>
                                    <p class="text-xs text-gray-600 mt-0.5">Tentukan apakah user dapat mengakses arsip
                                        digital</p>
                                </div>
                            </div>

                            {{-- Radio Options --}}
                            <div class="space-y-3">
                                <label
                                    class="flex items-center p-3 bg-white rounded-lg border-2 border-gray-200 cursor-pointer hover:border-purple-400 transition-all duration-200 has-[:checked]:border-purple-600 has-[:checked]:bg-purple-50">
                                    <input type="radio" name="izin_akses_arsip" value="1"
                                        {{ $user->is_privileged ? 'checked' : '' }}
                                        class="w-5 h-5 text-purple-600 focus:ring-2 focus:ring-purple-500">
                                    <div class="ml-3 flex-1">
                                        <span class="font-medium text-gray-800">Izinkan Akses</span>
                                        <p class="text-xs text-gray-600 mt-0.5">User dapat melihat dan mengunduh arsip
                                            digital</p>
                                    </div>
                                    <svg class="w-5 h-5 text-purple-600 opacity-0 has-[:checked]:opacity-100 transition-opacity"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </label>

                                <label
                                    class="flex items-center p-3 bg-white rounded-lg border-2 border-gray-200 cursor-pointer hover:border-purple-400 transition-all duration-200 has-[:checked]:border-purple-600 has-[:checked]:bg-purple-50">
                                    <input type="radio" name="izin_akses_arsip" value="0"
                                        {{ !$user->is_privileged ? 'checked' : '' }}
                                        class="w-5 h-5 text-purple-600 focus:ring-2 focus:ring-purple-500">
                                    <div class="ml-3 flex-1">
                                        <span class="font-medium text-gray-800">Blokir Akses</span>
                                        <p class="text-xs text-gray-600 mt-0.5">User tidak dapat mengakses arsip
                                            digital</p>
                                    </div>
                                    <svg class="w-5 h-5 text-purple-600 opacity-0 has-[:checked]:opacity-100 transition-opacity"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </label>
                            </div>

                            {{-- Info Box --}}
                            <div class="flex items-start gap-2 p-3 bg-white rounded-lg border border-purple-200 mt-4">
                                <svg class="w-4 h-4 text-purple-600 mt-0.5 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-xs text-purple-800">
                                    Pilih "Izinkan Akses" untuk memberikan akses penuh ke arsip digital. User dengan
                                    akses dapat melihat semua dokumen yang telah diarsipkan.
                                </p>
                            </div>
                        </div>
                    </div>
                    {{-- Action Buttons --}}
                    <div class="text-right pt-8 mt-8 border-t-2 border-gray-200">
                        {{-- Tombol Update --}}
                        <button type="submit"
                            class="group inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-amber-600 to-orange-600 hover:from-amber-700 hover:to-orange-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                            <svg class="w-5 h-5 group-hover:rotate-12 transition-transform duration-300"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Update Akun
                        </button>
                    </div>
                </form>
            </div>

            {{-- Info Box --}}
            <div class="mt-6 bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg">
                <div class="flex items-start gap-3">
                    <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd" />
                    </svg>
                    <div>
                        <h4 class="font-bold text-blue-900 mb-1">Informasi Penting</h4>
                        <ul class="text-sm text-blue-800 space-y-1">
                            <li>• Pastikan email yang digunakan masih aktif dan valid</li>
                            <li>• Password hanya perlu diisi jika ingin mengubahnya</li>
                            <li>• Pilih divisi/role sesuai dengan tugas dan tanggung jawab user</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
