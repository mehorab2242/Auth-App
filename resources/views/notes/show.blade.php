@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow">
        <h1 class="text-3xl font-bold mb-2">{{ $note->title }}</h1>

        <p class="text-gray-600 text-sm mb-6">
            Created at: {{ $note->created_at->format('M d, Y h:i A') }} |
            Updated at: {{ $note->updated_at->format('M d, Y h:i A') }}
        </p>

        <div class="prose max-w-none text-gray-800 mb-6">
            {{ $note->description }}
        </div>

        <div class="flex gap-3">
            <a href="{{ route('notes.edit', $note) }}"
               class="rounded-lg bg-yellow-500 text-white px-4 py-2 hover:bg-yellow-600">
                Edit
            </a>

            <form action="{{ route('notes.destroy', $note) }}" method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this note?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="rounded-lg bg-red-600 text-white px-4 py-2 hover:bg-red-700">
                    Delete
                </button>
            </form>

            <a href="{{ route('notes.index') }}"
               class="rounded-lg bg-gray-300 text-gray-800 px-4 py-2 hover:bg-gray-400">
                Back to Notes
            </a>
        </div>
    </div>
@endsection
