
@php($title = __('Register'))
<x-layouts.auth :title="$title">
    <div class="mb-6 text-center">
        <h1 class="text-3xl font-bold text-blue-700 mb-2">{{ __('Create an account') }}</h1>
        <p class="text-gray-500">{{ __('Enter your details below to create your account') }}</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="text-center mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('register.store') }}" class="space-y-5">
        @csrf
        <div>
            <label for="name" class="block text-base font-semibold text-gray-700 mb-2">{{ __('Name') }}</label>
            <input id="name" name="name" type="text" required autofocus autocomplete="name" placeholder="{{ __('Full name') }}" class="mt-2 block w-full px-4 py-3 text-lg rounded-xl border-2 border-gray-300 shadow focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition" />
        </div>
        <div>
            <label for="email" class="block text-base font-semibold text-gray-700 mb-2">{{ __('Email address') }}</label>
            <input id="email" name="email" type="email" required autocomplete="email" placeholder="email@example.com" class="mt-2 block w-full px-4 py-3 text-lg rounded-xl border-2 border-gray-300 shadow focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition" />
        </div>
        <div>
            <label for="password" class="block text-base font-semibold text-gray-700 mb-2">{{ __('Password') }}</label>
            <input id="password" name="password" type="password" required autocomplete="new-password" placeholder="••••••••" class="mt-2 block w-full px-4 py-3 text-lg rounded-xl border-2 border-gray-300 shadow focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition" />
        </div>
        <div>
            <label for="password_confirmation" class="block text-base font-semibold text-gray-700 mb-2">{{ __('Confirm password') }}</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password" placeholder="••••••••" class="mt-2 block w-full px-4 py-3 text-lg rounded-xl border-2 border-gray-300 shadow focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition" />
        </div>
        <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 transition">{{ __('Create account') }}</button>
    </form>

    <div class="mt-6 text-center text-sm text-gray-600">
        <span>{{ __('Already have an account?') }}</span>
        <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-semibold">{{ __('Log in') }}</a>
    </div>
</x-layouts.auth>
