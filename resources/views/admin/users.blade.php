<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manage Users - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    
    {{-- Header --}}
    @php $align = $align ?? 'center'; @endphp
    <div class="w-full bg-white shadow">
        <div class="max-w-6xl mx-auto px-6 py-4 flex items-center {{ $align === 'left' ? 'justify-start' : 'justify-center' }}">
            <img src="{{ asset('images/header.png') }}" alt="Header image" class="h-16 object-contain">
        </div>
    </div>

    {{-- Navigation Bar --}}
    <nav class="bg-[#145c2f] text-white py-3">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            <div class="flex items-center gap-6">
                <a href="{{ route('admin.dashboard') }}" class="font-bold hover:text-gray-200">Admin Dashboard</a>
                <a href="{{ route('admin.users') }}" class="hover:text-gray-200 underline">Users</a>
                <a href="{{ route('admin.alumni') }}" class="hover:text-gray-200">Alumni</a>
                <a href="{{ route('admin.posts') }}" class="hover:text-gray-200">Posts</a>
            </div>
            <div class="flex items-center gap-4">
                <span class="font-bold">{{ Auth::user()->name }}</span>
                <a href="{{ route('dashboard') }}" class="hover:text-gray-200">Regular Dashboard</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="hover:text-gray-200">Log Out</button>
                </form>
            </div>
        </div>
    </nav>

    {{-- Success/Error Messages --}}
    @if(session('success'))
    <div class="max-w-7xl mx-auto px-6 mt-4">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="max-w-7xl mx-auto px-6 mt-4">
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    </div>
    @endif

    {{-- Main Content --}}
    <div class="max-w-7xl mx-auto px-6 py-8">
        
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Manage Users</h1>
            <p class="text-gray-600">View, edit, and delete user accounts</p>
        </div>

        {{-- Users Table --}}
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Joined</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ $user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <form method="POST" action="{{ route('admin.updateRole', $user->id) }}" class="inline">
                                    @csrf
                                    <select name="role" onchange="this.form.submit()" class="text-xs border rounded px-2 py-1
                                        {{ $user->role === 'admin' ? 'bg-red-100 text-red-800 border-red-300' : '' }}
                                        {{ $user->role === 'student' ? 'bg-blue-100 text-blue-800 border-blue-300' : '' }}
                                        {{ $user->role === 'alumni' ? 'bg-green-100 text-green-800 border-green-300' : '' }}
                                        {{ $user->role === 'employee' ? 'bg-orange-100 text-orange-800 border-orange-300' : '' }}">
                                        <option value="student" {{ $user->role === 'student' ? 'selected' : '' }}>Student</option>
                                        <option value="alumni" {{ $user->role === 'alumni' ? 'selected' : '' }}>Alumni</option>
                                        <option value="employee" {{ $user->role === 'employee' ? 'selected' : '' }}>Employee</option>
                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                    </select>
                                </form>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $user->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                @if($user->id !== Auth::id())
                                <form method="POST" action="{{ route('admin.deleteUser', $user->id) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                </form>
                                @else
                                <span class="text-gray-400">Current User</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No users found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $users->links() }}
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



