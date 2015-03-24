<?php namespace App\Http\Middleware;

use Closure, Session, Sentry,Flash;
use Illuminate\Contracts\Routing\Middleware;

class PaymentProgressionMiddleWare implements Middleware {

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

        $registrar  = $admin = \Sentry::findGroupByName('registrar');
        $finance    = $admin = \Sentry::findGroupByName('finance');

        // dd(!Sentry::getUser()->inGroup($registrar) && !Sentry::getUser()->inGroup($finance));
        // Now check to see if the current user has the 'finance' permission
        if (!Sentry::getUser()->inGroup($registrar) && !Sentry::getUser()->inGroup($finance))
        {
            if ($request->ajax())
            {
                return response('Unauthorized.', 401);
            }
            else
            {
                Flash::error(trans('Sentinel::users.noaccess'));
                
                return redirect()->back();
            }
        }

        // All clear - we are good to move forward
        return $next($request);
	}
}
