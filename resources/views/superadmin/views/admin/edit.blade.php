@extends('superadmin.layouts.app')
@section('title', 'Edit Admin')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <!-- Header -->
            <div class="card-header text-white text-center" style="background: linear-gradient(145deg, #8B0000, #800000);">
                <h5 class="mb-0">Edit Admin</h5>
            </div>

            <!-- Body -->
            <div class="card-body">
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
                
                <form action="{{ route('update_admin', $admin->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" value="{{ old('name', $admin->name) }}" class="form-control"
                            required>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email', $admin->email) }}" class="form-control"
                            required>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <!-- Category -->
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select name="category_id" class="form-select" required>
                            <option value="" disabled>Select a Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $admin->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- New Image -->
                    <div class="mb-3">
                        <label class="form-label">Change Profile Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn text-white d-block mx-auto"
                        style="background: linear-gradient(145deg, #8B0000, #800000);">
                        Update Admin
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
