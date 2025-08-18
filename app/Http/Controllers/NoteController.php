<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Note::where('user_id', Auth::id())->latest()->get();
        return view('notes.index', ['notes' => $notes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
           'title' => 'required|string|max:255',
           'description' => 'required|string',
        ]);
        Note::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description
        ]);
        return redirect()->route('notes.index')->with('success', 'Note created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        //
        if ($note->user_id !== auth()->id()) {
            return redirect()->route('notes.index')->with('error', 'You are not authorized to edit this page.');
        }
        return view('notes.show', compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        //
        if ($note->user_id !== auth()->id()) {
            return redirect()->route('notes.index')->with('error', 'You are not authorized to edit this page.');
        }
        return view('notes.edit', compact('note'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        //
        if ($note->user_id !== auth()->id()) {
            return redirect()->route('notes.index')->with('error', 'You are not authorized to edit this page.');
        }
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        $note->update($request->all());

        return redirect()->route('notes.index')->with('success', 'Note updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        //
        if ($note->user_id !== auth()->id()) {
            return redirect()->route('notes.index')->with('error', 'You are not authorized to edit this page.');
        }
        $note->delete();
        return redirect()->route('notes.index')->with('success', 'Note deleted successfully.');
    }
}
