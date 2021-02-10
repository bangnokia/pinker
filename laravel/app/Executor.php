<?php

namespace App;

use App\Models\Project;
use Spatie\Ssh\Ssh;

class Executor
{
    public static function makeSsh(Project $project)
    {
        return Ssh::create($project->user, $project->host, $project->port)
            ->usePrivateKey($project->private_key);
    }
}
