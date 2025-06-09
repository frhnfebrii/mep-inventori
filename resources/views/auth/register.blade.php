<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">

    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Register</h1>

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block font-semibold mb-1">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="w-full border px-3 py-2 rounded @error('name') border-red-500 @enderror" required autofocus>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block font-semibold mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    class="w-full border px-3 py-2 rounded @error('email') border-red-500 @enderror" required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block font-semibold mb-1">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full border px-3 py-2 rounded @error('password') border-red-500 @enderror" required>
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block font-semibold mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="w-full border px-3 py-2 rounded" required>
            </div>

            <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition">
                Register
            </button>

            <p class="mt-4 text-center text-sm text-gray-600">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login di sini</a>
            </p>
        </form>
    </div>

</body>
</html>
