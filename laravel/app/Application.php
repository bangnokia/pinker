<?php

namespace App;

class Application extends \Illuminate\Foundation\Application
{
	public function getCachedConfigPath()
	{
		return posix_getpwuid(posix_getuid())['dir'] . DIRECTORY_SEPARATOR . '.pinker/storage/cache/config.php';
	}
}
