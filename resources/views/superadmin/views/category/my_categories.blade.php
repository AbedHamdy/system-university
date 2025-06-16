@extends('superadmin.layouts.app')
@section('title', 'My Categories')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-5 text-center gradient-title">My Categories</h2>
        @if(session('success'))
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

        @if ($categories->isEmpty())
            <div class="alert custom-alert-info fade show" role="alert">
                <i class="fas fa-info-circle me-2"></i>
                No categories found.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered gradient-table align-middle">
                    <thead>
                        <tr class="gradient-header">
                            <th>#</th>
                            <th>Category Name</th>
                            <th>Created By (Super Admin)</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $index => $category)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->superAdmin->name ?? 'Unknown' }}</td>
                                <td>{{ $category->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <a href="{{ route('edit_category', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                    <form action="{{ route('delete_category', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
