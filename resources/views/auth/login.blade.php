<x-guest-layout>
        <div class="flex flex-col items-center justify-center mb-6">
            <div class="w-full max-w-lg bg-white/90 backdrop-blur-md rounded-xl shadow-xl p-8">
                <!-- Logo -->
                <div class="flex flex-col items-center mb-6">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/tvri.png') }}" class="h-12" alt="TVRI">
                        <span class="text-2xl font-extrabold bg-gradient-to-b from-[#001f65] to-[#6895fd] 
                                    bg-clip-text text-transparent tracking-wide">
                            VVeP App
                        </span>

                    </div>
                    <h2 class="text-sm text-gray-700 mt-3 text-center">Selamat Datang Silahkan Login</h2>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="email" :value="__('Email Address')" class="text-gray-800 font-semibold" />
                        <div class="mt-2 relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <x-text-input id="email" 
                                class="block w-full pl-10 pr-3 bg-white/50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200" 
                                type="email" 
                                name="email" 
                                :value="old('email')" 
                                required 
                                autofocus 
                                autocomplete="username"
                                placeholder="Enter your email" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div x-data="{ show: false }">
                        <x-input-label for="password" :value="__('Password')" class="text-gray-800 font-semibold" />
                        <div class="relative mt-2">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                    
                            <x-text-input id="password" 
                                class="block w-full pl-10 pr-12 bg-white/50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200"
                                ::type="show ? 'text' : 'password'" 
                                name="password"
                                required 
                                autocomplete="current-password"
                                placeholder="Enter your password"/>
                    
                            <button type="button"
                                @click="show = !show" 
                                class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-indigo-600 transition-colors focus:outline-none">
                                
                                <svg x-show="!show" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                    
                                <svg x-show="show" x-cloak class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer">
                            <input id="remember_me" 
                                type="checkbox" 
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 cursor-pointer" 
                                name="remember">
                            <span class="ml-2 text-sm text-gray-700">{{ __('Remember me') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm font-medium text-indigo-600 hover:text-indigo-500 transition" 
                               href="{{ route('password.request') }}">
                                {{ __('Forgot password?') }}
                            </a>
                        @endif
                    </div>

                    <div>
                        <x-primary-button class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-lg text-sm font-bold text-white bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 transition duration-200 transform hover:scale-[1.02] active:scale-95">
                            {{ __('Login') }}
                        </x-primary-button>
                    </div>
                </form>

                {{-- <div class="mt-6 text-center">
                    <p class="text-sm text-gray-700 font-medium">
                        Don't have an account yet? 
                        <a href="{{ route('register') }}" class="font-bold text-indigo-700 hover:text-indigo-500 transition underline">
                            Register
                        </a>
                    </p>
                </div> --}}
            </div>
        </div>
    </div>
</x-guest-layout>