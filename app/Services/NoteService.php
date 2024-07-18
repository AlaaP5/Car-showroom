<?php

namespace App\Services;

use App\Models\Note;
use Illuminate\Support\Facades\Auth;

class NoteService
{
    public function store($request)
    {
        $input = $request->all();
        $id = Auth::id();
        $input['user_id'] = $id;
        Note::create($input);
        return response()->json(['message' => 'The Note has been added Successfully'], 201);
    }


    public function fetchAll()
    {
        $user_id = Auth::id();
        $notes = Note::where('user_id', $user_id)->get();
        if (!count($notes)) {
            return response()->json(['message' => 'not found'], 404);
        }
        return response()->json(['data' => $notes], 200);
    }


    public function get($id)
    {
        $user_id = Auth::id();
        $note = Note::where('id', $id)->where('user_id', $user_id)->first();
        if (empty($note)) {
            return response()->json(['message' => 'not found'], 404);
        }
        return response()->json(['data' => $note], 200);
    }


    public function update($id, $request)
    {
        $user_id = Auth::id();
        $note = Note::where('id', $id)->where('user_id', $user_id)->first();
        if (empty($note)) {
            return response()->json(['message' => 'not found'], 404);
        }
        $note->update([
            'body' => ($request->body) ? $request->body : $note->body
        ]);
        return response()->json(['message' => 'Note updated successfully'], 200);
    }


    public function delete($id)
    {
        $user_id = Auth::id();
        $note = Note::where('id', $id)->where('user_id', $user_id)->first();
        if (empty($note)) {
            return response()->json(['message' => 'not found'], 404);
        }

        $note->delete();
        return response()->json(['Comment deleted successfully'], 200);
    }
}
