<section class="space-y-6">
    <header>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Once your account is deleted, all of its resources and data will be permanently deleted.
        </p>
    </header>

    <!-- Delete Account Button -->
    <button 
        type="button" 
        class="px-4 py-2 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-gray-900"
        x-data=""
        x-on:click.prevent="document.getElementById('confirm-user-deletion-modal').classList.remove('hidden')">
        Delete Account
    </button>

    <!-- Modal -->
    <div id="confirm-user-deletion-modal" 
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden"
        x-data="{ open: false }"
    >
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 max-w-md w-full">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Are you sure you want to delete your account?
            </h2>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.
            </p>

            <!-- Delete Account Form -->
            <form method="post" action="{{ route('profile.destroy') }}" class="mt-4">
                @csrf
                @method('delete')

                <!-- Password Field -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Password
                    </label>
                    <input 
                        id="password" 
                        name="password" 
                        type="password"
                        class="mt-1 block w-full px-4 py-2 bg-gray-700 text-gray-100 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="{{ __('Password') }}"
                        required
                    >
                    @error('password')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex justify-end gap-4">
                    <button 
                        type="button"
                        class="px-4 py-2 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-gray-900"
                        x-on:click="document.getElementById('confirm-user-deletion-modal').classList.add('hidden')">
                        Cancel
                    </button>
                    <button 
                        type="submit"
                        class="px-4 py-2 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-gray-900">
                        Delete Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
