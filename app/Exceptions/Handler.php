<?php

namespace App\Exceptions;

use App\Traits\ResponseTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    use ResponseTrait;
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
        // $this->reportable(function (Throwable $e) {
        //     //
        // });
    }

    public function render($request, Throwable $ex)
    {

        if ($ex instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException && request()->wantsJson()) {
            return $this->invalidMethodResponse();
        }
        if ($ex instanceof ModelNotFoundException && request()->wantsJson()) {
            return $this->notFoundResponse();
        }

        if ($ex instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException && request()->wantsJson()) {
            return $this->invalidEndpointResponse();
        }


        return parent::render($request, $ex);
    }
}
