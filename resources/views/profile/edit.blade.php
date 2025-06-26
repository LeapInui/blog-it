@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-8 space-y-6">
            <!-- Update Profile Information -->
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 mb-4">Update Profile Information</h2>
                @include('profile.partials.update-profile-information-form')
            </div>

            <!-- Update Password -->
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 mb-4">Update Password</h2>
                @include('profile.partials.update-password-form')
            </div>

            <!-- Delete Account -->
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 mb-4">Delete Account</h2>
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
@endsection
