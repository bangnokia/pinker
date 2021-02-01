<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Traits\Tappable;

class Project extends Model
{
    use Tappable;

    protected $guarded = [];

    public static function current()
    {
        $current = self::where('is_active', true)->first();

        if ($current) {
            return $current;
        }

        $project = new Project([
            'name'      => 'Default  laravel',
            'path'      => base_path(),
            'is_active' => true
        ]);

        return $project->tap(fn($project) => $project->save());
    }
}
