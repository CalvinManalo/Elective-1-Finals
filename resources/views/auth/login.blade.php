<x-full-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Make this page follow the welcome page's centered card and spacing -->
    <div class="flex flex-col min-h-screen bg-cover bg-center" style="background-image: url('/images/image.png');">
        @include('partials.header')

        <a href="/" class="mt-4 ml-6 bg-yellow-400 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 shadow w-fit">&larr;</a>

        <div class="flex-1 flex items-center justify-center px-4">
            <div class="rounded-lg p-6 sm:p-8 text-center shadow-lg w-full max-w-lg">
                <h1 class="text-white text-7xl font-bold mb-8">Welcome!</h1>

                <div class="relative">
                    <!-- floating role pill -->
                    <!-- role label removed (display suppressed as requested) -->

                    <div class="mt-8 bg-white rounded-3xl shadow-2xl w-full p-6 sm:p-8">
                        <div class="pt-4">
                            <form method="POST" action="{{ route('login', ['role' => $role]) }}" class="space-y-4">
                        @csrf
                        <input type="hidden" name="role" value="{{ $role }}">

                        <input name="email" type="email" placeholder="Email address" value="{{ old('email') }}" class="w-full px-6 py-3 bg-gray-200 rounded-lg placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-600" required autofocus>

                        @error('email')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror

                        <input name="password" type="password" placeholder="Password" class="w-full px-6 py-3 bg-gray-200 rounded-lg placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-600" required>

                        <button type="submit" class="relative z-50 w-full sm:w-40 mx-auto block py-3 sm:py-4 rounded-full font-bold hover:bg-green-900 transition shadow-2xl text-lg border-2 border-green-700 mt-4" style="background-color:#065f46;color:#facc15;">LOG IN</button>
                    </form>

                    <div class="text-sm mt-4 text-center">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline">Forgot Password?</a>
                                @endif
                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-full-guest-layout>
