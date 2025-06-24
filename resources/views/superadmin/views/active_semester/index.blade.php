@extends('superadmin.layouts.app')
@section('title', 'Set Current Term')

@section('content')
    <div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card shadow-lg border-0" style="width: 100%; max-width: 500px;">
            <div class="card-header text-white text-center" style="background: linear-gradient(to right, #c0392b, #8e0e00);">
                <h4 class="mb-0">Activate Current Term</h4>
            </div>
            <div class="card-body bg-light">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
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

                <form method="POST" action="{{ route("store_active_semester") }}">
                    @csrf
                    <div class="mb-3">
                        <label for="semester_number" class="form-label">Select the term to activate:</label>
                        <select name="semester_number" id="semester_number" class="form-select" required>
                            <option value="1">First Semester</option>
                            <option value="2">Second Semester</option>
                            <option value="3">Summer Semester</option>
                        </select>
                    </div>

                    <button type="submit" class="btn text-white w-100"
                            style="background: linear-gradient(to right, #c0392b, #8e0e00);">
                        Activate Selected Term
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
