<?php namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel {

	/**
	 * The application's global HTTP middleware stack.
	 *
	 * @var array
	 */
	protected $middleware = [
		'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
		'Illuminate\Cookie\Middleware\EncryptCookies',
		'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
		'Illuminate\Session\Middleware\StartSession',
		'Illuminate\View\Middleware\ShareErrorsFromSession',
		
	];

	/**
	 * The application's route middleware.
	 *
	 * @var array
	 */
	protected $routeMiddleware = [
	    'sentry.auth' 	=> 'Sentinel\Middleware\SentryAuth',
        'sentry.admin' 	=> 'Sentinel\Middleware\SentryAdminAccess',
        
         /*----------------------
          * Reports MiddleWare  |
          * ---------------------
          */
        'reports.students.finance'	 				=>'App\Http\Middleware\FinanceReportMiddleWare',
		'reports.students.PaymentProgress'			=>'App\Http\Middleware\PaymentProgressionMiddleWare',
		'reports.students.details'					=>'App\Http\Middleware\StudentDetailsReportMiddleWare',
	];

}
