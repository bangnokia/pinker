<?php

namespace App;

class Application extends \Illuminate\Foundation\Application
{
	public function getCachedConfigPath()
	{
		return user_home_dir().'/.pinker/storage/cache/config.php';
	}
}
