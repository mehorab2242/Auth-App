<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\Note;
use App\Services\NoteService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Mockery\Matcher\Not;


class NoteController extends Controller
{
    protected $service;

    public function __construct(NoteService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = Note::forUser();

            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            }

            $notes = $query->latest()->paginate(5);

            return $request->wantsJson()
                ? response()->json(['success' => true, 'data' => $notes])
                : view('notes.index', compact('notes'));

        } catch (\Exception $e) {
            return $this->handleException($e, 'Failed to fetch notes');
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoteRequest $request)
    {
        try {
            $note = $this->service->create($request->validated());

            return $request->wantsJson()
                ? response()->json(['success' => true, 'message' => 'Note created successfully', 'data' => $note])
                : redirect()->route('notes.index')->with('success', 'Note created successfully.');

        } catch (\Exception $e) {
            return $this->handleException($e, 'Failed to create note');
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        try {
            if ($note->user_id !== Auth::id()) {
                return $this->unauthorizedResponse();
            }

            if (request()->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'data' => $note
                ]);
            }

            return view('notes.show', compact('note'));
        } catch (\Exception $e) {
            return $this->handleException($e, 'Failed to fetch note');
        }
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        if ($note->user_id !== Auth::id()) {
            return redirect()->route('notes.index')->with('error', 'Unauthorized');
        }

        return view('notes.edit', compact('note'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoteRequest $request, Note $note)
    {
        try {
            if ($note->user_id !== auth()->id()) {
                return $this->unauthorizedResponse();
            }

            $this->service->update($note, $request->validated());

            return $request->wantsJson()
                ? response()->json(['success' => true, 'message' => 'Note updated successfully', 'data' => $note])
                : redirect()->route('notes.index')->with('success', 'Note updated successfully.');

        } catch (\Exception $e) {
            return $this->handleException($e, 'Failed to update note');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        try {
            if ($note->user_id !== auth()->id()) {
                return $this->unauthorizedResponse();
            }

            $this->service->delete($note);

            return request()->wantsJson()
                ? response()->json(['success' => true, 'message' => 'Note deleted successfully'])
                : redirect()->route('notes.index')->with('success', 'Note deleted successfully.');

        } catch (\Exception $e) {
            return $this->handleException($e, 'Failed to delete note');
        }
    }
    /**
     * Helper: Handle exception
     */
    private function handleException(\Exception $e, string $message)
    {
        if (request()->wantsJson()) {
            return response()->json([
                'success' => false,
                'message' => $message,
                'error' => $e->getMessage()
            ], 500);
        }

        return redirect()->route('notes.index')->with('error', $message);
    }

    private function unauthorizedResponse()
    {
        if (request()->wantsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        return redirect()->route('notes.index')->with('error', 'Unauthorized');
    }
}
