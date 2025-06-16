@extends('superadmin.layouts.app')
@section('title', 'Create Category')

@section('content')
<!-- Center form vertically and horizontally -->
<div class="d-flex justify-content-center align-items-center" style="height: 80vh;">
    <div class="card shadow" style="width: 500px;">
        <div class="card-header text-white" style="background-color: #c0392b;">
            <h5 class="mb-0">Add Name</h5>
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

            <form action="{{ route("store_category") }}" method="POST">
                @csrf

                <!-- Name Field -->
                <div class="mb-3">
                    <label for="name" class="form-label">Category Name</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-control"
                        placeholder="Enter name"
                        required>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn text-white" style="background-color: #c0392b;">
                    Submit
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
