@extends('superadmin.layouts.app')
@section('title', 'Create Course')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="height: 90vh;">
    <div class="card shadow" style="width: 550px;">
        <div class="card-header text-white text-center" style="background-color: #c0392b;">
            <h5 class="mb-0">Add New Course</h5>
        </div>
        <div class="card-body">
            {{-- Success Message --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

             @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('store_course') }}" method="POST">
                @csrf

                {{-- Course Name --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Course Name</label>
                    <input type="text" class="form-control" id="name" name="name"
                        placeholder="Enter course name" required>
                </div>

                {{-- Category Dropdown --}}
                <div class="mb-3">
                    <label for="category_id" class="form-label">Select Category</label>
                    <select name="category_id" id="category_id" class="form-select" required>
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn text-white d-block mx-auto" style="background-color: #c0392b;">
                    Create Course
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
