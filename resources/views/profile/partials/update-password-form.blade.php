<section>
    <header>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Ensure your account uses a secure password.
        </p>
    </header>

    <!-- Password Update Form -->
    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div>
            <label for="update_password_current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Current Password
            </label>
            <input id="update_password_current_password" name="current_password" type="password"
                class="mt-1 block w-full px-4 py-2 bg-gray-700 text-gray-100 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                autocomplete="current-password">
            @if ($errors->updatePassword->has('current_password'))
                <p class="text-sm text-red-600 mt-2">{{ $errors->updatePassword->first('current_password') }}</p>
            @endif
        </div>

        <!-- New Password -->
        <div>
            <label for="update_password_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                New Password
            </label>
            <input id="update_password_password" name="password" type="password"
                class="mt-1 block w-full px-4 py-2 bg-gray-700 text-gray-100 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                autocomplete="new-password">
            @if ($errors->updatePassword->has('password'))
                <p class="text-sm text-red-600 mt-2">{{ $errors->updatePassword->first('password') }}</p>
            @endif
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Confirm Password
            </label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                class="mt-1 block w-full px-4 py-2 bg-gray-700 text-gray-100 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                autocomplete="new-password">
            @if ($errors->updatePassword->has('password_confirmation'))
                <p class="text-sm text-red-600 mt-2">{{ $errors->updatePassword->first('password_confirmation') }}</p>
            @endif
        </div>

        <!-- Save Button and Status -->
        <div class="flex items-center gap-4">
            <button type="submit"
                class="px-4 py-2 bg-indigo-500 text-gray-100 font-semibold rounded-lg hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Save
            </button>

            @if (session('status') === 'password-updated')
                <p class="text-sm text-gray-600 dark:text-gray-400 animate-fade-in">
                    Saved
                </p>
            @endif
        </div>
    </form>
</section>
