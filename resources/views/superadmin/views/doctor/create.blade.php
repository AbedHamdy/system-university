{{-- @dd($categories) --}}
@extends('superadmin.layouts.app')
@section('title', 'Create Doctor')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-danger text-white" style="background: linear-gradient(145deg, #8B0000, #800000);">
            <h5 class="mb-0 text-center">Create Doctor</h5>
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
            <form action="{{ route("store_doctor") }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}"  placeholder="Enter doctor name" required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"  placeholder="Enter doctor email" required>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter doctor password" required>
                </div>

                <!-- Image -->
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>

                <!-- Category -->
                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select name="category_id" class="form-select" required>
                        <option value="" disabled selected>Select a Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn btn-danger d-block mx-auto"
                    style="background: linear-gradient(145deg, #8B0000, #800000);">
                    Create
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
