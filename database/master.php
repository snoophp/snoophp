<?php

require_once __DIR__."/../bootstrap.php";
require_once __DIR__."/migration.php";

use SnooPHP\Model\Table;

/*********************
 * MASTER DATABASE
 * 
 * Here you can define
 * the master database
 *********************/
// <--

/**************
 * RUN SCRIPT
 * 
 * don't modify
 **************/
$schema = basename($argv[0], ".php");
for ($i = 1; $i < $argc; $i++)
{
	if (function_exists($argv[$i]."_all")) call_user_func($argv[$i]."_all", $schema);
}