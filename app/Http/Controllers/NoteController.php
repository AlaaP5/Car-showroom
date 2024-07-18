<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteValidate;
use App\Services\NoteService;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    protected $Note;
    public function __construct(NoteService $Note) {
        $this->Note = $Note;
    }

    public function store(NoteValidate $request)
    {
        return $this->Note->store($request);
    }

    public function fetchAll()
    {
        return $this->Note->fetchAll();
    }

    public function fetch($id)
    {
        return $this->Note->get($id);
    }

    public function updateNote($id,Request $request)
    {
        return $this->Note->update($id,$request);
    }

    public function deleteNote($id)
    {
        return $this->Note->delete($id);
    }
}
