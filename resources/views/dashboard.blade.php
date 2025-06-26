@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Post Form -->
                    <div class="border bg-gray-700 overflow-hidden shadow-md sm:rounded-lg">
                        <div class="p-4 text-gray-100">
                            <h2 class="text-xl font-semibold text-gray-100 mb-4">Create a New Post</h2>
                            <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-4">
                                    <input type="text" 
                                        name="title" 
                                        id="title" 
                                        class="w-full p-2 bg-gray-800 text-gray-100 rounded-md" 
                                        placeholder="Enter post title" 
                                        required>
                                </div>

                                <div class="mb-4">
                                    <textarea name="body" 
                                            id="body" 
                                            class="w-full p-2 bg-gray-800 text-gray-100 rounded-md" 
                                            placeholder="Write your post here..." 
                                            rows="5" 
                                            required></textarea>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-300 mb-1">Upload an image (optional):</label>
                                    <input type="file" 
                                        name="image" 
                                        class="block w-full text-gray-100 p-2 bg-gray-800 rounded-md">
                                </div>
                                
                                <button type="submit" 
                                        class="px-4 py-2 bg-indigo-500 text-gray-100 font-semibold rounded-lg hover:bg-indigo-600">
                                    Post
                                </button>
                            </form>

                            @if ($errors->has('title') || $errors->has('body'))
                                <div class="mt-4 bg-red-500 text-gray-100 p-4 rounded-lg shadow-md">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (session('success'))
                                <div class="mt-4 bg-green-500 text-gray-100 p-4 rounded-lg shadow-md">
                                    {{ session('success') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Posts Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @foreach($posts as $post)
                        <div class="border p-4 mb-8 rounded-lg shadow-md bg-gray-700">
                            <h3 class="text-xl font-semibold text-gray-100">{{ $post->title }}</h3>
                            <p class="mt-2 text-gray-300">{{ $post->body }}</p>

                            @if ($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="w-full h-auto rounded-md mt-4">
                            @endif

                            <p class="text-sm text-gray-400">
                                By <a href="{{ route('user.show', $post->user->id) }}" class="text-indigo-500 hover:text-indigo-600">{{ $post->user->name }}</a>
                            </p>
                            <p class="mb-4 text-xs text-gray-500">Posted on: {{ $post->created_at->format('g:i a M j, Y') }}</p>

                            @if($post->isLikedBy(auth()->user()))
                                <!-- Unlike Button -->
                                <form method="POST" action="{{ route('likes.destroy') }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="likeable_id" value="{{ $post->id }}">
                                    <input type="hidden" name="likeable_type" value="App\Models\Post">
                                    <button type="submit" class="px-4 py-2 bg-green-500 text-gray-100 font-semibold rounded-lg hover:bg-green-600">Unlike</button>
                                </form>
                            @else
                                <!-- Like Button -->
                                <form method="POST" action="{{ route('likes.store') }}" style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="likeable_id" value="{{ $post->id }}">
                                    <input type="hidden" name="likeable_type" value="App\Models\Post">
                                    <button type="submit" class="px-4 py-2 bg-green-500 text-gray-100 font-semibold rounded-lg hover:bg-green-600">Like</button>
                                </form>
                            @endif

                            <!-- Edit Button -->
                            @if(auth()->user()->id === $post->user_id || auth()->user()->hasRole('admin') || auth()->user()->hasRole('moderator'))
                                <a href="{{ route('posts.edit', $post->id) }}" class="inline-block px-4 py-2 bg-indigo-500 text-gray-100 font-semibold rounded-lg hover:bg-indigo-600">
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
                                            class="inline-block px-4 py-2 bg-red-500 text-gray-100 font-semibold rounded-lg hover:bg-red-600">
                                        Delete Post
                                    </button>
                                </form>
                            @endif

                            <!-- Display Like Count -->
                            <p class="text-sm text-gray-300 mt-2">
                                Likes: {{ $post->likes->count() }}
                            </p>

                            <!-- Comment Form -->
                            <form method="POST" action="{{ route('comments.store', $post->id) }}" class="mt-4">
                                @csrf
                                <textarea name="comment" 
                                        class="w-full p-2 bg-gray-800 text-gray-100 rounded-md" 
                                        placeholder="Write a comment..." 
                                        required></textarea>
                                <button type="submit" 
                                        class="mt-2 px-4 py-2 bg-indigo-500 text-gray-100 font-semibold rounded-lg hover:bg-indigo-600">
                                    Add Comment
                                </button>

                                @if ($errors->has('comment'))
                                    <div class="mt-4 bg-red-500 text-gray-100 p-4 rounded-md">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </form>

                            <!-- Comments Section -->
                            <div class="mt-4">
                                @if($post->comments->isNotEmpty())
                                    <h4 class="font-semibold text-lg text-gray-100">Comments</h4>
                                    @foreach($post->comments as $comment)
                                        <div class="mt-2 p-4 bg-gray-600 rounded-lg shadow-sm">
                                            <p class="text-gray-300">{{ $comment->comment }}</p>
                                            <p class="text-sm text-gray-500">
                                                By <a href="{{ route('user.show', $comment->user->id) }}" class="text-indigo-500 hover:text-indigo-600">{{ $comment->user->name }}</a>
                                            </p>
                                            <p class="mb-2 text-xs text-gray-500">Commented on: {{ $comment->created_at->format('g:i a M j, Y') }}</p>

                                            @if($comment->isLikedBy(auth()->user()))
                                                <!-- Unlike Button -->
                                                <form method="POST" action="{{ route('likes.destroy') }}" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="likeable_id" value="{{ $comment->id }}">
                                                    <input type="hidden" name="likeable_type" value="App\Models\Comment">
                                                    <button type="submit" class="px-4 py-2 bg-green-500 text-gray-100 font-semibold rounded-lg hover:bg-green-600">Unlike</button>
                                                </form>
                                            @else
                                                <!-- Like Button -->
                                                <form method="POST" action="{{ route('likes.store') }}" style="display: inline;">
                                                    @csrf
                                                    <input type="hidden" name="likeable_id" value="{{ $comment->id }}">
                                                    <input type="hidden" name="likeable_type" value="App\Models\Comment">
                                                    <button type="submit" class="px-4 py-2 bg-green-500 text-gray-100 font-semibold rounded-lg hover:bg-green-600">Like</button>
                                                </form>
                                            @endif

                                            <!-- Edit Button -->
                                            @if(auth()->user()->id === $comment->user_id || auth()->user()->hasRole('admin') || auth()->user()->hasRole('moderator'))
                                                <a href="{{ route('comments.edit', $comment->id) }}" class="inline-block px-4 py-2 bg-indigo-500 text-gray-100 font-semibold rounded-lg hover:bg-indigo-600">
                                                    Edit
                                                </a>
                                            @endif

                                            <!-- Delete Button -->
                                            @if(auth()->user()->id === $comment->user_id || auth()->user()->hasRole('admin'))
                                                <form method="POST" action="{{ route('comments.destroy', $comment->id) }}" style="display: inline;" 
                                                    onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" 
                                                            class="inline-block px-4 py-2 bg-red-500 text-gray-100 font-semibold rounded-lg hover:bg-red-600">
                                                        Delete Comment
                                                    </button>
                                                </form>
                                            @endif

                                            <p class="text-sm text-gray-300 mt-2">
                                                Likes: {{ $comment->likes->count() }}
                                            </p>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @endforeach

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $posts->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
