<?php

namespace App\Exceptions;

use App\Traits\ApiResponser;
use Exception;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    use ApiResponser;
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * @param Exception $exception
     * @return \Illuminate\Http\JsonResponse|Response|\Laravel\Lumen\Http\ResponseFactory|void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        if ($exception instanceof HttpException) {
            $code = $exception->getStatusCode();
            $message = Response::$statusTexts[$code];

            return $this->errorResponse($message, $code);
        }

        if ($exception instanceof ModelNotFoundException) {
            $model = strtolower(class_basename($exception->getModel()));

            return $this->errorResponse("Does not exist any instance of {$model} with the given ID", Response::HTTP_NOT_FOUND);
        }

        if ($exception instanceof AuthorizationException) {

            return $this->errorResponse($exception->getMessage(), Response::HTTP_FORBIDDEN);
        }

        if ($exception instanceof AuthenticationException) {

            return $this->errorResponse($exception->getMessage(), Response::HTTP_UNAUTHORIZED);
        }

        if ($exception instanceof ValidationException) {

            $errors = $exception->validator->errors()->getMessages();

            return $this->errorResponse($errors, Response::HTTP_INTERNAL_SERVER_ERROR);
        }


        if ($exception instanceof ClientException) {
            $message = $exception->getResponse()->getBody();
            $code = $exception->getCode();
            return $this->errorMessage($message, $code);
        }

        if (env('APP_DEBUG', false)) {
            return parent::report($exception);
        }

        return $this->errorResponse('Unexpected error, Try later', Response::HTTP_UNPROCESSABLE_ENTITY);

    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }
}
