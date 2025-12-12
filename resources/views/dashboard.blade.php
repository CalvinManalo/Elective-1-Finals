@extends('layouts.navi')

@section('title', 'Dashboard - FEU Cavite Alumni Platform')

@section('content')

{{-- Success Message --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show text-center mt-3" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

{{-- Welcome Banner --}}
<div class="banner" style="
    width: 100%;
    height: 250px;
    background-image: url('{{ asset('images/image.png') }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    color: white;
    font-weight: bold;
    text-shadow: 2px 2px 4px black;
    margin-bottom: 30px;
">
    <h1 style="font-size: 48px; margin-bottom: 10px;">Welcome Home Tamaraw!</h1>
    @if(Auth::check())
        <p style="font-size: 24px;">{{ Auth::user()->name }}</p>
    @endif
</div>

<div class="content">
    
    {{-- Quick Actions Section --}}
    <div style="margin-bottom: 40px;">
        <h2 class="section-title">Quick Actions</h2>
        <div style="display: flex; flex-wrap: wrap; gap: 15px;">
            <a href="{{ route('alumni.index') }}" class="btn btn-success" style="padding: 12px 25px; border-radius: 25px; text-decoration: none; font-weight: bold;">
                View Alumni
            </a>
            <a href="{{ url('/forum') }}" class="btn btn-success" style="padding: 12px 25px; border-radius: 25px; text-decoration: none; font-weight: bold;">
                Go to Forum
            </a>
            <a href="{{ url('/calendar') }}" class="btn btn-success" style="padding: 12px 25px; border-radius: 25px; text-decoration: none; font-weight: bold;">
                View Calendar
            </a>
            <a href="{{ url('/opportunities') }}" class="btn btn-success" style="padding: 12px 25px; border-radius: 25px; text-decoration: none; font-weight: bold;">
                Browse Opportunities
            </a>
        </div>
    </div>

    {{-- Main Dashboard Grid --}}
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 25px; margin-bottom: 30px;">
        
        {{-- Forum Posts Widget --}}
        <div class="post-box" style="height: 100%;">
            <h3 style="color: #0b6623; margin-bottom: 15px; font-size: 22px;">Recent Forum Posts</h3>
            <div id="postsArea">
                <!-- Posts will be loaded dynamically -->
            </div>
            <div class="input-box post-box" style="margin-top: 15px;">
                <input id="postText" type="text" placeholder="Write something...">
                <button onclick="addPost()">Post</button>
            </div>
            <div style="margin-top: 15px; text-align: center;">
                <a href="{{ url('/forum') }}" style="color: #0b6623; text-decoration: none; font-weight: bold;">View All Posts →</a>
            </div>
        </div>

        {{-- Alumni of the Week Widget --}}
        <div class="post-box" style="height: 100%; position: relative; overflow: hidden;">
            <div class="alumni-week" style="margin-bottom: 15px; font-size: 20px; font-weight: bold; color: #ffffff; background: rgba(0,0,0,0.7); padding: 8px 16px; border-radius: 10px; display: inline-block; text-shadow: 1px 1px 2px rgba(0,0,0,0.8);">🏆 Alumni of the Week</div>
            @php
                $alumniOfTheWeekId = cache('alumni_of_the_week');
                $alumniOfTheWeek = $alumniOfTheWeekId ? \App\Models\Alumni::find($alumniOfTheWeekId) : null;
                $isNominated = $alumniOfTheWeek && str_starts_with($alumniOfTheWeek->id_number, 'NOM-');
                $nominationMessage = null;
                if ($isNominated) {
                    $nominationId = str_replace('NOM-', '', $alumniOfTheWeek->id_number);
                    $nomination = \App\Models\AlumniNomination::find($nominationId);
                    $nominationMessage = $nomination ? $nomination->message : null;
                }
            @endphp
            @if($alumniOfTheWeek)
            <div class="alumni-card" style="background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%); border-radius: 15px; padding: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); border: 2px solid #0b6623; position: relative;">
                <div style="position: absolute; top: -10px; right: -10px; background: #0b6623; color: white; border-radius: 50%; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; font-size: 16px;">⭐</div>
                <div style="text-align: center;">
                    <h3 style="color: #0b6623; margin-bottom: 10px; font-size: 20px; font-weight: bold;">{{ $alumniOfTheWeek->name }} @if($isNominated)<span class="badge bg-success ms-2" style="font-size: 12px;">Nominated</span>@endif</h3>
                    <div style="background: rgba(11, 102, 35, 0.1); padding: 10px; border-radius: 10px; margin-bottom: 15px;">
                        <p style="margin: 0; color: #0b6623; font-weight: 500;"><i class="fas fa-graduation-cap"></i> {{ $alumniOfTheWeek->course }} - {{ $alumniOfTheWeek->batch }}</p>
                    </div>
                    <div style="background: white; padding: 15px; border-radius: 10px; border-left: 4px solid #0b6623;">
                        <p style="margin: 0; font-style: italic; color: #000000; line-height: 1.5;">"{{ $isNominated && $nominationMessage ? $nominationMessage : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris nulla elit, gravida ut aliquet vel, malesuada id elit.' }}"</p>
                    </div>
                </div>
            </div>
            @else
            <div class="alumni-card" style="background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%); border-radius: 15px; padding: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); border: 2px dashed #6c757d; position: relative;">
                <div style="text-align: center;">
                    <div style="font-size: 48px; margin-bottom: 15px; opacity: 0.5;">🏆</div>
                    <h3 style="color: #ffffff; margin-bottom: 10px; font-size: 20px;">No Alumni Selected</h3>
                    <div style="background: white; padding: 15px; border-radius: 10px;">
                        <p style="margin: 0; font-style: italic; color: #000000; line-height: 1.5;">"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris nulla elit, gravida ut aliquet vel, malesuada id elit."</p>
                    </div>
                </div>
            </div>
            @endif
            <div style="margin-top: 15px; text-align: center;">
                <a href="{{ route('alumni.index') }}" style="color: #0b6623; text-decoration: none; font-weight: bold; padding: 8px 16px; border: 2px solid #0b6623; border-radius: 20px; transition: all 0.3s ease;" onmouseover="this.style.background='#0b6623'; this.style.color='white';" onmouseout="this.style.background='transparent'; this.style.color='#0b6623';">View Alumni →</a>
            </div>
        </div>

        {{-- Calendar Widget --}}
        <div class="post-box" style="height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center;">
            <h3 style="color: #0b6623; margin-bottom: 15px; font-size: 22px;">Upcoming Events</h3>
            <div style="text-align: center; margin-bottom: 20px;">
                <img src="{{ asset('images/calendar1.png') }}" alt="FEU Cavite Calendar" style="width: 200px; height: auto; border-radius: 8px;">
            </div>
            <div style="text-align: center;">
                <a href="{{ url('/calendar') }}" class="btn btn-success" style="padding: 10px 20px; border-radius: 25px; text-decoration: none; font-weight: bold;">
                    View Full Calendar
                </a>
            </div>
        </div>

    </div>

    {{-- Opportunities Section --}}
    <div style="margin-bottom: 30px;">
        <h2 class="section-title">Featured Opportunities</h2>
        <div class="opportunity-list" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px;">
            
            <div class="opportunity-card">
                <h3>IT Support Intern</h3>
                <p>Troubleshoot hardware issues (PCs, printers, peripherals) and provide help-desk support.</p>
                <button class="select-btn" onclick="window.location.href='{{ url('/opportunities') }}'">View Details</button>
            </div>

            <div class="opportunity-card">
                <h3>Web Developer Intern</h3>
                <p>Build and maintain websites using HTML, CSS, JavaScript, and frameworks like React or Angular.</p>
                <button class="select-btn" onclick="window.location.href='{{ url('/opportunities') }}'">View Details</button>
            </div>

            <div class="opportunity-card">
                <h3>Data Analyst Intern</h3>
                <p>Clean and analyze datasets, often with Excel, Python, or Power BI.</p>
                <button class="select-btn" onclick="window.location.href='{{ url('/opportunities') }}'">View Details</button>
            </div>

        </div>
        <div style="margin-top: 20px; text-align: center;">
            <a href="{{ url('/opportunities') }}" style="color: #0b6623; text-decoration: none; font-weight: bold; font-size: 18px;">View All Opportunities →</a>
        </div>
    </div>

    {{-- Alumni Registration Quick Access --}}
    <div class="post-box" style="text-align: center; padding: 30px; margin-bottom: 30px;">
        <h2 style="color: #0b6623; margin-bottom: 20px;">Get Your FEU Cavite Alumni Card</h2>
        <div style="margin-bottom: 20px;">
            <div class="card" style="
                width: 300px;
                height: 180px;
                background-image: url('{{ asset('images/card.png') }}');
                background-size: contain;
                background-repeat: no-repeat;
                background-position: center;
                background-color: transparent;
                border: none;
                display: flex;
                justify-content: center;
                align-items: center;
                margin: 0 auto;
            "></div>
        </div>
        <button type="button" id="openAlumniModalBtn" class="btn btn-success" style="padding: 12px 30px; border-radius: 25px; font-weight: bold;">
            Register Now
        </button>
    </div>

</div>

{{-- Include Alumni Registration Modal --}}
@include('alumniModal')

{{-- Success alert container --}}
<div id="successAlertContainer"></div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Alumni registration button opens modal
    const openModalBtn = document.getElementById('openAlumniModalBtn');
    if (openModalBtn) {
        openModalBtn.addEventListener('click', function () {
            const modal = new bootstrap.Modal(document.getElementById('alumniModal'));
            modal.show();
            console.log('Alumni registration modal opened.');
        });
    }
});
</script>
<script src="{{ asset('js/alumni.js') }}"></script>
<script src="{{ asset('js/navi.js') }}"></script>
@endpush
