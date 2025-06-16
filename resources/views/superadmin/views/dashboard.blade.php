@extends('superadmin.layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="row mt-2 g-4 content-wrapper"> <!-- g-3 تضيف مسافات بين الأعمدة والصفوف -->
    <!-- Doctors Card -->
    <div class="col-12 col-md-4">
        <div class="card stats-card shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="stats-title">Total Doctors</h6>
                        <h2 class="stats-number">{{ $doctors }}</h2>
                    </div>
                    <div class="stats-icon fs-2 text-primary">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Admins Card -->
    <div class="col-12 col-md-4">
        <div class="card stats-card shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="stats-title">Total Admins</h6>
                        <h2 class="stats-number">{{ $admins }}</h2>
                    </div>
                    <div class="stats-icon fs-2 text-success">
                        <i class="fas fa-user-shield"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Students Card -->
    <div class="col-12 col-md-4">
        <div class="card stats-card shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="stats-title">Total Students</h6>
                        <h2 class="stats-number">{{ $students }}</h2>
                    </div>
                    <div class="stats-icon fs-2 text-warning">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
