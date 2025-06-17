@extends('superadmin.layouts.app')
@section('title', 'Edit Level')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="height: 80vh;">
    <div class="card shadow" style="width: 500px;">
        <div class="card-header text-white" style="background-color: #c0392b;">
            <h5 class="mb-0 text-center">Edit Level</h5>
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

            <form action="{{ route('update_level', $level->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Category Name Display -->
                <div class="mb-3">
                    <label class="form-label">Category Name</label>
                    <input type="text" class="form-control" value="{{ $level->category->name }}" readonly>
                </div>

                <!-- Level Number Input -->
                <div class="mb-3">
                    <label for="level_number" class="form-label">Level Number</label>
                    <input
                        type="number"
                        id="level_number"
                        name="level_number"
                        class="form-control"
                        required
                        min="1"
                        value="{{ $level->number_level }}">
                </div>

                <button type="submit" class="btn text-white d-block mx-auto" style="background-color: #c0392b;">
                    Update
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
