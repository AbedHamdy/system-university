@extends('superadmin.layouts.app')
@section('title', 'Edit Levels')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center align-items-center" style="height: 77.5vh;">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header text-white text-center" style="background-color: #c0392b;">
                    <h5 class="mb-0">Edit Levels for Category: {{ $category->name }}</h5>
                </div>
                <div class="card-body">

                    {{-- Success and error messages --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

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

                    {{-- Level edit form --}}
                    <form action="{{ route('update_level', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Category name --}}
                        <div class="mb-3">
                            <label class="form-label">Category Name</label>
                            <input type="text" class="form-control" value="{{ $category->name }}" readonly>
                            <input type="hidden" name="category_id" value="{{ $category->id }}">
                        </div>

                        {{-- Current number of levels --}}
                        <div class="mb-3">
                            <label class="form-label">Current Number of Levels</label>
                            <input type="number" class="form-control" value="{{ $category->levels_count }}" readonly>
                        </div>

                        {{-- New number of levels --}}
                        <div class="mb-4">
                            <label for="level_number" class="form-label">New Number of Levels <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="level_number" name="level_number"
                                   min="1" max="10" required>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn text-white" style="background-color: #c0392b;">
                                <i class="fas fa-save me-1"></i> Update Levels
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
