<!DOCTYPE html>
<html>
<head>
    <title>FEU Cavite Alumni Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen bg-cover bg-center" style="background-image: url('/images/image.png');">
    @include('partials.header')

    <div class="flex-1 flex items-center justify-center px-4">
        <div class="rounded-lg p-8 text-center shadow-lg w-full max-w-lg">
            <h1 class="text-white text-7xl font-bold mb-8">Welcome!</h1>

            <div class="flex flex-col space-y-4 items-center">
                <a href="{{ url('/switch-login/student') }}" class="bg-yellow-400 text-green-700 px-8 py-4 rounded-full w-full max-w-xs font-bold hover:bg-yellow-500 transition text-center text-lg">Student</a>
                <a href="{{ url('/switch-login/alumni') }}" class="bg-yellow-400 text-green-700 px-8 py-4 rounded-full w-full max-w-xs font-bold hover:bg-yellow-500 transition text-center text-lg">Alumni</a>
                <a href="{{ url('/switch-login/employee') }}" class="bg-yellow-400 text-green-700 px-8 py-4 rounded-full w-full max-w-xs font-bold hover:bg-yellow-500 transition text-center text-lg">Employee</a>
                <a href="{{ url('/switch-login/admin') }}" class="bg-yellow-400 text-green-700 px-8 py-4 rounded-full w-full max-w-xs font-bold hover:bg-yellow-500 transition text-center text-lg">Admin</a>
            </div>

            <!-- Create account button -->
            <div class="mt-8">
                <a href="/register-selection" 
                    class="inline-block bg-green-700 border-2 border-yellow-500 text-white px-8 py-3 rounded-full font-bold hover:bg-green-800 hover:text-white transition">
                    Create an Account
                </a>
            </div>
        </div>
    </div>
</body>
</html>