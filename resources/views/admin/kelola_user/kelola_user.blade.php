<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Kelola User
        </h2>
    </x-slot>

    <div class="py-10 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                {{-- Total Users --}}
                <div class="group bg-white p-6 rounded-2xl shadow-lg border-t-4 border-blue-500 hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total User</p>
                            <h3 class="text-4xl font-extrabold text-gray-800 mt-3">
                                {{ $users->count() }}
                            </h3>
                            <p class="text-xs text-blue-600 mt-2 font-semibold">Terdaftar dalam sistem</p>
                        </div>
                        <div class="p-4 bg-blue-100 rounded-xl group-hover:bg-blue-500 transition-colors duration-300">
                            <svg class="w-8 h-8 text-blue-600 group-hover:text-white transition-colors duration-300" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Admin Count --}}
                <div class="group bg-white p-6 rounded-2xl shadow-lg border-t-4 border-red-500 hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Administrator</p>
                            <h3 class="text-4xl font-extrabold text-gray-800 mt-3">
                                {{ $users->whereIn('role', ['Admin', 'admin'])->count() }}
                            </h3>
                            <p class="text-xs text-red-600 mt-2 font-semibold">Administrator aktif</p>
                        </div>
                        <div class="p-4 bg-red-100 rounded-xl group-hover:bg-red-500 transition-colors duration-300">
                            <svg class="w-8 h-8 text-red-600 group-hover:text-white transition-colors duration-300" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- User Count --}}
                <div class="group bg-white p-6 rounded-2xl shadow-lg border-t-4 border-green-500 hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">User Biasa</p>
                            <h3 class="text-4xl font-extrabold text-gray-800 mt-3">
                                {{ $users->whereNotIn('role', ['Admin', 'admin'])->count() }}
                            </h3>
                            <p class="text-xs text-green-600 mt-2 font-semibold">Pengguna standar</p>
                        </div>
                        <div class="p-4 bg-green-100 rounded-xl group-hover:bg-green-500 transition-colors duration-300">
                            <svg class="w-8 h-8 text-green-600 group-hover:text-white transition-colors duration-300" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Main Content --}}
            <div class="bg-white shadow-2xl rounded-2xl overflow-hidden">

                {{-- HEADER --}}
                <div class="bg-gradient-to-b from-[#003A8F] to-[#002766] p-6">
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-white bg-opacity-20 rounded-xl backdrop-blur-sm">
                                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-white">
                                    Daftar User Terdaftar
                                </h3>
                                <p class="text-blue-100 text-sm mt-1">Kelola akses dan hak pengguna</p>
                            </div>
                        </div>

                        <a href="{{ route('account.create') }}"
                            class="group inline-flex items-center gap-2 px-6 py-3 bg-white hover:bg-gray-50 text-blue-600 font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                            <svg class="w-5 h-5 group-hover:rotate-90 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                            </svg>
                            Register User Baru
                        </a>
                    </div>
                </div>

                {{-- SEARCH BAR SECTION --}}
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('account.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                        <div class="relative flex-1">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <input 
                                type="text" 
                                name="search" 
                                value="{{ request('search') }}" 
                                placeholder="Cari nama, email, role, atau sub-role user..." 
                                class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm text-gray-800 transition-all"
                            >
                        </div>
                        <div class="flex gap-2">
                            <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm rounded-xl transition-all shadow-md hover:shadow-lg flex items-center justify-center gap-2">
                                Cari
                            </button>
                            @if(request('search'))
                                <a href="{{ route('account.index') }}" class="px-5 py-2.5 bg-gray-500 hover:bg-gray-600 text-white font-semibold text-sm rounded-xl transition-all shadow-md flex items-center justify-center">
                                    Reset
                                </a>
                            @endif
                        </div>
                    </form>
                </div>

                {{-- TABLE USER --}}
                @if ($users->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd"/>
                                            </svg>
                                            No
                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                            </svg>
                                            Nama
                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                            </svg>
                                            Email
                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"/>
                                                <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"/>
                                            </svg>
                                            Role
                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                                        <div class="flex items-center justify-center gap-2">
                                            <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                                            </svg>
                                            Aksi
                                        </div>
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @php $no = 1; @endphp

                                @foreach ($users as $user)
                                    <tr class="group hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-200">
                                        {{-- Number --}}
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white font-bold shadow-md group-hover:scale-110 transition-transform duration-300">
                                                {{ $no++ }}
                                            </div>
                                        </td>

                                        {{-- Name --}}
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-3">
                                                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-gradient-to-br from-purple-400 to-pink-500 flex items-center justify-center text-white font-bold shadow-md">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <div class="text-sm font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                                                        {{ $user->name }}
                                                    </div>
                                                    <div class="text-xs text-gray-500">ID: #{{ $user->id }}</div>
                                                </div>
                                            </div>
                                        </td>

                                        {{-- Email --}}
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-2">
                                                <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                                </svg>
                                                <span class="text-sm text-gray-700">{{ $user->email }}</span>
                                            </div>
                                        </td>

                                        {{-- Role --}}
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if(strtolower($user->role) === 'admin')
                                                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-bold bg-gradient-to-r from-red-500 to-pink-600 text-white shadow-md">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M9.504 1.132a1 1 0 01.992 0l1.75 1a1 1 0 11-.992 1.736L10 3.152l-1.254.716a1 1 0 11-.992-1.736l1.75-1zM5.618 4.504a1 1 0 01-.372 1.364L5.016 6l.23.132a1 1 0 11-.992 1.736L4 7.723V8a1 1 0 01-2 0V6a.996.996 0 01.52-.878l1.734-.99a1 1 0 011.364.372zm8.764 0a1 1 0 011.364-.372l1.733.99A1.002 1.002 0 0118 6v2a1 1 0 11-2 0v-.277l-.254.145a1 1 0 11-.992-1.736l.23-.132-.23-.132a1 1 0 01-.372-1.364zm-7 4a1 1 0 011.364-.372L10 8.848l1.254-.716a1 1 0 11.992 1.736L11 10.58V12a1 1 0 11-2 0v-1.42l-1.246-.712a1 1 0 01-.372-1.364zM3 11a1 1 0 011 1v1.42l1.246.712a1 1 0 11-.992 1.736l-1.75-1A1 1 0 012 14v-2a1 1 0 011-1zm14 0a1 1 0 011 1v2a1 1 0 01-.504.868l-1.75 1a1 1 0 11-.992-1.736L16 13.42V12a1 1 0 011-1zm-9.618 5.504a1 1 0 011.364-.372l.254.145V16a1 1 0 112 0v.277l.254-.145a1 1 0 11.992 1.736l-1.735.992a.995.995 0 01-1.022 0l-1.735-.992a1 1 0 01-.372-1.364z" clip-rule="evenodd"/>
                                                    </svg>
                                                    Admin
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-bold bg-gradient-to-r from-blue-500 to-indigo-600 text-white shadow-md">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                                    </svg>
                                                    {{ $user->role }}
                                                </span>
                                            @endif
                                        </td>

                                        {{-- Actions --}}
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex justify-center gap-3">
                                                {{-- EDIT BUTTON --}}
                                                <a href="{{ route('account.edit', $user->id) }}"
                                                    class="group/btn relative p-3 bg-gradient-to-br from-yellow-400 to-orange-500 hover:from-yellow-500 hover:to-orange-600 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 hover:scale-110"
                                                    title="Edit User">
                                                    <svg class="w-5 h-5 text-white group-hover/btn:rotate-12 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                                    </svg>
                                                </a>

                                                {{-- DELETE BUTTON --}}
                                                <form action="{{ route('account.destroy', $user->id) }}" method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="group/btn relative p-3 bg-gradient-to-br from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 hover:scale-110"
                                                        title="Hapus User">
                                                        <svg class="w-5 h-5 text-white group-hover/btn:rotate-12 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination Footer --}}
                    @if(method_exists($users, 'links'))
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                        {{ $users->appends(request()->query())->links() }}
                    </div>
                    @endif

                @else
                    {{-- Empty State --}}
                    <div class="p-16 text-center">
                        <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-100 rounded-full mb-6">
                            <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-700 mb-3">
                            {{ request('search') ? 'User Tidak Ditemukan' : 'Belum Ada User' }}
                        </h3>
                        <p class="text-gray-500 mb-8 max-w-md mx-auto">
                            {{ request('search') ? 'Coba gunakan kata kunci pencarian yang lain.' : 'Mulai dengan mendaftarkan user pertama untuk sistem Anda.' }}
                        </p>
                        @if(request('search'))
                            <a href="{{ route('account.index') }}"
                                class="inline-flex items-center gap-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold px-8 py-3.5 rounded-xl shadow-lg transition-all duration-300">
                                Lihat Semua User
                            </a>
                        @else
                            <a href="{{ route('account.create') }}"
                                class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold px-8 py-4 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                                </svg>
                                Register User Pertama
                            </a>
                        @endif
                    </div>
                @endif

            </div>

        </div>
    </div>
</x-app-layout>