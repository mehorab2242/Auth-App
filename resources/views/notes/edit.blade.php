@extends('layouts.app')

@section('content')
    <div class="card shadow-sm mx-auto" style="max-width: 600px;">
        <div class="card-body">
            <h1 class="h4 fw-bold mb-4">Edit Note</h1>

            {{-- Validation errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('notes.update', $note) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text"
                           id="title"
                           name="title"
                           value="{{ old('title', $note->title) }}"
                           class="form-control @error('title') is-invalid @enderror"
                           required>
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="description"
                              name="description"
                              rows="6"
                              class="form-control @error('description') is-invalid @enderror"
                              required>{{ old('description', $note->description) }}</textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Image upload --}}
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file"
                           id="image"
                           name="image"
                           class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    {{-- Show existing image if available --}}
                    @if($note->full_image_url)
                        <div class="mt-3">
                            <p class="text-muted small mb-1">Current Image:</p>
                            <img src="{{ $note->full_image_url }}"
                                 alt="Note Image"
                                 class="img-thumbnail"
                                 style="width: 160px; height: 160px; object-fit: cover;">
                        </div>
                    @endif
                </div>

                <div class="d-flex align-items-center gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-arrow-repeat"></i> Update Note
                    </button>
                    <a href="{{ route('notes.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
