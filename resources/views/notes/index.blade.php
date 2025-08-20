@extends('layouts.app')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="h4 fw-bold mb-0">My Notes</h1>
                <a href="{{ route('notes.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i> New Note
                </a>
            </div>

            {{-- Success message after create/update/delete --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($notes->count())
                <ul class="list-group">
                    @foreach ($notes as $note)
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="mb-1">
                                    <a href="{{ route('notes.show', $note) }}" class="text-decoration-none text-primary">
                                        {{ $note->title }}
                                    </a>
                                </h5>
                                <small class="text-muted">
                                    {{ Str::limit($note->description, 80) }}
                                </small>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('notes.edit', $note) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('notes.destroy', $note) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this note?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="alert alert-info mt-3">
                    No notes found. Create your first note!
                </div>
            @endif
        </div>
    </div>
@endsection
