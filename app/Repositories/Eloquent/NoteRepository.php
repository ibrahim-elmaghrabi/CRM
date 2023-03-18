<?php

namespace App\Repositories\Eloquent;


use App\Models\Note;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\NoteRepositoryContract;

class NoteRepository extends BaseRepository implements NoteRepositoryContract
{
    public function __construct(Note $note)
    {
        $this->setModel($note);
    }
}