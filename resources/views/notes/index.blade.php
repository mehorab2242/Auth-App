@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-bold">My Notes</h1>
            <a href="{{ route('notes.create') }}"
               class="rounded-lg bg-blue-600 text-white px-4 py-2 hover:bg-blue-700">
                + New Note
            </a>
        </div>

        {{-- Success message after create/update/delete --}}
        @if(session('success'))
            <div class="mb-4 rounded-lg border p-3 bg-green-50 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if ($notes->count())
            <ul class="divide-y divide-gray-200">
                @foreach ($notes as $note)
                    <li class="py-3 flex items-center justify-between">
                        <div>
                            <h2 class="font-semibold text-lg">
                                <a href="{{ route('notes.show', $note) }}" class="text-blue-600 hover:underline">
                                    {{ $note->title }}
                                </a>
                            </h2>
                            <p class="text-gray-600 text-sm">
                                {{ Str::limit($note->description, 80) }}
                            </p>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('notes.edit', $note) }}" class="text-sm text-yellow-600 hover:underline">
                                Edit
                            </a>
                            <form action="{{ route('notes.destroy', $note) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this note?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm text-red-600 hover:underline">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>

{{--            <div class="mt-4">--}}
{{--                {{ $notes->links() }} --}}{{-- Laravel pagination links --}}
{{--            </div>--}}
        @else
            <p class="text-gray-500">No notes found. Create your first note!</p>
        @endif
    </div>
@endsection
