{{-- resources/views/superadmin/views/assign/add_courses.blade.php --}}
@extends('superadmin.layouts.app')
@section('title', 'Assign Courses to Level')

@section('content')
    <div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card shadow-lg" style="width: 600px;">
            <div class="card-header text-white text-center" style="background-color: #c0392b;">
                <h4 class="mb-0">Assign Courses to Level</h4>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Category:</strong> {{ $category->name }} <br>
                    <strong>Level:</strong> Level {{ $level->number_level }}
                </div>
                {{-- messages --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form action="{{ route("assign_courses") }}" method="POST">
                    @csrf
                    <input type="hidden" name="level_id" value="{{ $level->id }}">

                    <div class="mb-3">
                        <label for="courses" class="form-label">Choose Courses:</label>
                        <select name="courses[]" id="courses" class="form-select" multiple required>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                            @endforeach
                        </select>
                        <small class="text-muted">You can choose multiple courses</small>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary w-100" style="background-color: #c0392b;">
                            Assign Selected Courses
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- Select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#courses').select2({
                placeholder: "Select one or more courses",
                width: '100%',
                allowClear: true
            });
        });
    </script>
@endsection

