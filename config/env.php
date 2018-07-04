<?php

/***********************
 * ENVIRONMENT VARIABLES
 ***********************/

/**
 * @var array $env list of project variables
 */
$env = [
	"env"	=> "development"
];

/***************
 * DO NOT MODIFY
 ***************/
if (!function_exists("env"))
{
	/**
	 * Retrieve an environment variable
	 * 
	 * @param string	$name		name of the variable
	 * @param mixed		$default	default value
	 * 
	 * @return mixed
	 */
	function env($name, $default = null)
	{
		global $env;
		return $env[$name] ?? $default;
	}
}