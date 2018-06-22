<?php

require_once __DIR__."/../bootstrap.php";

use SnooPHP\Utils\Utils;
use SnooPHP\Http\Router;
use SnooPHP\Http\Request;
use SnooPHP\Http\Response;
use SnooPHP\Http\AbortRouteException;

/***************
 * Parse request
 ***************/
if ($request = Request::current())
{
	$notFound = true;
	foreach ($routers as $router)
	{
		try
		{
			$response = $router->handle($request);
			if ($response !== false)
			{
				$notFound = false;
				if ($response) $response->parse();
				break;
			}
		}
		catch (AbortRouteException $e)
		{
			$notFound = false;
			if ($res = $e->response()) $res->parse();
		}
	}

	// Get error action
	if ($notFound)
	{
		$match = null;
		foreach($routers as $router)
		{
			$base		= rtrim($router->base(), "\/");
			$pattern	= "@^".$base."(?:/[^/]*)*$@";

			if (empty($base) && $match == null && $router->errorAction() !== null)
				$match = $router;
			else if (preg_match($pattern, $request->url()) && $router->errorAction() !== null)
			{
				$match = $router;
				break;
			}
		}

		if ($match)
			$match->onError($request)->parse();
		else
			Response::abort(404);
	}
}

// Flush errors
Utils::flushErrors();

exit;