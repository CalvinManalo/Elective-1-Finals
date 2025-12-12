<!DOCTYPE html>
<html>
<head>
    <title>Create Account - Choose role</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen bg-cover bg-center" style="background-image: url('/images/image.png');">
    @include('partials.header')

   <a href="/" class="mt-4 ml-6 bg-yellow-400 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 shadow w-fit">
        &larr; 
    </a>
    
    <div class="flex-1 flex items-center justify-center px-4">
        <div class="rounded-2xl p-8 text-center shadow-lg w-full max-w-sm bg-white">
            <h1 class="text-2xl font-bold mb-4 text-green-700">Create an account</h1>
            <p class="mb-6 text-gray-700">Choose your role</p>

            <div class="flex flex-col space-y-3 items-stretch">
                <a href="{{ url('/switch-register/student') }}" class="bg-yellow-400 text-white px-4 py-2 rounded-full hover:bg-yellow-500 transition text-center">Student</a>
                <a href="{{ url('/switch-register/alumni') }}" class="bg-yellow-400 text-white px-4 py-2 rounded-full hover:bg-yellow-500 transition text-center">Alumni</a>
                <a href="{{ url('/switch-register/employee') }}" class="bg-yellow-400 text-white px-4 py-2 rounded-full hover:bg-yellow-500 transition text-center">Employee</a>
            </div>
        </div>
    </div>
</body>
</html>