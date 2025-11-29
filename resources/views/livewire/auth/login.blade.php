
@php($title = __('Log in'))
<x-layouts.auth :title="$title">
    <div class="mb-6 text-center">
        <h1 class="text-3xl font-bold text-blue-700 mb-2">{{ __('Log in to your account') }}</h1>
        <p class="text-gray-500">{{ __('Enter your email and password below to log in') }}</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="text-center mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login.store') }}" class="space-y-5">
        @csrf
        <div>
            <label for="email" class="block text-base font-semibold text-gray-700 mb-2">{{ __('Email address') }}</label>
            <input id="email" name="email" type="email" required autofocus autocomplete="email" placeholder="email@example.com" class="mt-2 block w-full px-4 py-3 text-lg rounded-xl border-2 border-gray-300 shadow focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition" />
        </div>
        <div class="relative">
            <label for="password" class="block text-base font-semibold text-gray-700 mb-2">{{ __('Password') }}</label>
            <input id="password" name="password" type="password" required autocomplete="current-password" placeholder="••••••••" class="mt-2 block w-full px-4 py-3 text-lg rounded-xl border-2 border-gray-300 shadow focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition" />
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="absolute top-0 right-0 text-xs text-blue-600 hover:underline">{{ __('Forgot your password?') }}</a>
            @endif
        </div>
        <div class="flex items-center">
            <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-blue-600 border-gray-300 rounded" {{ old('remember') ? 'checked' : '' }}>
            <label for="remember" class="ml-2 block text-sm text-gray-700">{{ __('Remember me') }}</label>
        </div>
        <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 transition">{{ __('Log in') }}</button>
    </form>

    @if (Route::has('register'))
        <div class="mt-6 text-center text-sm text-gray-600">
            <span>{{ __('Don\'t have an account?') }}</span>
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline font-semibold">{{ __('Sign up') }}</a>
        </div>
    @endif
</x-layouts.auth>
