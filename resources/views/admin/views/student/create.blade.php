@extends("admin.layouts.app")
@section("title", "Create Student")
@section("content")
    <div class="container mt-5">


        <div class="card shadow border-0">
            <div class="card-header bg-orange text-white text-center">
                <h5 class="mb-0">Add New Student</h5>
            </div>
            <div class="card-body px-4 py-4">
                {{-- Success Message --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">×</button>
                    </div>
                @endif

                {{-- Error Messages --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        <strong>There were some errors:</strong>
                        <ul class="mb-0 mt-2 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">×</button>
                    </div>
                @endif

                {{-- Custom Error Session --}}
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        <strong>Error!</strong> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">×</button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form action="{{ route('store_student') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- Full Name --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" name="name" id="name" class="form-control" >
                    </div>
                    {{-- Email Address --}}
                    {{-- <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" name="email" id="email" class="form-control" >
                    </div> --}}
                    {{-- Password --}}
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" >
                    </div>
                    {{-- Profile Image --}}
                    <div class="mb-3">
                        <label for="image" class="form-label">Profile Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    {{-- Student Code --}}
                    <div class="mb-3">
                        <label for="code" class="form-label">Student Code</label>
                        @if ($code == 0)
                            <input type="text" name="code" id="code" class="form-control" >
                            <small class="text-muted">This is the first student to be added. Please assign a code.</small>
                        @else
                            <input type="text" name="code" id="code" class="form-control" value="{{ $code }}" readonly>
                            <small class="text-muted">The next student code will be: {{ $code }}</small>
                        @endif
                    </div>
                    {{-- National ID --}}
                    <div class="mb-3">
                        <label for="national_id" class="form-label">National ID</label>
                        <input type="text" name="national_id" id="national_id" class="form-control">
                    </div>
                    {{-- Phone Number --}}
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" name="phone" id="phone" class="form-control">
                    </div>
                    {{-- Address --}}
                    <div class="mb-4">
                        <label for="address" class="form-label">Address</label>
                        <textarea name="address" id="address" rows="3" class="form-control"></textarea>
                    </div>
                    {{-- Submit Button --}}
                    <div class="text-center">
                        <button type="submit" class="btn btn-orange px-4">Create Student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
