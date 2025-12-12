@extends('layouts.navi')

@section('title', 'BSIT Internship Opportunities - FEU Cavite Alumni Platform')

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
     Internship Opportunities
</div>

<div class="content">

    <div class="opportunity-list">

        <div class="opportunity-card">
            <h3>IT Support Intern</h3>
            <p>
                Troubleshoot hardware issues (PCs, printers, peripherals) and provide help-desk support.
                Install and configure computers, printers, and network devices. Assist users with hardware setup.
            </p>
            <button class="select-btn" onclick="openForm('IT Support Intern')">Select</button>
        </div>

        <div class="opportunity-card">
            <h3>Systems Administration Intern</h3>
            <p>
                Help maintain Windows and Linux servers. Manage user permissions, group policies, and system performance checks.
            </p>
            <button class="select-btn" onclick="openForm('Systems Administration Intern')">Select</button>
        </div>

        <div class="opportunity-card">
            <h3>IT Infrastructure Intern</h3>
            <p>
                Assist in maintaining LAN/WAN infrastructure. Monitor uptime and system health using internal tools.
            </p>
            <button class="select-btn" onclick="openForm('IT Infrastructure Intern')">Select</button>
        </div>

         <div class="opportunity-card">
            <h3>Technical Support Intern</h3>
            <p>
                Help configure workstations, Wi-Fi access points, and VoIP phones.Perform system diagnostics and escalate major issues to senior staff. Support system upgrades and software patching.

            </p>
            <button class="select-btn" onclick="openForm('Technical Support Intern')">Select</button>
        </div>

        <div class="opportunity-card">
            <h3>Web Developer Intern</h3>
            <p>
                Build and maintain websites using HTML, CSS, JavaScript, and frameworks like React or Angular.
            </p>
            <button class="select-btn" onclick="openForm('Web Developer Intern')">Select</button>
        </div>

        <div class="opportunity-card">
            <h3>Mobile App Developer Intern</h3>
            <p>
                Work on Android/iOS apps, often using Java, Kotlin, or Flutter.
            </p>
            <button class="select-btn" onclick="openForm('Mobile App Developer Intern')">Select</button>
        </div>

        <div class="opportunity-card">
            <h3>Data Analyst Intern</h3>
            <p>
                Clean and analyze datasets, often with Excel, Python, or Power BI.
            </p>
            <button class="select-btn" onclick="openForm('Data Analyst Intern')">Select</button>
        </div>

        <div class="opportunity-card">
            <h3>Game Development Intern</h3>
            <p>
                Assist in designing or coding small game features with Unity or Unreal Engine.
            </p>
            <button class="select-btn" onclick="openForm('Game Development Intern')">Select</button>
        </div>

        <div class="opportunity-card">
            <h3>Security Analyst Intern</h3>
            <p>
                Monitor systems for threats and learn about firewalls and intrusion detection.
            </p>
            <button class="select-btn" onclick="openForm('Security Analyst Intern')">Select</button>
        </div>

        <div class="opportunity-card">
            <h3>Data Analyst Intern</h3>
            <p>
                Learn SQL, optimize queries, and maintain company databases.
            </p>
            <button class="select-btn" onclick="openForm('Data Analyst Intern')">Select</button>
        </div>

    </div>

</div>

{{-- Include the modal from separate Blade --}}
@include('modalForm')

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/opportunities.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('js/opportunities.js') }}"></script>
@endpush



