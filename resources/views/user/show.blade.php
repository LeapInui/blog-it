@extends('layouts.app')

@section('title', $user->name . "'s Profile")

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-xl font-semibold text-gray-100 mb-4">{{ $user->name }}'s Profile</h2>

                    <!-- Navigation Tabs -->
                    <div class="flex space-x-4 mt-4">
                        <a href="{{ route('user.show', $user->id) }}" 
                            class="px-4 py-2 bg-indigo-500 text-gray-100 rounded-lg hover:bg-indigo-600">
                            Posts
                        </a>
                        <a href="{{ route('user.comments', $user->id) }}" 
                            class="px-4 py-2 bg-gray-700 text-gray-100 rounded-lg hover:bg-gray-600">
                            Comments
                        </a>
                    </div>

                    <div class="mt-6">
                        <!-- Posts Section -->
                        @if($posts->isEmpty())
                            <p class="text-gray-400">This user has not made any posts yet.</p>
                        @else
                            @foreach($posts as $post)
                                <div class="border p-4 mb-6 rounded-lg shadow-md bg-gray-700">
                                    <h3 class="text-xl font-semibold text-gray-100">{{ $post->title }}</h3>
                                    <p class="mt-2 text-gray-300">{{ $post->body }}</p>
                                    <p class="text-sm text-gray-400">
                                        By <a href="{{ route('user.show', $post->user->id) }}" class="text-indigo-500 hover:text-indigo-600">{{ $post->user->name }}</a>
                                    </p>
                                    <p class="text-xs text-gray-500">Posted on: {{ $post->created_at->format('g:i a M j, Y') }}</p>

                                    <!-- Edit Button -->
                                    @if(auth()->user()->id === $post->user_id || auth()->user()->roles->contains('name', 'admin'))
                                        <a href="{{ route('posts.edit', $post->id) }}" class="mt-4 inline-block px-4 py-2 bg-indigo-500 text-gray-100 font-semibold rounded-lg hover:bg-indigo-600">
                                            Edit
                                        </a>
                                    @endif

                                    <!-- Delete Button -->
                                    @if(auth()->user()->id === $post->user_id || auth()->user()->hasRole('admin'))
                                        <form method="POST" action="{{ route('posts.destroy', $post->id) }}" style="display: inline;" 
                                            onsubmit="return confirm('Are you sure you want to delete this post?');">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" 
                                                    class="mt-4 inline-block px-4 py-2 bg-red-500 text-gray-100 font-semibold rounded-lg hover:bg-red-600">
                                                Delete Post
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
