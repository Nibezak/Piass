<?php namespace App\Http\Middleware;

use Closure, Session, Sentry,Flash;
use Illuminate\Contracts\Routing\Middleware;

class RegistrarMiddleWare implements Middleware {

    /**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        // First make sure there is an active session
        if ( ! Sentry::check())
        {
            if ($request->ajax())
            {
                return response('Unauthorized.', 401);
            }
            else
            {
                return redirect()->guest(route('sentinel.login'));
            }
        }

        // Now check to see if the current user has the 'finance' permission
        if ( ! Sentry::getUser()->hasAccess('registrar'))
        {
            if ($request->ajax())
            {
                return response('Unauthorized.', 401);
            }
            else
            {
                Flash::error(trans('Sentinel::users.noaccess'));
                 return redirect()->route('home');
            }
        }

        // All clear - we are good to move forward
        return $next($request);
	}
}
