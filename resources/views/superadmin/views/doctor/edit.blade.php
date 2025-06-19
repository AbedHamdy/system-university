@extends('superadmin.layouts.app')
@section('title', 'Edit Doctor')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-danger text-white" style="background: linear-gradient(145deg, #8B0000, #800000);">
                <h5 class="mb-0 text-center">Edit Doctor</h5>
            </div>
            <div class="card-body">
                @if (session('success'))
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
                <form action="{{ route('update_doctor', $doctor->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control"
                            value="{{ old('name', $doctor->name) }}"
                            placeholder="Enter doctor name" >
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control"
                            value="{{ old('email', $doctor->email) }}"
                            placeholder="Enter doctor email" >
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control"
                            placeholder="Enter new password">
                    </div>

                    <!-- Image -->
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                        {{-- @if($doctor->image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $doctor->image) }}"
                                     alt="Current doctor image"
                                     class="img-thumbnail"
                                     style="max-height: 100px">
                            </div>
                        @endif --}}
                    </div>

                    <!-- Category -->
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select name="category_id" class="form-select" >
                            <option value="" disabled>Select a Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $doctor->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn btn-danger d-block mx-auto" style="background: linear-gradient(145deg, #8B0000, #800000);">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
