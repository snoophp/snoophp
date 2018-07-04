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
// <-- Table definitions

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
$migration = new Migration(basename($argv[0], ".php"), $tables);
for ($i = 1; $i < $argc; $i++) $migration->run($argv[$i]);