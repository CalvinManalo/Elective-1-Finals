@extends('layouts.navi')

@section('title', 'Home - FEU Cavite Alumni Platform')

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
    Welcome Home Tamaraw!
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

    {{-- Alumni of the Week Section --}}
    <div class="text-center mt-5">
        <h2 style="font-size: 36px; font-weight: bold; color: #ffffff; background: rgba(0,0,0,0.7); padding: 10px 20px; border-radius: 15px; display: inline-block; text-shadow: 2px 2px 4px rgba(0,0,0,0.8); margin-bottom: 30px;">🏆 Alumni of the Week</h2>
        @if($alumniOfTheWeek)
        <div class="card mx-auto" style="width: 70%; margin-top: 20px; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 20px; box-shadow: 0 8px 25px rgba(0,0,0,0.15); border: 3px solid #0b6623; position: relative; overflow: hidden;">
            <div style="position: absolute; top: -15px; right: -15px; background: #0b6623; color: white; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; font-size: 20px; box-shadow: 0 4px 10px rgba(0,0,0,0.3);">⭐</div>
            <div class="card-body text-center" style="padding: 30px;">
                <h5 class="card-title" style="font-size: 28px; font-weight: bold; color: #0b6623; margin-bottom: 15px;">{{ $alumniOfTheWeek->name }} @if($isNominated)<span class="badge bg-success ms-2" style="font-size: 14px; padding: 6px 12px;">Nominated</span>@endif</h5>
                <div style="background: rgba(11, 102, 35, 0.1); padding: 15px; border-radius: 15px; margin-bottom: 20px; display: inline-block;">
                    <p class="card-text" style="margin: 0; color: #0b6623; font-weight: 600; font-size: 18px;"><i class="fas fa-graduation-cap" style="margin-right: 8px;"></i>{{ $alumniOfTheWeek->course }} - {{ $alumniOfTheWeek->batch }}</p>
                </div>
                <div style="background: white; padding: 20px; border-radius: 15px; border-left: 5px solid #0b6623; box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);">
                    <p class="card-text" style="margin: 0; font-style: italic; color: #495057; font-size: 16px; line-height: 1.6;">"{{ $isNominated && $nominationMessage ? $nominationMessage : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris nulla elit, gravida ut aliquet vel, malesuada id elit.' }}"</p>
                </div>
            </div>
        </div>
        @else
        <div class="card mx-auto" style="width: 70%; margin-top: 20px; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 20px; box-shadow: 0 8px 25px rgba(0,0,0,0.15); border: 3px dashed #6c757d; position: relative; overflow: hidden;">
            <div class="card-body text-center" style="padding: 30px;">
                <div style="font-size: 64px; margin-bottom: 20px; opacity: 0.5;">🏆</div>
                <h5 class="card-title" style="font-size: 24px; color: #6c757d; margin-bottom: 15px;">No Alumni Selected</h5>
                <div style="background: white; padding: 20px; border-radius: 15px; border-left: 5px solid #6c757d; box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);">
                    <p class="card-text" style="margin: 0; font-style: italic; color: #6c757d; font-size: 16px; line-height: 1.6;">"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris nulla elit, gravida ut aliquet vel, malesuada id elit."</p>
                </div>
            </div>
        </div>
        @endif
    </div>

</div>

@push('scripts')
<script src="{{ asset('js/navi.js') }}"></script>
@endpush
@endsection



