<?php namespace App\Exceptions;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;
class Handler extends ExceptionHandler {
	/**
	 * A list of the exception types that should not be reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		'Symfony\Component\HttpKernel\Exception\HttpException'
	];
	/**
	 * Report or log an exception.
	 *
	 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
	 *
	 * @param  \Exception  $e
	 * @return void
	 */
	public function report(Exception $e)
	{
		dd($e);
		return parent::report($e);
	}
	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Exception  $e
	 * @return \Illuminate\Http\Response
	 */
	public function render($request, Exception $e)
	{
		if($this->isHttpException($e)){
			switch ($e->getStatusCode()) {
                case '404':
                            \Log::error($e);
                        return  redirect('/');;
                break;

                case '500':
                    \Log::error($exception);
                        return redirect('/');; 
                break;

                default:
                    return redirect('/');
                break;
            }
        }
		//add this to the render function
		if ($e instanceof ModelNotFoundException)
            {
            	if(\Sentry::check()):
            	 	return response()->view('errors.'.'404');
                else:
                	return \redirect('/');;
                endif;
            }
		return parent::render($request, $e);
	}
}