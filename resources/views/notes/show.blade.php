@extends('layouts.app')

@section('content')
    <div class="mb-3">
        <a href="{{ route('notes.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Notes
        </a>
    </div>

    <div class="card shadow-sm mx-auto" style="max-width: 700px;">
        <div class="card-body">
            <h1 class="h3 fw-bold mb-2">{{ $note->title }}</h1>

            <p class="text-muted small mb-4">
                Created at: {{ $note->created_at->format('M d, Y h:i A') }} |
                Updated at: {{ $note->updated_at->format('M d, Y h:i A') }}
            </p>

            {{-- Show image if exists --}}
            @if($note->full_image_url)
                <div class="mb-4 text-center">
                    <img src="{{ $note->full_image_url }}"
                         alt="Note Image"
                         class="img-fluid rounded shadow"
                         style="max-height: 300px; object-fit: contain;">
                </div>
            @endif

            <div class="mb-4">
                <p class="fs-6">{{ $note->description }}</p>
            </div>

            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('notes.edit', $note) }}" class="btn btn-warning">
                    <i class="bi bi-pencil-square"></i> Edit
                </a>

                <form action="{{ route('notes.destroy', $note) }}" method="POST"
                      onsubmit="return confirm('Are you sure you want to delete this note?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
