<?php

require_once __DIR__."/../bootstrap.php";

use SnooPHP\Model\Table;
use SnooPHP\Model\Migration;

/*********************
 * MASTER DATABASE
 * 
 * Here you can define
 * the master database
 *********************/

$tables = [
	/**
	 * Register tables here
	 */
];

/**************
 * RUN SCRIPT
 * 
 * don't modify
 **************/
new Migration($argv, $tables);