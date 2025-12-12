@extends('layouts.navi')

@section('title', 'Profile - FEU Cavite Alumni Platform')

@section('content')
<style>
    .facebook-profile {
        font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
    }
    .cover-photo {
        height: 350px;
        background: linear-gradient(135deg, #ffffff 0%, #ffffff 100%);
        position: relative;
    }
    .profile-avatar {
        width: 168px;
        height: 168px;
        border-radius: 50%;
        border: 4px solid white;
        position: absolute;
        bottom: -84px;
        left: 40px;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    }
    .profile-info {
        margin-top: 100px;
        padding: 0 40px;
    }
    .profile-name {
        font-size: 32px;
        font-weight: bold;
        color: #1c1e21;
        margin-bottom: 8px;
    }
    .profile-meta {
        font-size: 16px;
        color: #65676b;
        margin-bottom: 16px;
    }
    .profile-actions {
        display: flex;
        gap: 8px;
        margin-bottom: 20px;
    }
    .nav-tabs {
        border-bottom: 1px solid #dadde1;
        margin-bottom: 20px;
    }
    .nav-tabs .nav-link {
        border: none;
        border-radius: 8px 8px 0 0;
        color: #ffffff;
        font-weight: 600;
        padding: 12px 16px;
        margin-right: 8px;
    }
    .nav-tabs .nav-link.active {
        background: #febe10;
        color: white;
    }
    .nav-tabs .nav-link:hover {
        background: #f2f3f5;
        color: #1c1e21;
    }
    .timeline-post {
        background: white;
        border-radius: 8px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.1);
        margin-bottom: 16px;
        overflow: hidden;
    }
    .post-header {
        padding: 12px 16px;
        border-bottom: 1px solid #dadde1;
    }
    .post-content {
        padding: 16px;
    }
    .sidebar-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.1);
        margin-bottom: 16px;
        overflow: hidden;
    }
    .sidebar-header {
        padding: 16px;
        border-bottom: 1px solid #dadde1;
        font-weight: 600;
        color: #1c1e21;
    }
    .sidebar-content {
        padding: 16px;
    }
    .stat-item {
        display: flex;
        align-items: center;
        margin-bottom: 12px;
    }
    .stat-icon {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        font-size: 16px;
    }
    .btn-facebook {
        background: #0b6623;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
    }
    .btn-facebook:hover {
        background: #166fe5;
    }
    .btn-outline-facebook {
        background: transparent;
        color: #1877f2;
        border: 1px solid #1877f2;
        padding: 8px 16px;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
    }
    .btn-outline-facebook:hover {
        background: #f2f3f5;
    }
</style>

<div class="facebook-profile">
    {{-- Cover Photo --}}
    <div class="cover-photo">
        <div class="profile-avatar">
            <i class="fas fa-user text-6xl text-gray-400"></i>
        </div>
    </div>

    {{-- Profile Info --}}
    <div class="profile-info">
        <div class="max-w-6xl mx-auto">
            <h1 class="profile-name">{{ Auth::user()->name }}</h1>
            <div class="profile-meta">
                <span>{{ ucfirst(Auth::user()->role ?? 'Student') }} • FEU Cavite Alumni</span>
            </div>

            <div class="profile-actions">

                <a href="{{ route('profile.edit') }}" class="btn-outline-facebook">
                    <i class="fas fa-edit mr-2"></i>Edit Profile
                </a>
                <button class="btn-outline-facebook">
                    <i class="fas fa-ellipsis-h"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- Navigation Tabs --}}
    <div class="max-w-6xl mx-auto px-4">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="#timeline" data-bs-toggle="tab">
                    <i class="fas fa-stream mr-2"></i>Timeline
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#about" data-bs-toggle="tab">
                    <i class="fas fa-user mr-2"></i>About
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#more" data-bs-toggle="tab">
                    <i class="fas fa-ellipsis-h mr-2"></i>More
                </a>
            </li>
        </ul>
    </div>

    {{-- Main Content --}}
    <div class="max-w-6xl mx-auto px-4 pb-8">
        <div class="row">
            {{-- Main Timeline --}}
            <div class="col-lg-8">
                <div class="tab-content">
                    {{-- Timeline Tab --}}
                    <div class="tab-pane fade show active" id="timeline">


                        {{-- Recent Activity --}}
                        <div class="timeline-post">
                            <div class="post-header">
                                <div class="d-flex align-items-center">
                                    <div class="profile-avatar" style="width: 40px; height: 40px; position: static; margin-right: 12px;">
                                        <i class="fas fa-user text-xl text-gray-400"></i>
                                    </div>
                                    <div>
                                        <strong>{{ Auth::user()->name }}</strong>
                                        <div class="text-muted small">{{ $user->updated_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="post-content">
                                <p>Welcome to your FEU Cavite Alumni profile! 🎓</p>
                                <p>Share your achievements, connect with fellow alumni, and stay updated with the latest news from our community.</p>
                            </div>
                        </div>
                    </div>

                    {{-- About Tab --}}
                    <div class="tab-pane fade" id="about">
                        <div class="timeline-post">
                            <div class="post-content">
                                <h4>Contact Information</h4>
                                <p><strong>Email:</strong> {{ $user->email }}</p>
                                <p><strong>Role:</strong> {{ ucfirst($user->role ?? 'Student') }}</p>
                                <p><strong>Member Since:</strong> {{ $user->created_at->format('F j, Y') }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- More Tab --}}
                    <div class="tab-pane fade" id="more">
                        <div class="timeline-post">
                            <div class="post-content">
                                <h4>More Options</h4>
                                <ul class="list-unstyled">
                                    <li class="mb-2"><a href="{{ route('profile.edit') }}" class="text-decoration-none"><i class="fas fa-edit mr-2"></i>Edit Profile</a></li>
                                    <li class="mb-2"><a href="#" class="text-decoration-none"><i class="fas fa-privacy mr-2"></i>Privacy Settings</a></li>
                                    <li class="mb-2"><a href="#" class="text-decoration-none"><i class="fas fa-bell mr-2"></i>Notification Settings</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                {{-- Intro Card --}}
                <div class="sidebar-card">
                    <div class="sidebar-header">
                        <i class="fas fa-info-circle mr-2"></i>Intro
                    </div>
                    <div class="sidebar-content">
                        <div class="stat-item">
                            <div class="stat-icon bg-green-100 text-green-600">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div>
                                <div class="font-weight-bold">Member since {{ $user->created_at->format('M Y') }}</div>
                                <div class="text-muted small">Joined {{ $user->created_at->diffForHumans() }}</div>
                            </div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-icon bg-purple-100 text-purple-600">
                                <i class="fas fa-user-tag"></i>
                            </div>
                            <div>
                                <div class="font-weight-bold">{{ ucfirst($user->role ?? 'Student') }}</div>
                                <div class="text-muted small">Account Type</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush

@push('scripts')
<script src="{{ asset('js/navi.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle tab switching
    const navLinks = document.querySelectorAll('.nav-link');
    const tabPanes = document.querySelectorAll('.tab-pane');

    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();

            // Remove active class from all links and panes
            navLinks.forEach(l => l.classList.remove('active'));
            tabPanes.forEach(p => p.classList.remove('show', 'active'));

            // Add active class to clicked link
            this.classList.add('active');

            // Show corresponding tab pane
            const targetId = this.getAttribute('href').substring(1);
            const targetPane = document.getElementById(targetId);
            if (targetPane) {
                targetPane.classList.add('show', 'active');
            }
        });
    });
});
</script>
@endpush
@endsection
