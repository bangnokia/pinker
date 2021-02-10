<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Traits\Tappable;

class Project extends Model
{
    use Tappable;

    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeLocal(Builder $query)
    {
        return $query->where('type', 'local');
    }

    public function scopeSsh(Builder $query)
    {
        return $query->where('type', 'ssh');
    }

    public static function current()
    {
        $current = self::where('is_active', true)->first();

        if ($current) {
            return $current;
        }

        return Project::create([
            'name'      => 'Default',
            'path'      => base_path(),
            'code'      => 'echo "hello";',
            'is_active' => true
        ]);
    }

    public function setAsActive()
    {
        $this->update(['is_active' => true]);
        Project::query()->where('id', '<>', $this->id)->update(['is_active' => false]);

        return $this;
    }
}
