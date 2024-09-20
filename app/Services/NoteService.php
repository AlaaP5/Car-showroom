<?php

namespace App\Services;

use App\Models\Note;
use App\Repositories\NoteRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class NoteService
{
    protected $noteRepository;

    public function __construct(NoteRepositoryInterface $noteRepository)
    {
        $this->noteRepository = $noteRepository;
    }


    public function store($request)
    {
        return $this->noteRepository->store($request);
    }

    public function fetchAll()
    {
        return $this->noteRepository->fetchAll();
    }

    public function get($id)
    {
        return $this->noteRepository->get($id);
    }

    public function update($id, $request)
    {
        return $this->noteRepository->update($id, $request);
    }

    public function delete($id)
    {
        return $this->noteRepository->delete($id);
    }
}
