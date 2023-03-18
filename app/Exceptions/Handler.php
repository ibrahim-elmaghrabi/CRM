<?php

namespace App\Exceptions;

use Throwable;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
          $this->reportable(function (AuthenticationException $e, $request) {
                    return response()->json([
                    'status'=> 'error',
                    'errors' => [
                        'generic' => 'not authenticated'
                    ]
                ], JsonResponse::HTTP_UNAUTHORIZED);
            
        });
         $this->reportable(function (Throwable $e) {
             return response()->json([
                    'status'=> 'error',
                    'errors' => [
                        'generic' => 'unknown error please try again '
                    ]
                ], JsonResponse::HTTP_BAD_REQUEST);
        });
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
