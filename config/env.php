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
	"css_pp"	=> "lessc"
];

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