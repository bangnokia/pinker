const { exec } = require('child_process');

exec('cd laravel && /usr/local/bin/php artisan serve --port=6969', function (error, stdout, stderr) {
	console.log('stdout', stdout);
	console.log('error', error);
	console.log('stderr', stderr);
});
