@extends('superadmin.layouts.app')
@section('title', 'Semester Details')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header text-white" style="background-color: #c0392b;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            Semester {{ $validated['semester'] }} - Academic Year {{ $validated['year'] }}
                        </h5>
                        <a href="{{ route("all_semesters") }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left me-1"></i> Back
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if($semesterData->isEmpty())
                        <div class="alert alert-info text-center">
                            <i class="fas fa-info-circle me-2"></i>
                            No data found for this semester.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Level</th>
                                        <th>Category</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($semesterData as $semester)
                                        <tr>
                                            <td>Level {{ $semester->level->number_level }}</td>
                                            <td>{{ $semester->level->category->name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($semester->start_date)->format('Y-m-d') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($semester->end_date)->format('Y-m-d') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>


                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .table-dark {
        background-color: #c0392b !important;
    }

    .btn-warning {
        background-color: #f39c12;
        border-color: #f39c12;
        color: white;
    }

    .btn-warning:hover {
        background-color: #d68910;
        border-color: #d68910;
        color: white;
    }

    .btn-danger {
        background-color: #e74c3c;
        border-color: #e74c3c;
    }

    .btn-danger:hover {
        background-color: #c0392b;
        border-color: #c0392b;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(192, 57, 43, 0.1);
    }
</style>
@endpush
@endsection
