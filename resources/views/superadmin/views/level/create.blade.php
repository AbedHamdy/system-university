{{-- @dd($category) --}}
@extends('superadmin.layouts.app')
@section('title', 'Create Category with Levels')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center align-items-center" style="height: 70vh;">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header text-white text-center" style="background-color: #c0392b;">
                    <h5 class="mb-0">Create Category & Levels</h5>
                </div>
                <div class="card-body">
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

                    <form action="{{ route('store_level') }}" method="POST">
                        @csrf

                        {{-- اسم التخصص --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Category Name</label>
                            <input type="text" id="name" class="form-control" value="{{ $category->name }}" readonly>
                            <input type="hidden" name="category_id" value="{{ $category->id }}">
                        </div>

                        {{-- عدد الليفلز --}}
                        <div class="mb-4">
                            <label for="level_number" class="form-label">Number of Levels <span class="text-danger">*</span></label>
                            <input type="number" id="level_number" name="level_number" class="form-control" min="1" required>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn text-white" style="background-color: #c0392b;">
                                <i class="fas fa-save me-1"></i> Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
