@extends('superadmin.layouts.app')
@section('title', 'Create Level')

@section('content')
<!-- Center form vertically and horizontally -->
<div class="d-flex justify-content-center align-items-center" style="height: 80vh;">
        <div class="card shadow" style="width: 500px;">
            <div class="card-header text-white" style="background-color: #c0392b;">
                <h5 class="mb-0 text-center">Add Level</h5>
            </div>
            <div class="card-body">
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
                @if ($categories->isEmpty())
                    <div class="alert custom-alert-info fade show" role="alert">
                        <i class="fas fa-info-circle me-2"></i>
                        No available categories to assign a level. Either all categories already have levels or none exist.
                    </div>
                @else
                    <form action="{{ route("store_level") }}" method="POST">
                        @csrf

                        <!-- Category Dropdown -->
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Select Category</label>
                            <select id="category_id" name="category_id" class="form-select" required>
                                <option value="" disabled selected>Choose category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Level Number Input -->
                        <div class="mb-3">
                            <label for="level_number" class="form-label">Level Number</label>
                            <input type="number" id="level_number" name="level_number" class="form-control" required min="1">
                        </div>

                        <button type="submit" class="btn text-white d-block mx-auto" style="background-color: #c0392b;">
                            Submit
                        </button>
                    </form>
                @endif
            </div>
        </div>
</div>
@endsection
