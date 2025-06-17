@extends('superadmin.layouts.app')
@section('title', 'View Semesters')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header text-white" style="background-color: #c0392b;">
                        <h5 class="mb-0 text-center">View Semesters</h5>
                    </div>
                    <div class="card-body">
                        {{-- Success Message --}}
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route("show_semesters") }}" method="GET" id="semesterFilterForm">
                            <div class="mb-3">
                                <label for="academic_year" class="form-label">Select Academic Year <span class="text-danger">*</span></label>
                                <select id="academic_year" name="year" class="form-select" required>
                                    <option value="" selected disabled>Choose Academic Year</option>
                                    @foreach ($yearsWithSemesters as $year => $semesters)
                                        <option value="{{ $year }}" data-semesters="{{ json_encode($semesters) }}">
                                            {{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4" id="semesterDiv" style="display: none;">
                                <label for="semester" class="form-label">Select Semester <span class="text-danger">*</span></label>
                                <select id="semester" name="semester" class="form-select" required>
                                    <option value="" selected disabled>Choose Semester</option>
                                </select>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn text-white" style="background-color: #c0392b; display: none;" id="goButton">
                                    <i class="fas fa-search me-1"></i> View Details
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const yearSelect = document.getElementById("academic_year");
            const semesterDiv = document.getElementById("semesterDiv");
            const semesterSelect = document.getElementById("semester");
            const goButton = document.getElementById("goButton");

            // Year Change Handler
            yearSelect.addEventListener("change", function() {
                const selectedOption = this.options[this.selectedIndex];
                const semesters = selectedOption.dataset.semesters
                    ? JSON.parse(selectedOption.dataset.semesters)
                    : [];

                // Reset semester select
                semesterSelect.innerHTML = '<option value="" selected disabled>Choose Semester</option>';

                // Hide semester div and button initially
                semesterDiv.style.display = 'none';
                goButton.style.display = 'none';

                if (this.value) {
                    // Add semester options
                    semesters.forEach(semesterNumber => {
                        const option = document.createElement('option');
                        option.value = semesterNumber;
                        option.textContent = `Semester ${semesterNumber}`;
                        semesterSelect.appendChild(option);
                    });

                    // Show semester div
                    semesterDiv.style.display = 'block';
                }
            });

            // Semester Change Handler
            semesterSelect.addEventListener("change", function() {
                goButton.style.display = this.value ? 'inline-block' : 'none';
            });
        });
    </script>

    <style>
        .form-select {
            border-color: #c0392b;
        }

        .form-select:focus {
            border-color: #c0392b;
            box-shadow: 0 0 0 0.2rem rgba(192, 57, 43, 0.25);
        }

        .btn:hover {
            background-color: #a33225 !important;
        }
    </style>
@endsection
