<?php

function user_home_dir() {
	if (PHP_OS_FAMILY === 'Windows') {			
	
		if (getenv('HOME')) {
			return getenv('HOME');
		} 

		if (getenv('USERPROFILE')) {
			return getenv('USERPROFILE');
		} 

		if (getenv('TEMP')) {
			return str_replace('\\AppData\\Local\\Temp', '', getenv('TEMP'));
		}

		return $_SERVER['USERPROFILE'] ?? '';
	}

	return posix_getpwuid(posix_getuid())['dir'];
}
