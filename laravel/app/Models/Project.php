<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Traits\Tappable;

class Project extends Model
{
    use Tappable;

    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function current()
    {
        $current = self::where('is_active', true)->first();

        if ($current) {
            return $current;
        }

        $project = new Project([
            'name'      => 'Default',
            'path'      => base_path(),
            'code'      => 'echo "hello";',
            'is_active' => true
        ]);

        return $project->tap(fn($project) => $project->save());
    }

    public function setAsActive()
    {
        $this->update(['is_active' => true]);
        Project::query()->where('id', '<>', $this->id)->update(['is_active' => false]);

        return $this;
    }
}
