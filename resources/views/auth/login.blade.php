<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-gray-100">
    <div class="flex justify-center items-center min-h-screen">
        <div class="w-full max-w-md bg-gray-800 rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-center mb-6">Welcome to Blog-It</h1>
            
            <form method="POST" action="{{ route('login') }}">
                @csrf

                @if ($errors->has('email'))
                    <div class="bg-red-500 text-white p-4 mb-4 rounded-lg">
                        <p>{{ $errors->first('email') }}</p>
                    </div>
                @endif


                <!-- Email Field -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium">Email</label>
                    <input type="email" id="email" name="email" 
                           class="w-full mt-2 px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
                           placeholder="Enter your email" required>
                </div>

                <!-- Password Field -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium">Password</label>
                    <input type="password" id="password" name="password" 
                           class="w-full mt-2 px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
                           placeholder="Enter your password" required>
                </div>

                <!-- Submit Button -->
                <div class="mb-4">
                    <button type="submit" 
                            class="w-full px-4 py-2 bg-indigo-500 text-gray-100 font-semibold rounded-lg hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        Login
                    </button>
                </div>

                <!-- Forgot Password Link -->
                @if (Route::has('password.request'))
                    <div class="text-center mb-4">
                        <a href="{{ route('password.request') }}" 
                        class="text-sm text-indigo-400 hover:underline">
                        Forgot your password?
                        </a>
                    </div>
                @endif

                <!-- Register Link -->
                <div class="text-center">
                    <p class="text-sm">Don't have an account? 
                        <a href="{{ route('register') }}" class="text-indigo-400 hover:underline">Register here</a>.
                    </p>
                </div>
            </form>            
        </div>
    </div>
</body>
</html>
