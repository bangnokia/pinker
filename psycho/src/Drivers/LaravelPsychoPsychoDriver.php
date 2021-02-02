<?php


namespace BangNokia\Psycho\Drivers;


class LaravelPsychoPsychoDriver extends PsychoDriver
{
    public function deployable(string $project): bool
    {
        return file_exists($project.'/artisan') && file_exists($project.'/public/index.php');
    }

    public function rollOut(string $project): void
    {
        require_once $project.'/vendor/autoload.php';

        $app = require $project.'/bootstrap/app.php';

        $kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);

        $kernel->bootstrap();
    }

    public function casters(): array
    {
        return [
            'Illuminate\Support\Collection' => 'Laravel\Tinker\TinkerCaster::castCollection',
            'Illuminate\Database\Eloquent\Model' => 'Laravel\Tinker\TinkerCaster::castModel',
            'Illuminate\Foundation\Application' => 'Laravel\Tinker\TinkerCaster::castApplication'
        ];
    }
}