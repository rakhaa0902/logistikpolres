<x-guest-layout>
    <style>
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .animate-gradient {
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
        }
        .login-container {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.8s ease forwards;
        }
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .input-field {
            transition: all 0.3s ease;
        }
        .input-field:focus {
            transform: translateX(5px);
            box-shadow: 0 0 15px rgba(79, 70, 229, 0.3);
        }
        .login-btn {
            transition: all 0.3s ease;
        }
        .login-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
    </style>

    <div class="min-h-screen flex items-center justify-center p-4 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 animate-gradient">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-1/4 left-1/4 w-72 h-72 bg-yellow-400 rounded-full mix-blend-multiply filter blur-xl opacity-5 animate-blob"></div>
            <div class="absolute top-1/3 right-1/4 w-80 h-80 bg-yellow-500 rounded-full mix-blend-multiply filter blur-xl opacity-5 animate-blob animation-delay-2000"></div>
            <div class="absolute bottom-1/4 left-1/3 w-96 h-96 bg-yellow-400 rounded-full mix-blend-multiply filter blur-xl opacity-5 animate-blob animation-delay-4000"></div>
        </div>

        <!-- Login Form -->
        <div class="login-container w-full max-w-md bg-gray-800/80 backdrop-blur-md rounded-2xl shadow-2xl overflow-hidden border border-gray-700/50">
            <div class="px-8 py-10">
                <!-- Logo -->
                <div class="text-center mb-8">
                    <div class="flex flex-col items-center mb-6">
                        <!-- Logo Container -->
                        <div class="relative group">
                            <!-- Glow Effect -->
                            <div class="absolute -inset-1 bg-gradient-to-br from-yellow-500 to-yellow-700 rounded-full blur opacity-30 group-hover:opacity-50 transition-all duration-500"></div>
                            
                            <!-- Outer Gold Ring -->
                            <div class="relative w-36 h-36 rounded-full p-1.5 bg-gradient-to-br from-yellow-500 to-yellow-700 shadow-lg">
                                <!-- Inner White Circle -->
                                <div class="w-full h-full rounded-full bg-white p-1">
                                    <!-- Logo Container -->
                                    <div class="w-full h-full rounded-full overflow-hidden border-2 border-yellow-500 flex items-center justify-center bg-white p-1">
                                        <img src="{{ asset('images/polri-logo.jpg') }}" 
                                             alt="Logo POLRI" 
                                             class="w-5/6 h-5/6 object-contain transform group-hover:scale-110 transition-transform duration-500 ease-in-out">
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Animated Border -->
                            <div class="absolute -inset-1 rounded-full border-2 border-yellow-400 opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                        </div>
                        
                        <!-- Text Below Logo -->
                        <div class="mt-4 text-center">
                            <div class="text-yellow-400 font-bold text-sm tracking-wider">KEPOLISIAN NEGARA</div>
                            <div class="text-yellow-500 font-bold text-lg tracking-tight">REPUBLIK INDONESIA</div>
                            <div class="text-gray-300 text-xs mt-1">POLRES GARUT</div>
                        </div>
                    </div>
                    <h2 class="text-3xl font-bold text-yellow-400">SELAMAT DATANG</h2>
                    <p class="text-gray-300 mt-2">Masuk ke akun Anda</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    <div class="text-center mb-2">
                        <p class="text-yellow-400 text-sm font-semibold">SISTEM INFORMASI LOGISTIK</p>
                        <p class="text-gray-300 text-xs">KEPOLISIAN NEGARA REPUBLIK INDONESIA</p>
                    </div>

                    <!-- Email -->
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-medium text-yellow-400">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <input id="email" name="email" type="email" required 
                                   class="input-field block w-full pl-10 pr-3 py-3 bg-gray-700/80 border border-yellow-500/30 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent text-white placeholder-gray-400" 
                                   placeholder="email@contoh.com" 
                                   value="{{ old('email') }}" 
                                   autofocus>
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <!-- Password -->
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <label for="password" class="block text-sm font-medium text-yellow-400">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-sm text-yellow-400 hover:text-yellow-300 transition-colors font-medium">
                                    Lupa password?
                                </a>
                            @endif
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input id="password" name="password" type="password" required 
                                   class="input-field block w-full pl-10 pr-3 py-3 bg-gray-700/80 border border-yellow-500/30 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent text-white placeholder-gray-400" 
                                   placeholder="••••••••">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox" 
                               class="h-4 w-4 text-yellow-500 focus:ring-yellow-500 border-yellow-500/50 rounded bg-gray-700">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-300">
                            Ingat saya
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" 
                                class="login-btn w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-gray-900 bg-gradient-to-r from-yellow-400 to-yellow-500 hover:from-yellow-500 hover:to-yellow-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transform hover:-translate-y-0.5 transition-all duration-200">
                            <svg class="w-5 h-5 mr-2 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            MASUK
                        </button>
                    </div>
                </form>

                <!-- Footer -->
                <div class="mt-6 text-center text-sm text-gray-400">
                    <p>© {{ date('Y') }} POLRI - POLRES LOGISTIK 
                        <span class="block text-xs mt-1 text-yellow-500/70">v1.0.0</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Animate.css for additional animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    
    <script>
        // Add animation delay for form elements
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.input-field');
            inputs.forEach((input, index) => {
                input.style.animationDelay = `${index * 100}ms`;
            });
        });
    </script>
</x-guest-layout>
