{{-- @dd($courses) --}}
@extends('superadmin.layouts.app')
@section('title', 'Assign Courses to Semesters')

@section('content')
    <div class="d-flex justify-content-center align-items-center flex-column" style="min-height: 85vh;">
        <div class="card shadow-lg w-100" style="max-width: 900px;">
            <div class="card-header text-white text-center" style="background-color: #c0392b;">
                <h4 class="mb-0">Assign Courses to Semesters</h4>
                <small>Level {{ $level->number_level }} - {{ $category->name }}</small>
            </div>

            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Validation Errors --}}
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

            {{-- General Error --}}
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('store_courses_to_semester') }}" method="POST">
                @csrf
                <input type="hidden" name="category_id" value="{{ $category->id }}">
                <input type="hidden" name="level_id" value="{{ $level->id }}">

                <div class="card-body">
                    @if ($courses->isEmpty())
                        <div class="alert alert-warning text-center">
                            <p class="mb-2">⚠️ No courses found for this level. Please add courses first.</p>
                            <a href="{{ route('create_course') }}" class="btn text-white px-5" style="background-color: #c0392b;">
                                ➕ Add New Course
                            </a>
                        </div>
                    @else
                        <div class="row">
                            @foreach ($level->semesters as $semester)
                                <div class="col-md-4 mb-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-header text-white text-center" style="background-color: #c0392b;">
                                            <h6 class="mb-0">Term {{ $semester->semester_number }}</h6>
                                        </div>
                                        <div class="card-body">
                                            @if ($semester->semester_number == 3)
                                                <p class="text-muted text-center">There are no virtual courses for this semester 🚫.</p>
                                            @else
                                                @foreach ($courses as $course)
                                                    <div class="form-check">
                                                        <input class="form-check-input course-checkbox"
                                                            data-course-id="{{ $course->id }}"
                                                            type="checkbox"
                                                            name="semester_courses[{{ $semester->id }}][]"
                                                            value="{{ $course->id }}"
                                                            id="course_{{ $semester->id }}_{{ $course->id }}">
                                                        <label class="form-check-label small"
                                                            for="course_{{ $semester->id }}_{{ $course->id }}">
                                                            {{ $course->name }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn text-white px-5" style="background-color: #c0392b;">
                                Save
                                <i class="fas fa-save me-1"></i>
                            </button>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <script>
        const checkboxes = document.querySelectorAll('.course-checkbox');

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                const courseId = this.dataset.courseId;

                checkboxes.forEach(other => {
                    if (other.dataset.courseId === courseId && other !== this) {
                        other.disabled = this.checked;
                        if (this.checked) {
                            other.checked = false;
                        }
                    }
                });
            });
        });
    </script>
@endsection
