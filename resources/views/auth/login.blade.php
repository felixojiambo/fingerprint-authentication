<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* General container styling */
        .container {
            max-width: 960px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Form group styling */
        .form-group {
            margin-bottom: 15px;
        }

        /* Label styling */
        .col-form-label {
            font-weight: bold;
        }

        /* Input field styling */
        .form-control {
            border-radius: 0;
            border: 1px solid #ced4da;
            padding: 10px;
        }

        /* File input styling */
        .form-control-file {
            border-radius: 0;
            border: 1px solid #ced4da;
        }

        /* Submit button styling */
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 0;
            cursor: pointer;
        }

        /* Checkbox styling */
        .form-check-input {
            margin-top: 0.3rem;
        }

        /* Link styling */
        .btn-link {
            color: #007bff;
            text-decoration: none;
        }

        /* Invalid feedback styling */
        .invalid-feedback {
            color: #dc3545;
        }

        /* Form text styling */
        .form-text {
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Authentication Method') }}</label>

                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="auth_method" id="auth_email_password" value="email_password" checked>
                                    <label class="form-check-label" for="auth_email_password">
                                        {{ __('Email/Password') }}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="auth_method" id="auth_fingerprint" value="fingerprint">
                                    <label class="form-check-label" for="auth_fingerprint">
                                        {{ __('Fingerprint') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fingerprint_image" class="col-md-4 col-form-label text-md-right">{{ __('Fingerprint Image') }}</label>

                            <div class="col-md-6">
                                <input id="fingerprint_image" type="file" class="form-control-file" name="fingerprint_image" accept="image/*">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
