@extends('superadmin.layouts.app')
@section('title', 'Choose Level for Course Assignment')

@section('content')
    <div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card shadow-lg" style="width: 500px;">
            <div class="card-header text-white text-center" style="background-color: #c0392b;">
                <h4 class="mb-0">Category: {{ $category->name }}</h4>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="mb-3">
                    <label for="level_id" class="form-label">Select Level:</label>
                    <select name="level_id" id="level_id" class="form-select" required onchange="goToAssignCourses(this)">
                        <option value="">-- Choose a Level --</option>
                        @foreach ($levels as $level)
                            <option value="{{ $level->id }}">Level {{ $level->number_level }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    <script>
        function goToAssignCourses(select) {
            const levelId = select.value;
            const categoryId = {{ $category->id }};
            if (levelId) {
                window.location.href = `/select/courses/to/semester?level_id=${levelId}&category_id=${categoryId}`;
            }
        }
    </script>
@endsection
