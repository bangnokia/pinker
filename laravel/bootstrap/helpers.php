<?php

function user_home_dir() {
	return posix_getpwuid(posix_getuid())['dir'];
}
