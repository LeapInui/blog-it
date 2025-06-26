@extends('layouts.app')

@section('title', 'Edit Comment')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="border bg-gray-700 overflow-hidden shadow-md sm:rounded-lg">
                        <div class="p-4 text-gray-100">
                            <h2 class="text-xl font-semibold text-gray-100 mb-4">Edit Comment</h2>
                            <form method="POST" action="{{ route('comments.update', $comment->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="mb-4">
                                    <textarea name="comment" 
                                              id="comment" 
                                              class="w-full p-2 bg-gray-800 text-gray-100 rounded-md" 
                                              placeholder="Edit your comment here..." 
                                              rows="5" 
                                              required>{{ old('comment', $comment->comment) }}</textarea>
                                </div>

                                <button type="submit" 
                                        class="px-4 py-2 bg-indigo-500 text-gray-100 font-semibold rounded-lg hover:bg-indigo-600">
                                    Update Comment
                                </button>
                            </form>

                            @if ($errors->has('comment'))
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
