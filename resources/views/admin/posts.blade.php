<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manage Posts - Admin Dashboard</title>
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
                <a href="{{ route('admin.users') }}" class="hover:text-gray-200">Users</a>
                <a href="{{ route('admin.alumni') }}" class="hover:text-gray-200">Alumni</a>
                <a href="{{ route('admin.posts') }}" class="hover:text-gray-200 underline">Posts</a>
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

    {{-- Main Content --}}
    <div class="max-w-7xl mx-auto px-6 py-8">
        
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Manage Posts</h1>
            <p class="text-gray-600">Monitor and remove forum posts</p>
        </div>

        {{-- Posts Table --}}
        <div class="bg-white rounded-lg shadow-md p-6">
            @if($posts->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Content</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Posted</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($posts as $post)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-8 w-8 bg-gray-200 rounded-full flex items-center justify-center">
                                            <span class="text-xs font-medium text-gray-600">{{ substr($post->user->name, 0, 1) }}</span>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900">{{ $post->user->name }}</div>
                                            <div class="text-xs text-gray-500">{{ ucfirst($post->user->role) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="text-sm text-gray-900 max-w-md">{{ Str::limit($post->content, 100) }}</div>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-xs text-gray-500">
                                    {{ $post->created_at->diffForHumans() }}
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm">
                                    <form method="POST" action="{{ route('admin.deletePost', $post->id) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 font-medium">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                {{-- Pagination --}}
                <div class="mt-4">
                    {{ $posts->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No Posts Yet</h3>
                    <p class="mt-1 text-sm text-gray-500">There are no posts in the forum yet.</p>
                    <div class="mt-6">
                        <a href="{{ url('/forum') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#145c2f] hover:bg-[#0b6e2d]">
                            View Forum
                        </a>
                    </div>
                </div>
            @endif
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



