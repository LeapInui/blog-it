@extends('layouts.app')

@section('title', $user->name . "'s Comments")

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-xl font-semibold text-gray-100">{{ $user->name }}'s Comments</h2>

                    <!-- Navigation Tabs -->
                    <div class="flex space-x-4 mt-4">
                        <a href="{{ route('user.show', $user->id) }}" 
                           class="px-4 py-2 bg-gray-700 text-gray-100 rounded-lg hover:bg-gray-600">
                            Posts
                        </a>
                        <a href="{{ route('user.comments', $user->id) }}" 
                           class="px-4 py-2 bg-indigo-500 text-gray-100 rounded-lg hover:bg-indigo-600">
                            Comments
                        </a>
                    </div>

                    <!-- Comments Section -->
                    <div class="mt-6">
                        @if($comments->isEmpty())
                            <p class="text-gray-400">This user has not made any comments yet.</p>
                        @else
                            @foreach($comments as $comment)
                                <div class="border p-4 mb-4 rounded-lg shadow-md bg-gray-700">
                                    <p class="text-gray-300">{{ $comment->comment }}</p>
                                    <p class="text-sm text-gray-400">
                                        By <a href="{{ route('user.show', $comment->user->id) }}" class="text-indigo-500 hover:text-indigo-600">{{ $comment->user->name }}</a>
                                    </p>
                                    <p class="text-xs text-gray-500">Commented on {{ $comment->created_at->format('g:i a M j, Y') }}</p>

                                    <!-- Edit Button -->
                                    @if(auth()->user()->id === $comment->user_id || auth()->user()->roles->contains('name', 'admin'))
                                        <a href="{{ route('comments.edit', $comment->id) }}" class="mt-4 inline-block px-4 py-2 bg-indigo-500 text-gray-100 font-semibold rounded-lg hover:bg-indigo-600">
                                            Edit
                                        </a>
                                    @endif

                                    <!-- Delete Button -->
                                    @if(auth()->user()->id === $comment->user_id || auth()->user()->hasRole('admin'))
                                        <form method="POST" action="{{ route('comments.destroy', $comment->id) }}" style="display: inline;" 
                                            onsubmit="return confirm('Are you sure you want to delete this post?');">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" 
                                                    class="mt-4 inline-block px-4 py-2 bg-red-500 text-gray-100 font-semibold rounded-lg hover:bg-red-600">
                                                Delete Comment
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @endforeach   
                        @endif
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $comments->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
