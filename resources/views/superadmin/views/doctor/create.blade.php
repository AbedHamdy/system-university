@extends('superadmin.layouts.app')
@section('title', 'Create Something')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0">Create New Item</h5>
        </div>
        <div class="card-body">
            <form action="#" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <!-- Image -->
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>

                <!-- Category -->
                {{-- <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select name="category_id" class="form-select" required>
                        <option value="" disabled selected>Select a Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div> --}}

                <!-- Super Admin -->
                {{-- <div class="mb-3">
                    <label for="super_admin_id" class="form-label">Super Admin</label>
                    <select name="super_admin_id" class="form-select" required>
                        <option value="" disabled selected>Select a Super Admin</option>
                        @foreach ($superAdmins as $admin)
                            <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                        @endforeach
                    </select>
                </div> --}}

                <!-- Submit -->
                <button type="submit" class="btn btn-danger">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
