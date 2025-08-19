<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Mockery\Matcher\Not;


class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $notes = Note::where('user_id', Auth::id())->latest()->get();

            if (request()->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'data' => $notes
                ]);
            }

            return view('notes.index', ['notes' => $notes]);
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
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('notes', 'public');
            }

            $note = Note::create([
                'user_id' => Auth::id(),
                'title' => $validated['title'],
                'description' => $validated['description'],
                'image' => $imagePath
            ]);

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Note created successfully',
                    'data' => $note
                ]);
            }

            return redirect()->route('notes.index')->with('success', 'Note created successfully.');
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
    public function update(Request $request, Note $note)
    {
        try {
            if ($note->user_id !== Auth::id()) {
                return $this->unauthorizedResponse();
            }

            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            if ($request->hasFile('image')) {
                if ($note->image && Storage::disk('public')->exists($note->image)) {
                    Storage::disk('public')->delete($note->image);
                }
                $validated['image'] = $request->file('image')->store('notes', 'public');
            }

            $note->update($validated);

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Note updated successfully',
                    'data' => $note
                ]);
            }

            return redirect()->route('notes.index')->with('success', 'Note updated successfully.');
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
            if ($note->user_id !== Auth::id()) {
                return $this->unauthorizedResponse();
            }

            if ($note->image && Storage::disk('public')->exists($note->image)) {
                Storage::disk('public')->delete($note->image);
            }

            $note->delete();

            if (request()->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Note deleted successfully'
                ]);
            }

            return redirect()->route('notes.index')->with('success', 'Note deleted successfully.');
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
