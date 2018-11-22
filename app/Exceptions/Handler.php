<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

use Illuminate\Database\QueryException;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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

    // This will replace our 404 response with a JSON response.
        if ($exception instanceof ModelNotFoundException) {
            return response()->json([
            'error' => 'Resource item not found.'
        ], 404);
        }

        if ($exception instanceof NotFoundHttpException) {
            return response()->json([
            'error' => 'Resource not found.'
        ], 404);
        }

        if ($exception instanceof QueryException) {
            if ($exception->errorInfo[0] == 23000) {
                $data = [
                    'message' => 'Cannot delete record with reliant data'
                ];
                return response()->json($data, 400);
            }
            throw $exception;
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return response()->json([
            'error' => 'Method not allowed.'
        ], 405);
        }
        if ($exception instanceof Exception) {
            Log::error($exception->getMessage());
            return response()->json([
            'error' => 'An error has occurred.'
        ], 500);
        }

        return parent::render($request, $exception);
    }
}
