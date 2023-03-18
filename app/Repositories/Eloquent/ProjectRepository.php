<?php

namespace App\Repositories\Eloquent;

use App\Models\Project;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\ProjectRepositoryContract;

class ProjectRepository extends BaseRepository implements ProjectRepositoryContract
{
    public function __construct(Project $project)
    {
        $this->setModel($project);
    }
}