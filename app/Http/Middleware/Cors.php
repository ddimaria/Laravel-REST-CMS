<?php namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Response;

class Cors {

	 /**
	  * Handle an incoming request.
	  *
	  * @param \Illuminate\Http\Request $request
	  * @param \Closure $next
	  * @return mixed
	  */
	 public function handle($request, Closure $next)
	 {
		$response = $next($request);

		$response->headers->set('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE');
		$response->headers->set('Access-Control-Allow-Headers', 'Access-Control-Allow-Headers, Content-Type, Content-Range, Content-Disposition, Content-Description, Accept, Authorization, X-Requested-With, X-Authorization, Access-Control-Allow-Origin');
		$response->headers->set('Access-Control-Expose-Headers', 'Access-Control-Allow-Headers, Content-Type, Content-Range, Content-Disposition, Content-Description, Accept, Authorization, X-Requested-With, X-Authorization, Access-Control-Allow-Origin');
		$response->headers->set('Access-Control-Allow-Credentials', 'true');

		return $response;
	 }
}