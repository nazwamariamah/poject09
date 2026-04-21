<aside
    class="w-60 min-h-screen bg-gradient-to-b from-[#003A8F] to-[#002766] text-white shadow-2xl flex flex-col transition-all duration-300 hover:shadow-blue-500/20 relative overflow-hidden">
    <!-- Background Decorative Elements -->
    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-[#1890FF] to-[#0050C8]"></div>
    <div class="absolute -top-20 -right-20 w-40 h-40 bg-blue-500/10 rounded-full blur-xl"></div>
    <div class="absolute -bottom-20 -left-20 w-40 h-40 bg-purple-500/10 rounded-full blur-xl"></div>

    {{-- LOGO ENHANCED --}}
    <div
        class="h-20 flex items-center justify-center bg-gray-800/50 border border-gray-700/30 hover:bg-gray-800/70 backdrop-blur-sm relative z-10 px-4">
        <a href="{{ route('dashboard') }}"
            class="group flex items-center space-x-3 transition-all duration-300 hover:scale-105">
            <img src="{{ asset('images/Logo.png') }}" class="h-12" alt="Logo">
            <div class="flex flex-col">
                <span
                    class="font-bold text-xm bg-gradient-to-b from-[#ffffff] to-[#6895fd]
                        bg-clip-text text-transparent tracking-wide hidden sm:block">VVeP App</span>
                <span class="text-xs text-gray-400 font-medium">{{ Auth::user()->role }}</span>
            </div>
        </a>
    </div>

    {{-- MAIN NAVIGATION --}}
    <nav class="flex-1 p-4 space-y-1 overflow-y-auto relative z-10">
        @php
            use Illuminate\Support\Facades\Auth;
            use App\Models\Notification;
        @endphp
        @php
            $role = Auth::user()->role;
            $privileged = Auth::user()->is_privileged;

            $roleDashboard = match ($role) {
                'Admin' => route('admin.dashboard'),
                'Keuangan' => route('keuangan.dashboard'),
                'Bendahara' => route('bendahara.dashboard'),
                'PPSPM' => route('PPSPM.dashboard'),
                'Kepala Kantor TVRI' => route('kepala.dashboard'),
                default => route('user.dashboard'),
            };

            $roleEnvironment = match ($role) {
                'Admin' => route('admin.envi'),
                default => route('user.dashboard'),
            };

            $roleInputArsip =
                in_array($role, ['Admin', 'Bendahara', 'Keuangan', 'Kepala Kantor TVRI', 'PPSPM']) || $privileged ? route('cabinet.index') : '#';

            $roleKelolaUser = $role === 'Admin' ? route('account.index') : '#';

            $pengajuan = in_array($role, ['Admin', 'Keuangan']) ? '#' : route('submit.index');

            $worklist = in_array($role, ['Admin', 'Keuangan']) ? '#' : route('user.monitoring');

            $roleDigitalArsip = in_array($role, ['Keuangan', 'Bendahara']) ? route('digital.index') : '#';

            $unreadCount = Notification::where('user_id', Auth::id())->where('is_read', false)->count();
            $notificationRoute = route('notifications.index');

            $roleReport = match ($role) {
                'Admin' => route('admin.report'),
                'Bendahara' => route('bendahara.report'),
                'Keuangan' => route('keuangan.report'),
                'Kepala Kantor TVRI' => route('kepala.report'),
                default => route('user.report'),
            };

            // Define icons for each menu item
            $icons = [
                'Dashboard' =>
                    'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
                'Report' =>
                    'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
                'Setting Environment' =>
                    'M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8v2m0-2a2 2 0 100 4m0-4a2 2 0 110 4m12-2v2m0-2a2 2 0 100 4m0-4a2 2 0 110 4',
                'Input Arsip' =>
                    'M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                'Kelola User' =>
                    'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5 3.75V14.25m0 3.75h-6m6 0h-6m0 0V8.25',
                'Digital Arsip' => 'M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4',
                'Pengajuan' =>
                    'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                'Monitoring' =>
                    'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2',
                'Notifikasi' =>
                    'M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0a3 3 0 11-6 0h6z',
                'Profile' =>
                    'M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z',
                'Logout' => 'M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1',
            ];

            // Define menu items based on role
            $menuItems = [];

            if ($role === 'Admin') {
                $menuItems = [
                    ['label' => 'Dashboard', 'href' => $roleDashboard, 'icon' => $icons['Dashboard']],
                    [
                        'label' => 'Setting Environment',
                        'href' => $roleEnvironment,
                        'icon' => $icons['Setting Environment'],
                    ],
                    ['label' => 'Arsip', 'href' => $roleInputArsip, 'icon' => $icons['Input Arsip']],
                    ['label' => 'Kelola User', 'href' => $roleKelolaUser, 'icon' => $icons['Kelola User']],
                    ['label' => 'Report', 'href' => $roleReport, 'icon' => $icons['Report']],
                    
                ];
            } elseif ($role === 'Keuangan') {
                $menuItems = [
                    ['label' => 'Dashboard', 'href' => $roleDashboard, 'icon' => $icons['Dashboard']],
                    ['label' => 'Pengajuan', 'href' => route('verification.index'), 'icon' => $icons['Pengajuan']],
                    // ['label' => 'Digital Arsip', 'href' => $roleDigitalArsip, 'icon' => $icons['Digital Arsip']],
                    ['label' => 'Arsip', 'href' => $roleInputArsip, 'icon' => $icons['Input Arsip']],
                    [
                        'label' => 'Notifikasi',
                        'href' => $notificationRoute,
                        'icon' => $icons['Notifikasi'],
                        'badge' => $unreadCount,
                    ],
                    ['label' => 'Report', 'href' => $roleReport, 'icon' => $icons['Report']],
                ];
            } elseif ($role === 'Bendahara') {
                $menuItems = [
                    ['label' => 'Dashboard', 'href' => $roleDashboard, 'icon' => $icons['Dashboard']],
                    ['label' => 'Pengajuan', 'href' => route('final.index'), 'icon' => $icons['Pengajuan']],
                    // ['label' => 'Digital Arsip', 'href' => $roleDigitalArsip, 'icon' => $icons['Digital Arsip']],
                    ['label' => 'Arsip', 'href' => $roleInputArsip, 'icon' => $icons['Input Arsip']],
                    
                    [
                        'label' => 'Notifikasi',
                        'href' => $notificationRoute,
                        'icon' => $icons['Notifikasi'],
                        'badge' => $unreadCount,
                    ],
                    ['label' => 'Report', 'href' => $roleReport, 'icon' => $icons['Report']],
                ];
            } elseif ($role === 'PPSPM') {
                $menuItems = [
                    ['label' => 'Dashboard', 'href' => $roleDashboard, 'icon' => $icons['Dashboard']],
                    ['label' => 'Pengajuan', 'href' => route('validation.index'), 'icon' => $icons['Pengajuan']],
                    // ['label' => 'Digital Arsip', 'href' => $roleDigitalArsip, 'icon' => $icons['Digital Arsip']],
                    ['label' => 'Arsip', 'href' => $roleInputArsip, 'icon' => $icons['Input Arsip']],
                    
                    [
                        'label' => 'Notifikasi',
                        'href' => $notificationRoute,
                        'icon' => $icons['Notifikasi'],
                        'badge' => $unreadCount,
                    ],
                    // ['label' => 'Report', 'href' => $roleReport, 'icon' => $icons['Report']],
                ];
            } elseif ($role === 'Kepala Kantor TVRI') {
                $menuItems = [
                    ['label' => 'Dashboard', 'href' => $roleDashboard, 'icon' => $icons['Dashboard']],
                    ['label' => 'Arsip', 'href' => $roleInputArsip, 'icon' => $icons['Input Arsip']],
                    ['label' => 'Report', 'href' => $roleReport, 'icon' => $icons['Report']],
                    // ['label' => 'Pengajuan', 'href' => route('bendahara.pengajuan'), 'icon' => $icons['Pengajuan']],
                    // ['label' => 'Digital Arsip', 'href' => $roleDigitalArsip, 'icon' => $icons['Digital Arsip']],
                    // ['label' => 'Input Arsip', 'href' => $roleInputArsip, 'icon' => $icons['Input Arsip']],
                    // [
                    //     'label' => 'Notifikasi',
                    //     'href' => $notificationRoute,
                    //     'icon' => $icons['Notifikasi'],
                    //     'badge' => $unreadCount,
                    // ],
                ];
            } else {
                if ($privileged) {
                    $menuItems = [
                        ['label' => 'Dashboard', 'href' => $roleDashboard, 'icon' => $icons['Dashboard']],
                        ['label' => 'Pengajuan', 'href' => $pengajuan, 'icon' => $icons['Pengajuan']],
                        ['label' => 'Monitoring', 'href' => $worklist, 'icon' => $icons['Monitoring']],
                        ['label' => 'Arsip', 'href' => $roleInputArsip, 'icon' => $icons['Input Arsip']],
                        [
                            'label' => 'Notifikasi',
                            'href' => $notificationRoute,
                            'icon' => $icons['Notifikasi'],
                            'badge' => $unreadCount,
                        ],
                        ['label' => 'Report', 'href' => $roleReport, 'icon' => $icons['Report']],
                    ];
                } else {
                    $menuItems = [
                        ['label' => 'Dashboard', 'href' => $roleDashboard, 'icon' => $icons['Dashboard']],
                        ['label' => 'Pengajuan', 'href' => $pengajuan, 'icon' => $icons['Pengajuan']],
                        ['label' => 'Monitoring', 'href' => $worklist, 'icon' => $icons['Monitoring']],
                        [
                            'label' => 'Notifikasi',
                            'href' => $notificationRoute,
                            'icon' => $icons['Notifikasi'],
                            'badge' => $unreadCount,
                        ],
                        ['label' => 'Report', 'href' => $roleReport, 'icon' => $icons['Report']],
                    ];
                }
            }
        @endphp

        <div class="mb-4 px-3">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Menu Utama</p>
        </div>

        @foreach ($menuItems as $item)
            @php
                $isActive = request()->url() == $item['href'] && $item['href'] != '#';
                $isDisabled = $item['href'] == '#';
            @endphp

            <a href="{{ $item['href'] }}" @if ($isDisabled) onclick="return false;" @endif
                class="group flex items-center px-4 py-3 rounded-xl transition-all duration-300
                      {{ $isActive ? 'bg-gradient-to-r from-[#0050C8]/25 to-[#1890FF]/25 shadow-lg' : '' }}
                      {{ $isDisabled ? 'opacity-50 cursor-not-allowed' : '' }}">

                <div class="relative mr-3">
                    <svg class="w-5 h-5 {{ $isActive ? 'border-[#1890FF]' : 'text-gray-400 group-hover:text-gray-300' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}">
                        </path>
                    </svg>

                    @if ($isActive)
                        <div class="absolute -inset-1 bg-blue-500/10 rounded-full blur-sm"></div>
                    @endif
                </div>

                <span class="font-medium text-sm">{{ $item['label'] }}</span>

                @if (isset($item['badge']) && $item['badge'] > 0)
                    <span
                        class="ml-auto bg-red-600 text-white text-xs font-bold
                            rounded-full px-2 py-0.5 shadow-md">
                        {{ $item['badge'] }}
                    </span>
                @endif

                @if ($isActive)
                    <div class="ml-auto">
                        <div class="w-2 h-2 rounded-full bg-white animate-pulse"></div>
                    </div>
                @endif

                @if ($isDisabled)
                    <div class="ml-auto">
                        <span class="text-xs px-2 py-1 rounded bg-gray-700/50 text-gray-400">Soon</span>
                    </div>
                @endif
            </a>
        @endforeach
    </nav>

    {{-- ACCOUNT MENU --}}
    <div class="px-4 relative z-10">
        <div class="mb-2 px-3">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Account</p>
        </div>

        @php
            $accountMenus = [['label' => 'Profile', 'href' => route('profile.edit'), 'icon' => $icons['Profile']]];
        @endphp

        @foreach ($accountMenus as $item)
            @php
                $isActive = request()->url() == $item['href'];
            @endphp

            <a href="{{ $item['href'] }}"
                class="group flex items-center px-4 py-3 rounded-xl transition-all duration-300
            {{ $isActive ? 'bg-gradient-to-r from-[#0050C8]/25 to-[#1890FF]/25 shadow-lg' : '' }}">

                <div class="relative mr-3">
                    <svg class="w-5 h-5 {{ $isActive ? 'border-[#1890FF]' : 'text-gray-400 group-hover:text-gray-300' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}">
                        </path>
                    </svg>

                    @if ($isActive)
                        <div class="absolute -inset-1 bg-blue-500/10 rounded-full blur-sm"></div>
                    @endif
                </div>

                <span class="font-medium text-sm">{{ $item['label'] }}</span>

                @if ($isActive)
                    <div class="ml-auto">
                        <div class="w-2 h-2 rounded-full bg-white animate-pulse"></div>
                    </div>
                @endif
            </a>
        @endforeach

        {{-- LOGOUT --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full group flex items-center px-4 py-3 rounded-xl transition-all duration-300
                    hover:bg-red-600/20">
                <div class="relative mr-3">
                    <svg class="w-5 h-5 text-red-400 group-hover:text-red-300" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="{{ $icons['Logout'] }}"></path>
                    </svg>
                </div>
                <span class="font-medium text-sm text-red-400">
                    Logout
                </span>
            </button>
        </form>
    </div>

    {{-- USER PROFILE CARD --}}
    <div class="p-4 border-b border-gray-700/50 relative z-10">
        <div class="flex items-center space-x-3 p-3 transition-all duration-300">
            <div class="relative">
                <div
                    class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center text-white font-bold text-lg">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="absolute bottom-0 right-0 w-3 h-3 rounded-full bg-green-500 border-2 border-gray-800"></div>
            </div>
            <div class="flex-1 min-w-0">
                <p class="font-semibold text-sm truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-400 truncate">{{ Auth::user()->email }}</p>
            </div>
        </div>
    </div>
</aside>

<style>
    /* Smooth scrolling for the sidebar */
    nav::-webkit-scrollbar {
        width: 4px;
    }

    nav::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 10px;
    }

    nav::-webkit-scrollbar-thumb {
        background: rgba(59, 130, 246, 0.5);
        border-radius: 10px;
    }

    nav::-webkit-scrollbar-thumb:hover {
        background: rgba(59, 130, 246, 0.8);
    }

    /* Animation for active menu item */
    @keyframes pulse-glow {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.7;
        }
    }

    .animate-pulse {
        animation: pulse-glow 2s infinite;
    }

    /* Hover effect for menu items */
    .group:hover .group-hover\:scale-105 {
        transform: scale(1.05);
    }
</style>

<script>
    // Add subtle interaction effects
    document.addEventListener('DOMContentLoaded', function() {
        const menuItems = document.querySelectorAll('aside a:not([onclick*="return false"])');

        menuItems.forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.style.transform = 'translateX(5px)';
            });

            item.addEventListener('mouseleave', function() {
                this.style.transform = 'translateX(0)';
            });
        });

        // Add active state indicator animation
        const activeIndicator = document.querySelector('.bg-gradient-to-r.from-blue-600\\/20');
        if (activeIndicator) {
            setInterval(() => {
                activeIndicator.classList.toggle('from-blue-600/20');
                activeIndicator.classList.toggle('from-blue-600/30');
            }, 3000);
        }
    });
</script>
