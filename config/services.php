<?php
return [
	'rollbar' => [
		'environment' => env('APP_ENV', 'production'),
	    'access_token' => env('ROLLBAR_ACCESS_TOKEN', ''),
	    'level' => 'debug',
	]
];
