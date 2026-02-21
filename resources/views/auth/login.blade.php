<x-guest-layout>
    <div class="mb-8 text-center stagger-child">
        <h2 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-slate-400">Welcome Back</h2>
        <p class="text-slate-500 mt-2 text-sm">Please enter your details to sign in</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6 stagger-child">
        @csrf

        <!-- Email Address -->
        <div class="space-y-2">
            <x-input-label for="email" :value="__('Email Address')" />
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500 group-focus-within:text-cyan-400 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"></path></svg>
                </div>
                <x-text-input id="email" class="block w-full pl-11" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="name@example.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <div class="flex items-center justify-between">
                <x-input-label for="password" :value="__('Password')" />
                @if (Route::has('password.request'))
                    <a class="text-xs text-slate-500 hover:text-cyan-400 transition-colors" href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500 group-focus-within:text-cyan-400 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <x-text-input id="password" class="block w-full pl-11"
                                type="password"
                                name="password"
                                required autocomplete="current-password"
                                placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded bg-white/10 border-white/20 text-cyan-500 shadow-sm focus:ring-cyan-500/50" name="remember">
                <span class="ml-2 text-sm text-slate-400 group-hover:text-slate-200 transition-colors">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full py-4 text-sm tracking-widest">
                {{ __('Sign In to Dashboard') }}
            </x-primary-button>
        </div>

        <div class="text-center pt-4 border-t border-white/5">
            <p class="text-sm text-slate-500">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-cyan-400 font-bold hover:text-cyan-300 transition-colors ml-1">Create Account</a>
            </p>
        </div>
    </form>
</x-guest-layout>
