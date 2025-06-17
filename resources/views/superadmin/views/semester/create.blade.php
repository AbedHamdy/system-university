@extends('superadmin.layouts.app')
@section('title', 'Create Semesters')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if ($categories->isEmpty())
                    <div class="alert custom-alert-info fade show" role="alert">
                        <i class="fas fa-info-circle me-2"></i>
                        No categories available.
                    </div>
                @else
                    <div class="card shadow">
                        <div class="card-header text-white" style="background-color: #c0392b;">
                            <h5 class="mb-0 text-center">Add Semesters</h5>
                        </div>
                        <div class="card-body">
                            {{-- Success Message --}}
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            {{-- Error Message --}}
                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            {{-- Validation Errors --}}
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <form action="{{ route('store_semester') }}" method="POST" id="semesterForm">
                                @csrf

                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Select Category <span
                                            class="text-danger">*</span></label>
                                    <select id="category_id" name="category_id" class="form-select" required>
                                        <option value="" selected disabled>Choose Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="level_id" class="form-label">Select Level <span
                                            class="text-danger">*</span></label>
                                    <select id="level_id" name="level_id" class="form-select" required>
                                        <option value="" selected disabled>Choose Level</option>
                                        @foreach ($categories as $category)
                                            @foreach ($category->levels as $level)
                                                <option value="{{ $level->id }}" data-category="{{ $category->id }}"
                                                    {{ old('level_id') == $level->id ? 'selected' : '' }}>
                                                    Level {{ $level->number_level }} - {{ $category->name }}
                                                </option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>

                                <div id="semesters-wrapper">
                                    @for ($i = 0; $i < 3; $i++)
                                        <div class="semester-item mb-3 border rounded p-3">
                                            <h6>Semester {{ $i + 1 }} <span class="text-danger">*</span></h6>
                                            <input type="hidden" name="semesters[{{ $i }}][semester_number]"
                                                value="{{ $i + 1 }}">
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <label class="form-label">Start Date <span
                                                            class="text-danger">*</span></label>
                                                    <input type="date" name="semesters[{{ $i }}][start_date]"
                                                        class="form-control start-date"
                                                        value="{{ old('semesters.' . $i . '.start_date') }}" required>
                                                </div>
                                                <div class="col">
                                                    <label class="form-label">End Date <span
                                                            class="text-danger">*</span></label>
                                                    <input type="date" name="semesters[{{ $i }}][end_date]"
                                                        class="form-control end-date"
                                                        value="{{ old('semesters.' . $i . '.end_date') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>

                                <div class="mb-4">
                                    <label for="academic_year" class="form-label">Academic Year <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="academic_year" id="academic_year" class="form-control"
                                        placeholder="2024/2025" value="{{ old('academic_year') }}" pattern="\d{4}/\d{4}"
                                        title="Please enter in format: YYYY/YYYY" required>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn text-white" style="background-color: #c0392b;">
                                        <i class="fas fa-save me-1"></i> Submit All
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Category-Level Filter
            const categorySelect = document.getElementById("category_id");
            const levelSelect = document.getElementById("level_id");
            const allLevelOptions = Array.from(levelSelect.options);

            categorySelect.addEventListener("change", function() {
                const selectedCategory = this.value;
                levelSelect.innerHTML = '<option value="" selected disabled>Choose Level</option>';
                allLevelOptions.forEach(option => {
                    if (option.dataset.category === selectedCategory) {
                        levelSelect.appendChild(option.cloneNode(true));
                    }
                });
            });

            // Date Validation
            const form = document.getElementById('semesterForm');
            form.addEventListener('submit', function(e) {
                const startDates = document.querySelectorAll('.start-date');
                const endDates = document.querySelectorAll('.end-date');

                for (let i = 0; i < startDates.length; i++) {
                    const startDate = new Date(startDates[i].value);
                    const endDate = new Date(endDates[i].value);

                    if (endDate < startDate) {
                        e.preventDefault();
                        alert(`Semester ${i + 1}: End date must be after or equal to start date`);
                        return;
                    }
                }

                // Validate Academic Year Format
                const academicYear = document.getElementById('academic_year').value;
                const yearPattern = /^\d{4}\/\d{4}$/;
                if (!yearPattern.test(academicYear)) {
                    e.preventDefault();
                    alert('Academic Year must be in format YYYY/YYYY');
                    return;
                }
            });

            // Set minimum dates for end date based on start date
            const startDateInputs = document.querySelectorAll('.start-date');
            startDateInputs.forEach((input, index) => {
                input.addEventListener('change', function() {
                    const endDateInput = document.querySelectorAll('.end-date')[index];
                    endDateInput.min = this.value;
                });
            });
        });
    </script>
@endsection
