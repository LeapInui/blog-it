<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-gray-100">
    <div class="flex justify-center items-center min-h-screen">
        <div class="w-full max-w-md bg-gray-800 rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-center mb-6">Forgot Your Password?</h1>
            
            <p class="mb-4 text-sm text-gray-600">
                Enter your email address so that we can email you a link to reset your password.
            </p>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Field -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium">Email</label>
                    <input type="email" id="email" name="email" 
                           class="w-full mt-2 px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
                           placeholder="Enter your email" required>
                    @error('email')
                        <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="mb-4">
                    <button type="submit" 
                            class="w-full px-4 py-2 bg-indigo-500 text-gray-100 font-semibold rounded-lg hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        Email Password Reset Link
                    </button>
                </div>

                <!-- Back to Login Link -->
                <div class="text-center">
                    <p class="text-sm">Remembered your password? 
                        <a href="{{ route('login') }}" class="text-indigo-400 hover:underline">Login here</a>.
                    </p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
