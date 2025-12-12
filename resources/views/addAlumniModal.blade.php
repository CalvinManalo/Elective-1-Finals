{{-- Add Alumni Modal --}}
<div class="modal fade" id="addAlumniModal" tabindex="-1" aria-labelledby="addAlumniModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            {{-- Modal Header --}}
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="addAlumniModalLabel">Add Alumni</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            {{-- Modal Body --}}
            <div class="modal-body">
                <form method="POST" action="{{ route('alumni.register') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label for="id_number" class="form-label">ID Number</label>
                            <input type="text" id="id_number" name="id_number" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label for="course" class="form-label">Course</label>
                            <input type="text" id="course" name="course" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label for="batch" class="form-label">Batch Year</label>
                            <input type="number" id="batch" name="batch" class="form-control" required>
                        </div>
                    </div>

                    {{-- Modal Footer --}}
                    <div class="modal-footer mt-4">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Save Alumni</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>



