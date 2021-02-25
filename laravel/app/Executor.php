<?php

namespace App;

use App\Models\Project;

class Executor
{
    public static function makeSsh(Project $project)
    {
        return Ssh::create($project->user, $project->host, $project->port)
            ->usePrivateKey($project->private_key)
            ->configureProcess(function ($process) {
                $process->setTimeout(20);
            });
    }
}
