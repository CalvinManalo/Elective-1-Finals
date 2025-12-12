
@php $align = $align ?? 'center'; @endphp

<div class="w-full bg-white shadow">
    <div class="max-w-6xl mx-auto px-6 py-4 flex items-center {{ $align === 'left' ? 'justify-start' : 'justify-center' }}">
        <img src="{{ asset('images/header.png') }}" alt="Header image" class="h-16 object-contain">
    </div>
</div>