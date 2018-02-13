<?php

/***********************
 * ENVIRONMENT VARIABLES
 ***********************/

/**
 * @var array $env list of environment variables
 */
$env = [];

if (!function_exists("env"))
{
	/**
	 * Retrieve an environment variable
	 * 
	 * @param string $name name fo the variable
	 * 
	 * @return mixed
	 */
	function env($name)
	{
		global $env;
		return isset($env[$name]) ? $env[$name] : null;
	}
}