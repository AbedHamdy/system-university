@extends('superadmin.layouts.app')
@section('title', 'Create Course')

@section('content')
    <div class="d-flex justify-content-center align-items-center" style="height: 90vh;">
        <div class="card shadow" style="width: 550px;">
            <div class="card-header text-white text-center" style="background-color: #c0392b;">
                <h5 class="mb-0">Add New Course</h5>
            </div>
            <div class="card-body">
                @if (session('success'))
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

                <form action="{{ route('store_course') }}" method="POST">
                    @csrf

                    <!-- Course Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Course Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Enter course name" required>
                    </div>

                    <!-- Doctor Selection -->
                    <div class="mb-3">
                        <label for="doctor_id" class="form-label">Select Doctor</label>
                        <select name="doctor_id" id="doctor_id" class="form-select" required>
                            <option value="">-- Select Doctor --</option>
                            @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}" data-category-id="{{ $doctor->category->id ?? '' }}"
                                    data-category-name="{{ $doctor->category->name ?? '' }}">
                                    {{ $doctor->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Category Display -->
                    <div class="mb-3">
                        <label class="form-label">Doctor's Category</label>
                        <input type="text" id="category_name" class="form-control" readonly>
                    </div>

                    <!-- Level Selection -->
                    <div class="mb-3">
                        <label for="level_id" class="form-label">Select Level</label>
                        <select id="level_id" class="form-select" required>
                            <option value="">-- Select Level --</option>
                            <!-- Levels will be filled dynamically -->
                        </select>
                    </div>

                    <!-- Semester Selection -->
                    <div class="mb-4">
                        <label for="semester_id" class="form-label">Select Semester</label>
                        <select name="semester_id" id="semester_id" class="form-select" required>
                            <option value="">-- Select Semester --</option>
                            <!-- Semesters will be filled dynamically -->
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn text-white d-block mx-auto" style="background-color: #c0392b;">
                        Create Course
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const doctorSelect = document.getElementById("doctor_id");
            const categoryInput = document.getElementById("category_name");
            const levelSelect = document.getElementById("level_id");
            const semesterSelect = document.getElementById("semester_id");

            doctorSelect.addEventListener("change", function() {
                const selectedOption = this.options[this.selectedIndex];
                const categoryId = selectedOption.getAttribute("data-category-id");
                const categoryName = selectedOption.getAttribute("data-category-name");

                // عرض التخصص
                categoryInput.value = categoryName || "";

                // تصفية الليفلز
                levelSelect.innerHTML = '<option value="">-- Select Level --</option>';
                semesterSelect.innerHTML = '<option value="">-- Select Semester --</option>';

                if (categoryId) {
                    fetch(`/get-levels-by-category/${categoryId}`)
                        .then(res => res.json())
                        .then(data => {
                            data.forEach(level => {
                                const option = document.createElement("option");
                                option.value = level.id;
                                option.textContent = `Level ${level.number_level}`;
                                levelSelect.appendChild(option);
                            });
                        });
                }
            });

            levelSelect.addEventListener("change", function() {
                const levelId = this.value;
                semesterSelect.innerHTML = '<option value="">-- Select Semester --</option>';

                if (levelId) {
                    fetch(`/get-semesters-by-level/${levelId}`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(semester => {
                                const option = document.createElement("option");
                                option.value = semester.id;
                                option.textContent =
                                    `Term ${semester.semester_number} - ${semester.year}`;
                                semesterSelect.appendChild(option);
                            });
                        });
                }
            });
        });
    </script>
@endsection
