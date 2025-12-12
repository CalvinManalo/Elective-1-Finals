<!DOCTYPE html>
<html>
<head>
    <title>{{ ucfirst($role) }} Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Ensure the page takes full viewport and has no unexpected outer margin */
        html, body { height: 100%; margin: 0; padding: 0; }
    </style>
</head>
<body class="min-h-screen w-screen bg-cover bg-center" style="background-image: url('/images/image.png');">
    {{-- thin green top strip like screenshot --}}
    <div class="w-full bg-green-900 h-6 fixed top-0 left-0 z-40"></div>

    {{-- white header with logo (same partial) --}}
    <div class="relative z-40">
        @include('partials.header')
    </div>

    {{-- back button (fixed so it sits above content on small screens) --}}
    <a href="/" class="fixed left-6 top-24 z-50 bg-yellow-400 w-12 h-12 rounded-full flex items-center justify-center shadow-lg text-green-900 text-2xl">&larr;</a>

    {{-- full-width main wrapper so page uses whole screen --}}
    <main class="min-h-screen w-screen flex items-start justify-center pt-20 sm:pt-32 pb-12">
        <div class="w-full max-w-screen-lg px-6">
            <div class="rounded-lg p-8 text-center shadow-lg w-full">
                <h1 class="text-white text-7xl font-bold mb-8">Welcome!</h1>

                <div class="relative mx-auto" style="max-width:560px;">
                    <div class="absolute -top-10 left-1/2 transform -translate-x-1/2 z-30">
                        <!-- exact circular badge: use fixed size so it is a circle, center the text and use white text -->
                            <!-- role label removed (display suppressed as requested) -->
                    </div>

                    <div class="mt-8 bg-white rounded-3xl shadow-2xl w-full p-6 sm:p-8">
                        <form method="POST" action="{{ route('login', ['role' => $role]) }}" class="max-w-lg mx-auto space-y-4">
                            @csrf
                            <input type="hidden" name="role" value="{{ $role }}">

                            {{-- Display Login Errors --}}
                            @if ($errors->any())
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                    <span class="block sm:inline">{{ $errors->first() }}</span>
                                </div>
                            @endif

                            <input name="email" type="email" placeholder="Email address" class="w-full px-6 py-4 bg-gray-200 rounded-lg placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-600" value="{{ old('email') }}" required>

                            <input name="password" type="password" placeholder="Password" class="w-full px-6 py-4 bg-gray-200 rounded-lg placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-600" required>

                            <div class="flex justify-center">
                                <button type="submit" class="relative z-50 w-full sm:w-auto px-8 py-4 rounded-full font-extrabold text-lg hover:bg-green-950 transition shadow-2xl border-2 border-green-800 mt-4" style="background-color:#065f46;color:#ffffff;">LOG IN</button>
                            </div>

                            <div class="text-center mt-4">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline">Forgot Password?</a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>