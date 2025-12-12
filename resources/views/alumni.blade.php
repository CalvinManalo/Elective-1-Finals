@extends('layouts.navi')

@section('title', 'Home - FEU Cavite Alumni Platform')

@section('content')

{{-- Success Message --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show text-center mt-3" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

{{-- Banner --}}
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
    Alumni
</div>
<div class="content">

    {{-- Alumni Card Registration --}}
    <div class="text-center mb-5">
        <h2>Get Your FEU Cavite Alumni Card</h2>

        <div class="card" style="
            width: 50%;
            height: 200px;
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
        ">
        </div>

        {{-- Updated Register Button --}}
        <button type="button" id="openAlumniModalBtn" class="btn btn-primary alumni-register-btn mt-4">
            Register
        </button>
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

    {{-- Nominate Alumni of the Week Section --}}
    <div class="text-center mt-5">
        <h2>Nominate Alumni of the Week</h2>
        <form method="POST" action="{{ route('alumni.nominate') }}" class="mt-4">
            @csrf
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <input type="text" name="alumni_name" class="form-control mb-3" placeholder="Alumni Name" required>
                    <input type="text" name="course" class="form-control mb-3" placeholder="Course" required>
                    <input type="number" name="batch" class="form-control mb-3" placeholder="Batch Year" required>
                    <textarea name="message" class="form-control mb-3" rows="3" placeholder="Why do you nominate this alumni? (optional)"></textarea>
                    <button type="submit" class="btn btn-success">Submit Nomination</button>
                </div>
            </div>
        </form>
    </div>

</div>

{{-- Hidden delete form --}}
<form id="deleteForm" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>

<script>
function confirmDelete(id) {
    if (confirm("Are you sure you want to delete this alumni?")) {
        const form = document.getElementById('deleteForm');
        form.action = `/alumni/${id}`;
        form.submit();
    }
}
</script>

{{-- Include Alumni Registration Modal --}}
@include('alumniModal')

{{-- Success alert container --}}
<div id="successAlertContainer"></div>

{{-- Include Add Alumni Modal --}}
@include('addAlumniModal')

{{-- Reopen modal if validation fails --}}
@if($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = new bootstrap.Modal(document.getElementById('alumniModal'));
        modal.show();
    });
</script>
@endif

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Alumni registration button only opens modal
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
@endpush



