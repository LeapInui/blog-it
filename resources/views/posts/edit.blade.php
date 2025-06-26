@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="border bg-gray-700 overflow-hidden shadow-md sm:rounded-lg">
                        <div class="p-4 text-gray-100">
                            <h2 class="text-xl font-semibold text-gray-100 mb-4">Edit Post</h2>
                            <form method="POST" action="{{ route('posts.update', $post->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="mb-4">
                                    <input type="text" 
                                        name="title" 
                                        id="title" 
                                        class="w-full p-2 bg-gray-800 text-gray-100 rounded-md" 
                                        placeholder="Enter post title" 
                                        value="{{ old('title', $post->title) }}" 
                                        required>
                                </div>

                                <div class="mb-4">
                                    <textarea name="body" 
                                            id="body" 
                                            class="w-full p-2 bg-gray-800 text-gray-100 rounded-md" 
                                            placeholder="Write your post here..." 
                                            rows="5" 
                                            required>{{ old('body', $post->body) }}</textarea>
                                </div>

                                <button type="submit" 
                                        class="px-4 py-2 bg-indigo-500 text-gray-100 font-semibold rounded-lg hover:bg-indigo-600">
                                    Update Post
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
        </div>
    </div>
@endsection
