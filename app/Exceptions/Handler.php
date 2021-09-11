<?php

namespace App\Exceptions;

use App\Services\MainService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

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
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
        $this->renderable(function (ValidationException $e) {
            $mainService = new MainService;
            return response()->error($mainService->getErrorMessagges($e->validator->getMessageBag()), "422");
        });
        $this->renderable(function (AccessDeniedHttpException $e, $request) {
            return response()->error(['message' => 'Nemáte na to povolenia.'], "403");
        });
        $this->renderable(function (HttpException $e, $request) {
            return response()->error(['message' => 'Nemáte na to povolenia.'], "403");
        });
        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->wantsJson()) {
                return response()->error(['message' => 'Žiadne výsledky pre model.'], "404");
            }
        });
        $this->renderable(function (AuthenticationException  $e, $request) {
            if ($request->wantsJson()) {
                return response()->error(['message' => 'Unauthenticated.'], "401");
            }
        });
    }
}
