<x-guest-layout>
    <!-- Logo -->
    <div class="flex justify-center mb-6">
        <img src="{{ asset('assets/img/logo1.png') }}" alt="Website Logo" class="w-50 h-auto">
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-center" :status="session('status')" />

    <div class="w-full max-w-4xl rounded-xl shadow-sm border border-gray-200 p-8 bg-white">
        <h2 class="text-2xl font-bold text-center mb-2">Welcome Back</h2>
        <p class="text-center text-gray-600 mb-6">Sign in to continue</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email Address')" class="font-semibold" />
                <x-text-input 
                    id="email" 
                    class="block mt-1 w-full"
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    required 
                    autofocus 
                    autocomplete="username" 
                    placeholder="azerty@aze.rty"
                    style="border-color: #FF9800;"
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" class="font-semibold" />
                <x-text-input 
                    id="password" 
                    class="block mt-1 w-full"
                    type="password"
                    name="password"
                    required 
                    autocomplete="current-password"
                    placeholder="password"
                    style="border-color: #FF9800;"
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between mt-8">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                    {{ __('Do not have an account?') }}
                </a>

                <div class="flex items-center space-x-3">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                    <x-primary-button style="background-color: #FF9800; border:none;">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>
