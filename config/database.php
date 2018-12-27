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

/**************
 * DON'T MODIFY
 **************/

// Create database for each config
foreach ($dbConfig as $dbName => $dbInfo)
{
	try
	{
		if (isset($dbInfo["credentials"]))
		{
			// Read credentials from JSON if applicable
			$creds	= from_json(read_file($dbInfo["credentials"]), true);
			$dbInfo	= array_merge($dbInfo, $creds);

			// Update config
			$dbConfig[$dbName] = $dbInfo;
			unset($dbConfig[$dbName]["credentials"]);
		}

		// Create DB interface
		$GLOBALS["db".ucwords($dbName)] = new PDO(
			"{$dbInfo["protocol"]}:host={$dbInfo["host"]};dbname={$dbInfo["schema"]}",
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