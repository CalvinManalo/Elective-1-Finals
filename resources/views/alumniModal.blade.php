{{-- ALUMNI REGISTRATION MODAL --}}
<div class="modal fade" id="alumniModal" tabindex="-1" aria-labelledby="alumniModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="alumniForm" class="modal-content" method="POST" action="{{ route('alumni.register') }}" enctype="multipart/form-data">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title" id="alumniModalLabel">Alumni Card Registration</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" id="name" name="name" class="form-control"
                        value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <label for="id_number" class="form-label">Alumni ID Number</label>
                    <input type="text" id="id_number" name="id_number" class="form-control"
                        value="{{ old('id_number') }}" required>
                </div>

                <div class="mb-3">
                    <label for="course" class="form-label">Course</label>
                    <input type="text" id="course" name="course" class="form-control"
                        value="{{ old('course') }}" required>
                </div>

                <div class="mb-3">
                    <label for="batch" class="form-label">Year Graduated</label>
                    <input type="number" id="batch" name="batch" class="form-control"
                        value="{{ old('batch') }}" required>
                </div>

                <div class="mb-3">
                    <label for="photo" class="form-label">Upload Photo</label>
                    <input type="file" id="photo" name="photo" class="form-control" accept="image/*" required>
                </div>

            </div>

            <div class="modal-footer">
                {{-- Original Register button (submits normally) --}}
                <button type="submit" class="btn btn-success">Register</button>

                {{-- New AJAX-only button --}}
                <button type="button" id="modalSubmitOnlyBtn" class="btn btn-success">
                    Submit Only
                </button>

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>

        </form>
    </div>
</div>

{{-- Global Success Message --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show mt-3 mx-3" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

{{-- Global Error Messages --}}
@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show mt-3 mx-3" role="alert">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif



