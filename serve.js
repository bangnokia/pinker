const { exec } = require('child_process');

exec('cd laravel && php artisan serve --port=6969', function (error, stdout, stderr) {
});
