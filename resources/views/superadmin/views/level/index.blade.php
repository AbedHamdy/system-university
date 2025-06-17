{{-- {{ dd($categories) }} --}}
@extends('superadmin.layouts.app')
@section('title', 'All Levels')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-5 text-center gradient-title">All Levels</h2>

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
                            <th>Level Number</th>
                            <th>Created By (Super Admin)</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $index => $category)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->levels ? $category->levels_count : '-' }}</td>
                                <td>{{ $category->superAdmin->name ?? 'Unknown' }}</td>
                                <td>{{ $category->created_at->format('Y-m-d') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
