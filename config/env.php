<?php

/***********************
 * ENVIRONMENT VARIABLES
 ***********************/

/**
 * @var array $env list of environment variables
 * 
 * Available configurations:
 * @param bool	merge_blocks	merge script and style blocks after body in two single blocks
 * @param bool	compile_less	process less stylesheet server-side in vue components
 */
$env = [
	"env"	=> "development"
];

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
		return isset($env[$name]) ? $env[$name] : $default;
	}
}