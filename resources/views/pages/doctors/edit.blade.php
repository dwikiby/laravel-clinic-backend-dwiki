@extends('layouts.app')

@section('title', 'Edit User')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Doctors</h1>
                <div class="section-header-breadcrumb ">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{route("doctor.index")}}">Doctor</a></div>
                    <div class="breadcrumb-item">Edit Doctor</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Doctor</h2>
                <div class="card">
                    <form action="{{ route('doctor.update', $doctor) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label>Doctor Name</label>
                                <input type="text"
                                    class="form-control @error('doctor_name')
                                is-invalid
                            @enderror"
                                    name="doctor_name" value="{{ $doctor->doctor_name }}">
                                @error('doctor_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Doctor Email</label>
                                <input type="email"
                                    class="form-control @error('doctor_email')
                                is-invalid
                            @enderror"
                                    name="doctor_email" value="{{ $doctor->doctor_email }}">
                                @error('doctor_email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Doctor SIP</label>
                                <input type="number" class="form-control" name="sip" value="{{ $doctor->sip }}">
                            </div>
                            <div class="form-group">
                                <label>Specialist</label>
                                <input type="text"
                                    class="form-control @error('doctor_specialist')
                                is-invalid
                            @enderror"
                                    name="doctor_specialist"  value="{{ $doctor->doctor_specialist }}">
                                @error('doctor_specialist')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Doctor Phone</label>
                                <input type="number" class="form-control" name="doctor_phone" value="{{ $doctor->doctor_phone }}">
                            </div>
                            <div class="form-group">
                                <label>Doctor Address</label>
                                <input type="text" class="form-control" name="doctor_address" value="{{ $doctor->doctor_address }}">
                            </div>
                            <div class="custom-file">
                                <input type="file" class="form-control" id="customFile" name="doctor_photo" onchange="updateFileName(this);">
                                <label class="custom-file-label" for="customFile">Choose Photo</label>
                            </div>
                            <div class="form-group mt-3">
                                <img
                                id="imagePreview"
                                src="{{ asset($doctor->doctor_photo)}}"
                                alt="Admin"
                                style="width: 100px; height: 100px"
                              />
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Save</button>
                            <a href="{{ route('doctor.index') }}" class="btn btn-light">Cancel</a>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
    <script>
        function updateFileName(input) {
            var fileName = input.files[0].name;
            var label = input.nextElementSibling;
            label.innerText = fileName;

            var preview = document.getElementById('imagePreview');
            
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = "";
                preview.style.display = 'none';
            }
        }
    </script>
</script>    
@endsection

@push('scripts')
@endpush