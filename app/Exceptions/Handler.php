<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Database\QueryException;

class Handler extends ExceptionHandler
{
    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Throwable $exception)
    {
        // Determine the error code (e.g., 500 for internal server error, 404 for not found, etc.)
        $code = method_exists($exception, 'getStatusCode')
            ? $exception->getStatusCode()
            : 500;

        // Set a default message for any error
        $message = $exception->getMessage() ?: 'An unexpected error occurred. Please try again later.';

        // Check for a specific error code (e.g., database error, etc.)
        if ($exception instanceof QueryException) {
            $message = 'A database error occurred. Please check your database connection.';
            $code = 500;
        }

        // Check if a specific error view exists (e.g., errors/404.blade.php, errors/500.blade.php)
        if (view()->exists("errors.$code")) {
            return response()->view("errors.$code", ['code' => $code, 'message' => $message], $code);
        }

        // Fallback to a generic error page if no specific view is found
        return response()->view('errors.error', ['code' => $code, 'message' => $message], $code);
    }
}
