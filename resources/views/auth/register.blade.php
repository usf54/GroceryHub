<x-guest-layout>
    <!-- Logo -->
    <div class="flex justify-center mb-6">
        <img src="{{ asset('assets/img/logo1.png') }}" alt="Website Logo" class="w-50 h-auto">
    </div>

    <div class="w-full max-w-4xl rounded-xl shadow-sm border border-gray-200 bg-white p-8">
        <h2 class="text-2xl font-bold text-center mb-2">Create an Account</h2>
        <p class="text-center text-gray-600 mb-6">Join us today!</p>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4 text-center" :status="session('status')" />

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
            <!-- Grid Layout -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Full Name -->
                <div>
                    <x-input-label for="name" :value="__('Full Name')" class="font-semibold" />
                    <x-text-input 
                        id="name" 
                        class="block mt-1 w-full border border-orange-400 rounded-md px-4 py-2" 
                        type="text" 
                        name="name" 
                        :value="old('name')" 
                        placeholder="John Doe"
                        required 
                        autofocus 
                        autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Address -->
                <div>
                    <x-input-label for="address" :value="__('Address')" class="font-semibold" />
                    <x-text-input 
                        id="address" 
                        class="block mt-1 w-full border border-orange-400 rounded-md px-4 py-2" 
                        type="text" 
                        name="address" 
                        :value="old('address')" 
                        placeholder="123 Main Street"
                        required 
                        autocomplete="address" />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>

                <!-- Phone -->
                <div>
                    <x-input-label for="phone" :value="__('Phone Number')" class="font-semibold" />
                    <x-text-input 
                        id="phone" 
                        class="block mt-1 w-full border border-orange-400 rounded-md px-4 py-2" 
                        type="text" 
                        name="phone" 
                        :value="old('phone')" 
                        placeholder="+212 600 000 000"
                        required 
                        autocomplete="tel" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email Address')" class="font-semibold" />
                    <x-text-input 
                        id="email" 
                        class="block mt-1 w-full border border-orange-400 rounded-md px-4 py-2" 
                        type="email" 
                        name="email" 
                        :value="old('email')" 
                        placeholder="example@gmail.com"
                        required 
                        autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="font-semibold" />
                    <x-text-input 
                        id="password" 
                        class="block mt-1 w-full border border-orange-400 rounded-md px-4 py-2" 
                        type="password" 
                        name="password" 
                        placeholder="At least 8 characters"
                        required 
                        autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="font-semibold" />
                    <x-text-input 
                        id="password_confirmation" 
                        class="block mt-1 w-full border border-orange-400 rounded-md px-4 py-2" 
                        type="password" 
                        name="password_confirmation" 
                        placeholder="Repeat your password"
                        required 
                        autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>

            <!-- Submit -->
            <div class="flex items-center justify-between mt-8">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
                <x-primary-button class="ms-4" style="background-color: #FF9800;">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
