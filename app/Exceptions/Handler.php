<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use App\Helpers\ResponseFormatter;

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

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        $response = $this->handleException($request, $exception);
        return $response;
    }

    public function handleException($request, Throwable $exception)
    {

        if ($exception instanceof MethodNotAllowedHttpException) {
            return ResponseFormatter::error(
                null,
                'The specified method for the request is invalid',
                405 
            );
        }

        if ($exception instanceof NotFoundHttpException) {
            return ResponseFormatter::error(
                null,
                'The specified URL cannot be found',
                404 
            );
        }

        if ($exception instanceof HttpException) {
            return ResponseFormatter::error(
                null,
                $exception->getMessage(),
                $exception->getStatusCode() 
            );
        }

        if (config('app.debug')) {
            return parent::render($request, $exception);            
        }

        return ResponseFormatter::error(
            null,
            'Unexpected Exception. Try later',
            500 
        );

    }
}
