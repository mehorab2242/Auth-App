<?php

namespace App\Services;

use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NoteService
{
    //
    public function create(array $data)
    {
        if (isset($data['image'])) {
            $data['image'] = $data['image']->store('notes', 'public');
        }

        return Note::create([
            'user_id' => Auth::id(),
            'title' => $data['title'],
            'description' => $data['description'],
            'image' => $data['image'] ?? null,
        ]);
    }

    public function update(Note $note, array $data)
    {
        if (isset($data['image'])) {
            if ($note->image && Storage::disk('public')->exists($note->image)) {
                Storage::disk('public')->delete($note->image);
            }
            $data['image'] = $data['image']->store('notes', 'public');
        }

        $note->update($data);
        return $note;
    }

    public function delete(Note $note)
    {
        if ($note->image && Storage::disk('public')->exists($note->image)) {
            Storage::disk('public')->delete($note->image);
        }
        return $note->delete();
    }
}
