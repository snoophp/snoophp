<?php

/************************
 * DATABASE CONFIGURATION
 ************************/

/**
 * @var array $dbConfig array containing database configuration
 */
$dbConfig = [
	/* "master"	=> [
		"protocol"	=> "mysql",
		"host"		=> "localhost",
		"schema"	=> "snoophp",
		"username"	=> "snoophp",
		"password"	=> "xxxxxxxx",
		"params"	=> [
			PDO::ATTR_ERRMODE	=> PDO::ERRMODE_EXCEPTION
		]
	] */
];

// Create database for each config
foreach ($dbConfig as $dbName => $dbInfo)
{
	try
	{
		$GLOBALS["db".ucwords($dbName)] = new PDO(
			"{$dbInfo["dns"]}:host={$dbInfo["host"]};dbname={$dbInfo["schema"]}",
			$dbInfo["username"],
			$dbInfo["password"],
			$dbInfo["params"] ?? []
		);
	}
	catch (PDOException $e)
	{
		error_log($e->getMessage());
	}
}