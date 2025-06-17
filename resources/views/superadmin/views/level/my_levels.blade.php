@extends('superadmin.layouts.app')
@section('title', 'All Levels')

@section('content')
<div class="container mt-5">
    <h2 class="mb-5 text-center gradient-title">All Levels</h2>

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
            No levels found.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered gradient-table align-middle">
                <thead>
                    <tr class="gradient-header">
                        <th>#</th>
                        <th>Category Name</th>
                        <th>Level Count</th>
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
                            <td>{{ $category->levels_count }}</td>
                            <td>{{ $category->superAdmin->name ?? 'Unknown' }}</td>
                            <td>{{ $category->created_at->format('Y-m-d') }}</td>
                            <td>
                                @if ($category->levels_count > 0)
                                    <form action="{{ route('delete_level', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete all levels for this category?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            Delete Levels
                                        </button>
                                    </form>
                                @else
                                    <span class="text-muted">No levels</span>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
