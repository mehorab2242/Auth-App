@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto p-6 bg-white rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-4">Edit Note</h1>

        {{-- Validation errors --}}
        @if ($errors->any())
            <div class="mb-4 rounded-lg border p-4 bg-red-50">
                <ul class="list-disc list-inside text-red-700">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('notes.update', $note) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-sm font-medium mb-1">Title</label>
                <input type="text"
                       id="title"
                       name="title"
                       value="{{ old('title', $note->title) }}"
                       required
                       class="w-full rounded-lg border px-3 py-2 focus:outline-none focus:ring">
            </div>

            <div>
                <label for="description" class="block text-sm font-medium mb-1">Description</label>
                <textarea id="description"
                          name="description"
                          rows="6"
                          required
                          class="w-full rounded-lg border px-3 py-2 focus:outline-none focus:ring">{{ old('description', $note->description) }}</textarea>
            </div>

            {{-- Image upload --}}
            <div>
                <label for="image" class="block text-sm font-medium mb-1">Image</label>
                <input type="file" id="image" name="image"
                       class="w-full rounded-lg border px-3 py-2 focus:outline-none focus:ring">

                {{-- Show existing image if available --}}
                @if($note->full_image_url)
                    <div class="mt-3">
                        <p class="text-sm text-gray-600 mb-1">Current Image:</p>
                        <img src="{{ $note->full_image_url }}"
                             alt="Note Image"
                             class="w-40 h-40 object-cover rounded-lg border">
                    </div>
                @endif
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="rounded-lg bg-blue-600 text-white px-4 py-2 hover:bg-blue-700">
                    Update Note
                </button>
                <a href="{{ route('notes.index') }}" class="text-gray-700 underline">Cancel</a>
            </div>
        </form>
    </div>
@endsection
