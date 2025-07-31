<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .auth-container {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">
    <div class="min-h-screen flex items-center justify-center auth-container">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">

            <!-- Flash & Validation Messages -->


            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-800">Admin Login</h2>
                <p class="text-gray-600">Welcome back! Please login to continue</p>
            </div>
            <x-alert />
            <form method="POST" action="{{ route('login.verify') }}">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="login-username">Username</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="fas fa-at text-gray-400"></i>
                        </span>
                        <input type="text" name="username" id="login-username" value="{{ old('username') }}"
                            class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="johndoe@example.com" required>
                    </div>
                    @error('username')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 mb-2" for="login-password">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="fas fa-lock text-gray-400"></i>
                        </span>
                        <input type="password" name="password" id="login-password"
                            class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="••••••••" required>
                    </div>
                    @error('password')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember"
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
                    </div>
                    <div>
                        <a href="#" class="text-sm text-blue-600 hover:underline">Forgot password?</a>
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-200 mb-4">
                    Login
                </button>

                <div class="text-center">
                    <p class="text-gray-600">Don't have an account?
                        <a href="{{ route('signup') }}" class="text-blue-600 hover:underline">Sign up here</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
