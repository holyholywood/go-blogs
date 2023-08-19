<?php

namespace App\Exceptions;

use App\Traits\ResponseProvider;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;
use Throwable;
use Illuminate\Validation\ValidationException;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class Handler extends ExceptionHandler
{
    use ResponseProvider;
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
        $this->renderable(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return $this->sendError(JsonResponse::HTTP_NOT_FOUND, $e->getMessage(), $e->getTrace());
            }
        });
        $this->renderable(function (ValidationException $e, Request $request) {
            if ($request->is('api/*')) {
                return $this->sendError(JsonResponse::HTTP_UNPROCESSABLE_ENTITY, $e->getMessage(), $e->getTrace());
            }
        });
        $this->renderable(function (AccessDeniedHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return $this->sendError(JsonResponse::HTTP_FORBIDDEN, $e->getMessage(), $e->getTrace());
            }
        });
        $this->renderable(function (AuthorizationException $e, Request $request) {
            if ($request->is('api/*')) {
                return $this->sendError(JsonResponse::HTTP_UNAUTHORIZED, $e->getMessage(), $e->getTrace());
            }
        });
        $this->renderable(function (InternalErrorException $e, Request $request) {
            if ($request->is('api/*')) {
                return $this->sendError(JsonResponse::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage(), $e->getTrace());
            }
        });
        $this->renderable(function (BadRequestHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return $this->sendError(JsonResponse::HTTP_BAD_REQUEST, $e->getMessage(), $e->getTrace());
            }
        });
        $this->renderable(function (UnauthorizedException $e, Request $request) {
            if ($request->is('api/*')) {
                return $this->sendError(JsonResponse::HTTP_UNAUTHORIZED, $e->getMessage(), $e->getTrace());
            }
        });
        $this->renderable(function (UnauthorizedHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return $this->sendError(JsonResponse::HTTP_UNAUTHORIZED, $e->getMessage(), $e->getTrace());
            }
        });
        $this->renderable(function (AuthenticationException  $e, Request $request) {
            if ($request->is('api/*')) {
                return $this->sendError(JsonResponse::HTTP_FORBIDDEN, $e->getMessage(), $e->getTrace());
            }
        });
    }
}
