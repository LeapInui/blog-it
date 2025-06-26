<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-gray-100">
    <div class="flex justify-center items-center min-h-screen">
        <div class="w-full max-w-md bg-gray-800 rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-center mb-6">Welcome to Blog-It</h1>
            
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name Field -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium">Name</label>
                    <input type="text" id="name" name="name" 
                           class="w-full mt-2 px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
                           placeholder="Enter your name" required>
                    @error('name')
                        <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email Field -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium">Email</label>
                    <input type="email" id="email" name="email" 
                           class="w-full mt-2 px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
                           placeholder="Enter your email" required>
                    @error('email')
                        <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium">Password</label>
                    <input type="password" id="password" name="password" 
                           class="w-full mt-2 px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
                           placeholder="Enter your password" required>
                    @error('password')
                        <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password Field -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" 
                           class="w-full mt-2 px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
                           placeholder="Confirm your password" required>
                    @error('password_confirmation')
                        <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="mb-4">
                    <button type="submit" 
                            class="w-full px-4 py-2 bg-indigo-500 text-gray-100 font-semibold rounded-lg hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        Register
                    </button>
                </div>

                <!-- Login Link -->
                <div class="text-center">
                    <p class="text-sm">Already have an account?
                        <a href="{{ route('login') }}" class="text-indigo-400 hover:underline">Login here</a>.
                    </p>
                </div>
            </form>            
        </div>
    </div>
</body>
</html>
