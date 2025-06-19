@extends('superadmin.layouts.app')
@section('title', 'All Courses')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4 text-center gradient-title">All Courses</h2>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('all_courses') }}" class="row mb-4 justify-content-center">
            <div class="col-md-4">
                <select name="category_id" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Filter by Category --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($courses->isEmpty())
            <div class="alert custom-alert-info fade show" role="alert">
                <i class="fas fa-info-circle me-2"></i>
                No courses found.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered gradient-table align-middle text-center">
                    <thead>
                        <tr class="gradient-header">
                            <th>#</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Level</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($courses as $index => $course)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $course->name }}</td>
                                <td>{{ $course->category->name ?? 'Not Set' }}</td>
                                <td>{{ $course->level->name ?? 'Not Set' }}</td>
                                <td>
                                    <!-- Edit button -->
                                    {{-- <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-sm btn-warning me-1">
                                        <i class="fas fa-edit"></i> Edit
                                    </a> --}}

                                    <!-- Delete form -->
                                    <form action="{{ route('delete_course', $course->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this course?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination-container">
                <div class="d-flex justify-content-end">
                    {{ $courses->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
@endsection
