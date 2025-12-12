<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Monitoring Dashboard - FEU Cavite Alumni Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .monitor-card {
            transition: all 0.3s ease;
        }
        .monitor-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .status-indicator {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
        }
        .status-active { background-color: #10b981; }
        .status-inactive { background-color: #ef4444; }
    </style>
</head>
<body class="bg-gray-50">
    
    {{-- Header --}}
    @php $align = $align ?? 'center'; @endphp
    <div class="w-full bg-white shadow">
        <div class="max-w-6xl mx-auto px-6 py-4 flex items-center {{ $align === 'left' ? 'justify-start' : 'justify-center' }}">
            <img src="{{ asset('images/header.png') }}" alt="Header image" class="h-16 object-contain">
        </div>
    </div>

    {{-- Navigation Bar --}}
    <nav class="bg-[#145c2f] text-white py-3 shadow-lg">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            <div class="flex items-center gap-6">
                <a href="{{ route('admin.dashboard') }}" class="font-bold hover:text-gray-200 text-lg">Monitoring Dashboard</a>
                <a href="{{ route('admin.users') }}" class="hover:text-gray-200">Accounts</a>
                <a href="{{ route('admin.alumni') }}" class="hover:text-gray-200">Alumni</a>
                <a href="{{ route('admin.posts') }}" class="hover:text-gray-200">Posts</a>
            </div>
            <div class="flex items-center gap-4">
                <span class="font-bold">{{ Auth::user()->name }}</span>
                <span class="text-xs bg-white text-[#145c2f] px-2 py-1 rounded">ADMIN</span>
                <a href="{{ route('dashboard') }}" class="hover:text-gray-200 text-sm">Regular Dashboard</a>
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
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="max-w-7xl mx-auto px-6 mt-4">
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    </div>
    @endif

    {{-- Main Content --}}
    <div class="max-w-7xl mx-auto px-6 py-8">
        
        {{-- Page Title --}}
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Admin Monitoring Dashboard</h1>
            <p class="text-gray-600">Real-time monitoring of accounts, posts, and platform activity</p>
            <div class="mt-2 flex items-center gap-4 text-sm text-gray-500">
                <span>Last updated: {{ now()->format('M d, Y h:i A') }}</span>
                <span class="status-indicator status-active"></span>
                <span>System Active</span>
            </div>
        </div>

        {{-- Key Metrics Row --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            
            {{-- Total Accounts --}}
            <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500 monitor-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium uppercase">Total Accounts</p>
                        <p class="text-4xl font-bold text-gray-800 mt-2">{{ $stats['total_users'] }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $stats['users_today'] }} new today</p>
                    </div>
                    <div class="bg-blue-100 rounded-full p-4">
                        <svg class="w-10 h-10 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                </div>
                <a href="{{ route('admin.users') }}" class="text-blue-500 text-sm font-medium mt-4 inline-block hover:underline">Monitor All →</a>
            </div>

            {{-- Alumni Records --}}
            <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500 monitor-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium uppercase">Alumni Records</p>
                        <p class="text-4xl font-bold text-gray-800 mt-2">{{ $stats['total_alumni'] }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $stats['alumni_registrations_today'] }} registered today</p>
                    </div>
                    <div class="bg-green-100 rounded-full p-4">
                        <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
                <a href="{{ route('admin.alumni') }}" class="text-green-500 text-sm font-medium mt-4 inline-block hover:underline">Monitor All →</a>
            </div>

            {{-- New This Week --}}
            <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-purple-500 monitor-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium uppercase">New This Week</p>
                        <p class="text-4xl font-bold text-gray-800 mt-2">{{ $stats['users_this_week'] }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $stats['users_this_month'] }} this month</p>
                    </div>
                    <div class="bg-purple-100 rounded-full p-4">
                        <svg class="w-10 h-10 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Role Distribution --}}
            <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-orange-500 monitor-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium uppercase">Role Breakdown</p>
                        <div class="mt-2 space-y-1">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Students:</span>
                                <span class="font-bold">{{ $stats['total_students'] }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Alumni:</span>
                                <span class="font-bold">{{ $stats['total_alumni_users'] }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Employees:</span>
                                <span class="font-bold">{{ $stats['total_employees'] }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-orange-100 rounded-full p-4">
                        <svg class="w-10 h-10 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

        </div>

        {{-- Monitoring Sections --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            
            {{-- Account Monitoring --}}
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Account Monitoring</h2>
                        <p class="text-sm text-gray-600 mt-1">Recent account activity</p>
                    </div>
                    <a href="{{ route('admin.users') }}" class="text-[#145c2f] hover:underline font-medium text-sm">View All →</a>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Account</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Joined</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($stats['recent_users'] as $user)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-8 w-8 bg-gray-200 rounded-full flex items-center justify-center">
                                            <span class="text-xs font-medium text-gray-600">{{ substr($user->name, 0, 1) }}</span>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                            <div class="text-xs text-gray-500">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' : '' }}
                                        {{ $user->role === 'student' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $user->role === 'alumni' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $user->role === 'employee' ? 'bg-orange-100 text-orange-800' : '' }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <span class="status-indicator status-active"></span>
                                    <span class="text-xs text-gray-600">Active</span>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-xs text-gray-500">
                                    {{ $user->created_at->diffForHumans() }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-4 py-4 text-center text-gray-500">No accounts found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Alumni Monitoring --}}
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Alumni Monitoring</h2>
                        <p class="text-sm text-gray-600 mt-1">Recent alumni registrations</p>
                    </div>
                    <a href="{{ route('admin.alumni') }}" class="text-[#145c2f] hover:underline font-medium text-sm">View All →</a>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Batch</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Registered</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($stats['recent_alumni'] as $alum)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $alum->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $alum->id_number }}</div>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">{{ $alum->course }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">{{ $alum->batch }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-xs text-gray-500">
                                    {{ $alum->created_at->diffForHumans() }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-4 py-4 text-center text-gray-500">No alumni records found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        {{-- Posts Monitoring Section --}}
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Posts Moitoring</h2>
                    <p class="text-sm text-gray-600 mt-1">Monitor forum posts and activity</p>
                </div>
                <a href="{{ route('admin.posts') }}" class="text-[#145c2f] hover:underline font-medium text-sm">Manage Posts →</a>
            </div>
            
            <div class="bg-gray-50 rounded-lg p-8 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Post Management Ready</h3>
                <p class="text-sm text-gray-500 mb-4">Create a Post model to enable post monitoring and management features.</p>
                <a href="{{ route('admin.posts') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#145c2f] hover:bg-[#0b6e2d]">
                    Go to Posts Management
                </a>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('admin.users') }}" class="bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg shadow-md p-6 hover:shadow-lg transition-all monitor-card">
                <div class="flex items-center">
                    <div class="bg-white bg-opacity-20 rounded-full p-3 mr-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold">Manage Accounts</h3>
                        <p class="text-sm opacity-90 mt-1">View, edit, and monitor all user accounts</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.alumni') }}" class="bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg shadow-md p-6 hover:shadow-lg transition-all monitor-card">
                <div class="flex items-center">
                    <div class="bg-white bg-opacity-20 rounded-full p-3 mr-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold">Monitor Alumni</h3>
                        <p class="text-sm opacity-90 mt-1">Track and manage alumni registrations</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.posts') }}" class="bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-lg shadow-md p-6 hover:shadow-lg transition-all monitor-card">
                <div class="flex items-center">
                    <div class="bg-white bg-opacity-20 rounded-full p-3 mr-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold">Control Posts</h3>
                        <p class="text-sm opacity-90 mt-1">Monitor and moderate forum posts</p>
                    </div>
                </div>
            </a>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
