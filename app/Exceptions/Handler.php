<?php

namespace App\Exceptions;

use Exception;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];
    // protected function unauthenticated($request, AuthenticationException $exception)
    // {
    //     return $request->expectsJson()
    //         ? response()->json(['message' => $exception->getMessage()], 401)
    //         : redirect()->guest(route('login', ['account' => $request->route('account')]));
    // }
    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        // dd($exception);
        // if ($exception->getStatusCode() == 500||$exception->getStatusCode() == 0) {
        //     return response()->view('errors.500', [], 500);
        // }

        if ($e instanceof ModelNotFoundException) {
            $e = new NotFoundHttpException($e->getMessage(), $e);
        }

        if ($e instanceof \Illuminate\Session\TokenMismatchException) {    

          // flash your message

            \Session::flash('flash_message_important', 'Opps, tu sesión ha expirado. Por favor ingresa tus redenciales.'); 

            return redirect('/');
        }

        return parent::render($request, $exception);


        // 404 page when a model is not found
        // if ($exception instanceof ModelNotFoundException) {
        //     return response()->view('errors.404', [], 404);
        // }

        // if ($this->isHttpException($exception)) {
        //     return $this->renderHttpException($exception);
        // } else {
        //     // Custom error 500 view on production
        //     // if (app()->environment() == 'production') {
        //     //     return response()->view('errors.500', [], 500);
        //     // }
        //     if($exception instanceof \Symfony\Component\Debug\Exception\FatalErrorException) {
        //         $statusCode = 500;
        //         return response()->view('errors.500', [], 500);
        //     }
        //     return parent::render($request, $exception);
        // }

        // custom error message
        // if ($exception instanceof \ErrorException) {
        //     return response()->view('errors.500', [], 500);
        // } else {
        //     return parent::render($request, $exception);
        // }

        // $exception = FlattenException::create($e);
        // $statusCode = $exception->getStatusCode($exception);

        // if ($statusCode === 404 or $statusCode === 500 and app()->environment() == 'production') {
        //     return response()->view('errors.' . $statusCode, [], $statusCode);
        // }
    }
    // protected function convertExceptionToResponse(Exception $e)
    // {
    //     if (config('app.debug')) {
    //         return parent::convertExceptionToResponse($e);
    //     }
    //     ob_clean();
    //     return response()->view('errors.500', [], 500);
    // }
}
