<x-guest-layout>
    <div class="w-full max-w-2xl rounded-xl shadow-sm border border-black-100 p-8">
        <div class="mb-6 text-gray-700">
            <h2 class="text-2xl font-bold mb-2">Reset Your Password </h2>
            <p class="text-base"  style="color: #ff9800;">
                Enter your email and new password below to reset your account password.
            </p>
        </div>

        <form method="POST" action="{{ route('password.store') }}" class="mt-6">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input
                    id="email"
                    class="block mt-1 w-full border-gray-300 focus:border-[#ff9800] focus:ring focus:ring-[#ff9800]/50 rounded-md shadow-sm"
                    type="email"
                    name="email"
                    :value="old('email', $request->email)"
                    required
                    autofocus
                    autocomplete="username"
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input
                    id="password"
                    class="block mt-1 w-full border-gray-300 focus:border-[#ff9800] focus:ring focus:ring-[#ff9800]/50 rounded-md shadow-sm"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input
                    id="password_confirmation"
                    class="block mt-1 w-full border-gray-300 focus:border-[#ff9800] focus:ring focus:ring-[#ff9800]/50 rounded-md shadow-sm"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600" />
            </div>

            <div class="flex items-center justify-end mt-6">
                <x-primary-button style="background-color:#ff9800; color:#ffffff; padding:12px 24px; border-radius:30px; font-weight:bold;">
                    {{ __('Reset Password') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>