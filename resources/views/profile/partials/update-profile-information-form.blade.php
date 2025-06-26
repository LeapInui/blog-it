<section>
    <header>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Update account profile information.
        </p>
    </header>

    <!-- Verification Form -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}" class="hidden">
        @csrf
    </form>

    <!-- Profile Update Form -->
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Name Field -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Name
            </label>
            <input id="name" name="name" type="text" 
                class="mt-1 block w-full px-4 py-2 bg-gray-700 text-gray-100 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                value="{{ old('name', $user->name) }}" required autocomplete="name">
            @error('name')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email Field -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Email
            </label>
            <input id="email" name="email" type="email" 
                class="mt-1 block w-full px-4 py-2 bg-gray-700 text-gray-100 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm text-gray-800 dark:text-gray-200">
                        Your email address is unverified.'
                        <button form="send-verification" 
                            class="underline text-sm text-indigo-400 hover:text-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            Click here to re-send the verification email.
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            A new verification link has been sent to your email address.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Save Button and Status -->
        <div class="flex items-center gap-4">
            <button type="submit" 
                class="px-4 py-2 bg-indigo-500 text-gray-100 font-semibold rounded-lg hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Save
            </button>

            @if (session('status') === 'profile-updated')
                <p class="text-sm text-gray-600 dark:text-gray-400 animate-fade-in">
                    Saved
                </p>
            @endif
        </div>
    </form>
</section>
