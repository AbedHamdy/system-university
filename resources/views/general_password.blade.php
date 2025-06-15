<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>General Password | UMS</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f5f5f5;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background: #c0392b;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-header py-3">
                        <h5 class="mb-0 text-center">Enter General Password</h5>
                    </div>
                    <div class="card-body p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form action="{{ route("general_password") }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="general_password" class="form-label">General Password</label>
                                <div class="input-group">
                                    <input type="password"
                                           autocomplete="off"
                                           class="form-control @error('general_password') is-invalid @enderror"
                                           id="general_password"
                                           name="general_password"
                                           required
                                           autofocus>
                                    <button class="btn btn-outline-secondary"
                                            type="button"
                                            id="togglePassword">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                {{-- @error('general_password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror --}}
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    Verify Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const password = document.getElementById('general_password');
            const icon = this.querySelector('i');

            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    </script>
</body>
</html>
