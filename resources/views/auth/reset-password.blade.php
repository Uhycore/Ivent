<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-base-200 min-h-screen flex items-center justify-center p-4">
    <div class="card w-full max-w-md bg-base-100 shadow-xl">
        <div class="card-body">
            <h2 class="card-title text-2xl font-bold text-center mb-6">Reset Password</h2>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">

                <div class="form-control w-full mb-4">
                    <label class="label">
                        <span class="label-text font-medium">Password Baru</span>
                    </label>
                    <input type="password" name="password" required class="input input-bordered w-full"
                        placeholder="Masukkan password baru" />
                    <label class="label">
                        <span class="label-text-alt text-error">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </span>
                    </label>
                </div>

                <div class="form-control w-full mb-6">
                    <label class="label">
                        <span class="label-text font-medium">Konfirmasi Password</span>
                    </label>
                    <input type="password" name="password_confirmation" required class="input input-bordered w-full"
                        placeholder="Konfirmasi password baru" />
                    <label class="label">
                        <span class="label-text-alt text-error">
                            @error('password_confirmation')
                                {{ $message }}
                            @enderror
                        </span>
                    </label>
                </div>

                <div class="form-control mt-4">
                    <button type="submit" class="btn btn-primary w-full">Reset Password</button>
                </div>
            </form>

            <div class="text-center mt-4">
                <a href="{{ route('login') }}" class="link link-hover text-sm">Kembali ke halaman login</a>
            </div>
        </div>
    </div>
</body>

</html>
