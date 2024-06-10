<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
        $this->reportable(function (Throwable $e) {
            //
        });
        $this->renderable(function (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e, \Illuminate\Http\Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => __('Route not found.')
                ], 404);
            }
        });
        $this->renderable(function (\Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException $e, \Illuminate\Http\Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => __('Access denied.')
                ], 403);
            }
        });
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            $json = [
                'message' => $exception->getMessage(),
                //'isAuth' => false,
            ];
            return response()->json($json, 401);
        }
        return redirect()->guest(route('login'));
    }

}
