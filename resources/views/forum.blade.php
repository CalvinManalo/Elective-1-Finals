@extends('layouts.navi')

@section('title', 'Forum - FEU Cavite Alumni Platform')

@section('content')
<div class="banner" style="
    width: 100%;
    height: 300px;
    background-image: url('{{ asset('images/image.png') }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    font-size: 40px;
    font-weight: bold;
    text-shadow: 2px 2px 4px black;
">
    Forum
</div>

<div class="content">
    
    <!-- Post Input -->
    <div class="input-box post-box">
        <textarea id="postText" rows="3" placeholder="Write something..." style="width: 80%; padding: 10px; border-radius: 10px; border: 1px solid #ccc; outline: none; resize: vertical; font-family: Arial, sans-serif;"></textarea>
        <button onclick="addPost()" style="margin-left: 10px; vertical-align: top; margin-top: 5px;">Post</button>
    </div>

    <!-- Posts Area -->
    <div id="postsArea">
        <!-- Posts will be loaded dynamically -->
    </div>

</div>

@push('scripts')
<script src="{{ asset('js/navi.js') }}"></script>
@endpush
@endsection



