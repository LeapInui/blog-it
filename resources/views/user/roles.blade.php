@extends('layouts.app')

@section('title', 'Admin Role Management')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h2 class="text-xl font-bold text-gray-100 mb-6">Manage User Roles</h2>

                @if (session('success'))
                    <div class="mb-6 bg-green-500 text-gray-100 p-4 rounded-lg shadow-md">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="w-full bg-gray-700 text-gray-100 rounded-md shadow-md">
                    <thead>
                        <tr class="bg-gray-600">
                            <th class="px-4 py-2 text-left">User</th>
                            <th class="px-4 py-2 text-left">Current Roles</th>
                            <th class="px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr class="border-t border-gray-600">
                                <td class="px-4 py-3">
                                    {{ $user->name }} 
                                    <span class="text-sm text-gray-400 block">({{ $user->email }})</span>
                                </td>
                                <td class="px-4 py-3">
                                    @foreach($user->roles as $role)
                                        <span class="bg-gray-800 px-2 py-1 rounded-md">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td class="px-4 py-3">
                                    <!-- Assign Role -->
                                    <form method="POST" action="{{ route('user.roles.assign') }}" class="inline-block">
                                        @csrf
                                        <select name="role_id" class="bg-gray-800 border-gray-700 text-gray-100 p-2 rounded-md">
                                            <option value="">Assign Role</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                        <button type="submit" class="ml-2 px-4 py-2 bg-indigo-500 text-gray-100 font-semibold rounded-md hover:bg-indigo-600">
                                            Assign
                                        </button>
                                    </form>

                                    <!-- Remove Role -->
                                    @foreach($user->roles as $role)
                                        <form method="POST" action="{{ route('user.roles.remove') }}" class="inline-block ml-2">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                            <input type="hidden" name="role_id" value="{{ $role->id }}">
                                            <button type="submit" class="px-4 py-2 bg-red-500 text-gray-100 font-semibold rounded-md hover:bg-red-600">
                                                Remove {{ $role->name }}
                                            </button>
                                        </form>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
