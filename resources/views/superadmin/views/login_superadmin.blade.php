<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Login | UMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #c0392b;
            --primary-dark: #8c2922;
            --primary-darker: #591a16;
            --hover-color: #a82e23;
            --text-light: #ffffff;
        }

        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f5e8e8;
        }

        .login-card {
            max-width: 400px;
            width: 90%;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(192, 57, 43, 0.1);
        }

        .card-header {
            background: linear-gradient(to right, var(--primary-color), var(--primary-darker));
            color: var(--text-light);
            padding: 1.5rem;
            border-radius: 10px 10px 0 0;
            text-align: center;
        }

        .card-body {
            padding: 2rem;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(192, 57, 43, 0.25);
        }

        .btn-primary {
            background: linear-gradient(to right, var(--primary-color), var(--primary-darker));
            border: none;
            padding: 0.75rem;
        }

        .btn-primary:hover {
            background: var(--hover-color);
            transform: translateY(-1px);
        }

        .input-group-text {
            background: linear-gradient(to right, var(--primary-color), var(--primary-darker));
            color: var(--text-light);
            border: none;
        }

        .alert {
            border-radius: 5px;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="card login-card">
        <div class="card-header">
            <h4 class="mb-0">Super Admin Login</h4>
        </div>
        <div class="card-body">
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

            <form method="POST" action="{{ route("login_super_admin") }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               id="email"
                               name="email"
                               value="{{ old('email') }}"
                               required
                               autofocus>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               id="password"
                               name="password"
                               required>
                        <button class="btn btn-outline-secondary"
                                type="button"
                                id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <input type="hidden" name="role" value="SuperAdmin">

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt me-2"></i> Login
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const password = document.getElementById('password');
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
