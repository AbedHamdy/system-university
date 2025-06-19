@extends('superadmin.layouts.app')
@section('title', 'Select Category')

@section('content')
    <div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card shadow-lg" style="width: 500px;">
            <div class="card-header text-white text-center" style="background-color: #c0392b;">
                <h4 class="mb-0">Select a Category to View Its Levels</h4>
            </div>
            <div class="card-body">
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

                <div class="mb-3">
                    <label for="category_id" class="form-label">Choose Category:</label>
                    <select name="category_id" id="category_id" class="form-select" required
                        onchange="redirectToLevels(this)">
                        <option value="">-- Select a Category --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    <script>
        function redirectToLevels(select) {
            const categoryId = select.value;
            if (categoryId) {
                window.location.href = `/view/level/for/category/${categoryId}`;
            }
        }
    </script>
@endsection
