<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manage Alumni - Admin Dashboard</title>
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
                <a href="{{ route('admin.alumni') }}" class="hover:text-gray-200 underline">Alumni</a>
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

    {{-- Main Content --}}
    <div class="max-w-7xl mx-auto px-6 py-8">
        
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Manage Alumni</h1>
            <p class="text-gray-600">View and manage alumni records</p>
        </div>

        {{-- Alumni of the Week Selection --}}
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Select Alumni of the Week</h2>
            <form method="POST" action="{{ route('admin.setAlumniOfTheWeek') }}">
                @csrf
                <div class="mb-4">
                    <label for="alumni_id" class="block text-sm font-medium text-gray-700">Choose Alumni</label>
                    <select name="alumni_id" id="alumni_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                        <option value="">Select an alumni</option>
                        @foreach($alumni as $alum)
                        <option value="{{ $alum->id }}" {{ $alum->id == ($alumniOfTheWeek->id ?? null) ? 'selected' : '' }}>
                            {{ $alum->name }} - {{ $alum->course }} ({{ $alum->batch }})
                        </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="bg-[#145c2f] text-white px-4 py-2 rounded hover:bg-[#0b6e2d]">Set as Alumni of the Week</button>
                <a href="{{ route('admin.setRandomAlumniOfTheWeek') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 ml-4">Set Random Alumni of the Week</a>
            </form>
            @if($alumniOfTheWeek)
            <div class="mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                Current Alumni of the Week: {{ $alumniOfTheWeek->name }} - {{ $alumniOfTheWeek->course }} ({{ $alumniOfTheWeek->batch }})
            </div>
            @endif
        </div>

        {{-- Alumni Nominations --}}
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Alumni Nominations</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nominated By</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alumni Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Batch</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Message</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($nominations as $nomination)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $nomination->user->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ $nomination->alumni_name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ $nomination->course }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ $nomination->batch }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ $nomination->message }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <form method="POST" action="{{ route('admin.setAlumniOfTheWeekFromNomination') }}" class="inline">
                                    @csrf
                                    <input type="hidden" name="nomination_id" value="{{ $nomination->id }}">
                                    <button type="submit" class="bg-[#145c2f] text-white px-3 py-1 rounded hover:bg-[#0b6e2d]">Set as Alumni of the Week</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">No nominations found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Alumni Table --}}
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Number</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Batch</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Registered</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($alumni as $alum)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $alum->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ $alum->id_number }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ $alum->course }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ $alum->batch }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $alum->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <form method="POST" action="{{ route('admin.deleteAlumni', $alum->id) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this alumni record?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">No alumni records found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $alumni->links() }}
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



