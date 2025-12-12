<!DOCTYPE html>
<html>
<head>
    <title>{{ ucfirst($role) }} Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen bg-cover bg-center" style="background-image: url('/images/image.png');">
    @include('partials.header')

    <a href="/" class="mt-4 ml-6 bg-yellow-400 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 shadow w-fit">
        &larr; 
    </a>

    <div class="flex-1 flex items-center justify-center px-4">
        <div class="relative rounded-3xl p-8 shadow-lg w-full max-w-sm bg-white">
            <!-- Role badge on top -->
            <div class="absolute -top-6 left-1/2 transform -translate-x-1/2 bg-yellow-400 text-green-700 font-bold px-8 py-3 rounded-full text-lg">
                {{ ucfirst($role) }}
            </div>

            <!-- Form content with top padding for badge -->
            <div class="pt-8">
                @if($errors->any())
                    <div class="mb-4 text-sm text-red-700 bg-red-100 p-3 rounded-lg">
                        <ul class="list-disc pl-4">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register', ['role' => $role]) }}">
                    @csrf
                    <input type="hidden" name="role" value="{{ $role }}">
                    <input name="name" type="text" placeholder="Full name" class="w-full mb-4 px-6 py-3 bg-gray-200 rounded-lg placeholder-gray-400 focus:outline-none" required>
                    <input name="email" type="email" placeholder="Email" class="w-full mb-4 px-6 py-3 bg-gray-200 rounded-lg placeholder-gray-400 focus:outline-none" required>
                    <input name="password" type="password" placeholder="Password" class="w-full mb-4 px-6 py-3 bg-gray-200 rounded-lg placeholder-gray-400 focus:outline-none" required>
                    <input name="password_confirmation" type="password" placeholder="Confirm password" class="w-full mb-6 px-6 py-3 bg-gray-200 rounded-lg placeholder-gray-400 focus:outline-none" required>
                    
                    <button type="submit" class="bg-green-700 text-white w-40 mx-auto block py-3 rounded-full font-bold hover:bg-green-800 transition">
                        CREATE ACCOUNT
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>