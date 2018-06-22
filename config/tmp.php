<?php

use SnooPHP\Http\Router;
use SnooPHP\Http\Request;
use SnooPHP\Http\Response;

/*****************
 * TEMPORARY FILES
 *****************/

/**
 * @var Router $router application router
 */
$router = register_router(new Router("/tmp"));

/* Error page */
$router->errorAction(function($request) {

	Response::abort(404, [
		"status"		=> "ERROR",
		"description"	=> "resource not found"
	]);
});

/* Session script */
$router->get("/{file}+", function($request, $args) {

	return Response::resource("tmp/{$args["file"]}");
});