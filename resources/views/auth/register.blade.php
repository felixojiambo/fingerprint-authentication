<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Fingerprint capture field -->
                        <div class="form-group row">
                            <label for="fingerprint" class="col-md-4 col-form-label text-md-right">{{ __('Fingerprint') }}</label>

                            <div class="col-md-6">
                                <input type="hidden" id="hidden_fingerprint" name="hidden_fingerprint" value="">
                                <input id="fingerprintCapture" type="file" class="form-control-file @error('fingerprint_image') is-invalid @enderror" name="fingerprint_image" accept=".bmp,.jpg,.jpeg,.png" required>

                                <small class="form-text text-muted">Please upload an image of your fingerprint.</small>

                                @error('fingerprint')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <script src="{{ asset('js/fingerprint.js') }}"></script>
</body>
</html>
