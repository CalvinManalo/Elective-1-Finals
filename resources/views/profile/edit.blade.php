@extends('layouts.navi')

@section('title', 'Edit Profile - FEU Cavite Alumni Platform')

@section('content')
<style>
    .facebook-edit {
        font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        background: #f0f2f5;
        min-height: 100vh;
    }
    .edit-header {
        background: white;
        border-bottom: 1px solid #dadde1;
        padding: 16px 0;
        margin-bottom: 20px;
    }
    .edit-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }
    .edit-sidebar {
        background: white;
        border-radius: 8px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.1);
        overflow: hidden;
        margin-bottom: 20px;
    }
    .sidebar-header {
        padding: 16px;
        border-bottom: 1px solid #dadde1;
        font-weight: 600;
        color: #1c1e21;
        background: #f8f9fa;
    }
    .sidebar-content {
        padding: 0;
    }
    .sidebar-item {
        display: flex;
        align-items: center;
        padding: 12px 16px;
        border-bottom: 1px solid #e4e6ea;
        cursor: pointer;
        transition: background 0.1s;
    }
    .sidebar-item:hover {
        background: #f2f3f5;
    }
    .sidebar-item.active {
        background: #e7f3ff;
        border-left: 3px solid #1877f2;
    }
    .sidebar-item i {
        margin-right: 12px;
        width: 20px;
        text-align: center;
        color: #65676b;
    }
    .sidebar-item.active i {
        color: #1877f2;
    }
    .edit-main {
        background: white;
        border-radius: 8px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    .main-header {
        padding: 20px;
        border-bottom: 1px solid #dadde1;
    }
    .main-title {
        font-size: 24px;
        font-weight: bold;
        color: #1c1e21;
        margin-bottom: 4px;
    }
    .main-subtitle {
        color: #65676b;
        font-size: 15px;
    }
    .form-section {
        padding: 20px;
        border-bottom: 1px solid #dadde1;
    }
    .form-section:last-child {
        border-bottom: none;
    }
    .section-title {
        font-size: 18px;
        font-weight: 600;
        color: #1c1e21;
        margin-bottom: 16px;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-label {
        display: block;
        font-weight: 600;
        color: #1c1e21;
        margin-bottom: 8px;
        font-size: 14px;
    }
    .form-control {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #dddfe2;
        border-radius: 6px;
        font-size: 15px;
        background: #f8f9fa;
    }
    .form-control:focus {
        outline: none;
        border-color: #1877f2;
        box-shadow: 0 0 0 2px rgba(24, 119, 242, 0.2);
        background: white;
    }
    .btn-facebook {
        background: #1877f2;
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 15px;
        cursor: pointer;
        margin-right: 8px;
    }
    .btn-facebook:hover {
        background: #166fe5;
    }
    .btn-cancel {
        background: transparent;
        color: #65676b;
        border: none;
        padding: 12px 24px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 15px;
        cursor: pointer;
    }
    .btn-cancel:hover {
        background: #f2f3f5;
    }
    .btn-danger {
        background: #e41e3f;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
    }
    .btn-danger:hover {
        background: #d73527;
    }
    .alert {
        padding: 12px 16px;
        border-radius: 6px;
        margin-bottom: 16px;
        font-size: 14px;
    }
    .alert-success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    .alert-error {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
</style>

<div class="facebook-edit">
    <div class="edit-header">
        <div class="edit-container">
            <h1 style="font-size: 24px; font-weight: bold; color: #1c1e21; margin: 0;">Edit Profile</h1>
        </div>
    </div>

    <div class="edit-container">
        <div class="row">
            {{-- Sidebar --}}
            <div class="col-md-4">
                <div class="edit-sidebar">
                    <div class="sidebar-header">
                        <i class="fas fa-edit mr-2"></i>Edit Options
                    </div>
                    <div class="sidebar-content">
                        <div class="sidebar-item active" data-section="basic-info">
                            <i class="fas fa-user"></i>
                            Basic Information
                        </div>
                        <div class="sidebar-item" data-section="security">
                            <i class="fas fa-lock"></i>
                            Security & Password
                        </div>
                        <div class="sidebar-item" data-section="account">
                            <i class="fas fa-exclamation-triangle"></i>
                            Account Management
                        </div>
                        <div class="sidebar-item" data-section="privacy">
                            <i class="fas fa-shield-alt"></i>
                            Privacy Settings
                        </div>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="edit-sidebar">
                    <div class="sidebar-header">
                        <i class="fas fa-bolt mr-2"></i>Quick Actions
                    </div>
                    <div class="sidebar-content">
                        <a href="{{ route('profile.dashboard') }}" class="sidebar-item" style="text-decoration: none; color: inherit;">
                            <i class="fas fa-tachometer-alt"></i>
                            View Profile
                        </a>
                        <a href="{{ route('dashboard') }}" class="sidebar-item" style="text-decoration: none; color: inherit;">
                            <i class="fas fa-home"></i>
                            Main Dashboard
                        </a>
                        <a href="{{ route('alumni.index') }}" class="sidebar-item" style="text-decoration: none; color: inherit;">
                            <i class="fas fa-graduation-cap"></i>
                            Alumni Portal
                        </a>
                    </div>
                </div>
            </div>

            {{-- Main Content --}}
            <div class="col-md-8">
                <div class="edit-main">
                    {{-- Success/Error Messages --}}
                    @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-error">
                            <ul style="margin: 0; padding-left: 20px;">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Basic Information Section --}}
                    <div class="form-section" id="basic-info-section">
                        <div class="main-header">
                            <div class="main-title">Basic Information</div>
                            <div class="main-subtitle">Update your account's profile information and email address</div>
                        </div>

                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('patch')

                            <div class="form-group">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
                                @if($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                    <div style="margin-top: 8px; font-size: 14px; color: #65676b;">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>
                                        Your email address is unverified.
                                        <a href="{{ route('verification.send') }}" style="color: #1877f2; text-decoration: none;">Click here to re-send the verification email.</a>
                                    </div>
                                @endif
                            </div>

                            <div style="padding-top: 16px; border-top: 1px solid #dadde1;">
                                <button type="submit" class="btn-facebook">Save Changes</button>
                                <button type="button" class="btn-cancel" onclick="window.history.back()">Cancel</button>
                            </div>
                        </form>
                    </div>

                    {{-- Security Section --}}
                    <div class="form-section" id="security-section" style="display: none;">
                        <div class="main-header">
                            <div class="main-title">Security & Password</div>
                            <div class="main-subtitle">Update your password to keep your account secure</div>
                        </div>

                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('patch')

                            <div class="form-group">
                                <label class="form-label">Current Password</label>
                                <input type="password" class="form-control" name="current_password" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">New Password</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" name="password_confirmation" required>
                            </div>

                            <div style="padding-top: 16px; border-top: 1px solid #dadde1;">
                                <button type="submit" class="btn-facebook">Update Password</button>
                                <button type="button" class="btn-cancel" onclick="window.history.back()">Cancel</button>
                            </div>
                        </form>
                    </div>

                    {{-- Account Management Section --}}
                    <div class="form-section" id="account-section" style="display: none;">
                        <div class="main-header">
                            <div class="main-title">Account Management</div>
                            <div class="main-subtitle">Manage your account settings and data</div>
                        </div>

                        <div style="background: #fff3cd; border: 1px solid #ffeaa7; border-radius: 6px; padding: 16px; margin-bottom: 20px;">
                            <h4 style="color: #856404; margin: 0 0 8px 0; font-size: 16px;">
                                <i class="fas fa-exclamation-triangle mr-2"></i>Danger Zone
                            </h4>
                            <p style="color: #856404; margin: 0; font-size: 14px;">
                                Once you delete your account, there is no going back. Please be certain.
                            </p>
                        </div>

                        <form method="POST" action="{{ route('profile.destroy') }}">
                            @csrf
                            @method('delete')

                            <div class="form-group">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Enter your password to confirm" required>
                            </div>

                            <div style="padding-top: 16px; border-top: 1px solid #dadde1;">
                                <button type="submit" class="btn-danger">
                                    <i class="fas fa-trash-alt mr-2"></i>Delete Account
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Privacy Settings Section --}}
                    <div class="form-section" id="privacy-section" style="display: none;">
                        <div class="main-header">
                            <div class="main-title">Privacy Settings</div>
                            <div class="main-subtitle">Control who can see your information and activity</div>
                        </div>

                        <div style="text-align: center; padding: 40px 20px; color: #65676b;">
                            <i class="fas fa-shield-alt" style="font-size: 48px; margin-bottom: 16px; display: block;"></i>
                            <h4 style="margin-bottom: 8px;">Privacy Settings Coming Soon</h4>
                            <p>We're working on advanced privacy controls for your account.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebarItems = document.querySelectorAll('.sidebar-item[data-section]');
    const sections = document.querySelectorAll('.form-section');

    sidebarItems.forEach(item => {
        item.addEventListener('click', function() {
            const sectionId = this.getAttribute('data-section');

            // Remove active class from all items
            sidebarItems.forEach(i => i.classList.remove('active'));

            // Add active class to clicked item
            this.classList.add('active');

            // Hide all sections
            sections.forEach(section => section.style.display = 'none');

            // Show selected section
            const targetSection = document.getElementById(sectionId + '-section');
            if (targetSection) {
                targetSection.style.display = 'block';
            }
        });
    });
});
</script>
@endpush
@endsection
