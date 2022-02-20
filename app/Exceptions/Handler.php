<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    //Para tener los mensajes de errores con valores como res y es español
    protected function invalidJson($request, ValidationException $exception)
    {
        return response()->json([
            'res' => __('Los datos proporiconados no son válidos.'),
            'errores' => $exception->errors(),
        ], $exception->status);
    }

    //Para tener el error en formato Json por ejemplo cuando no se encuentra el modelo
    public function render($request, Throwable $exception)
    {
        if($exception instanceof ModelNotFoundException){
            return response()->json([
                "res" => false, 
                "msg" => "Error modelo no encontrado"
            ], 400);
        }

        if($exception instanceof RouteNotFoundException){
            return response()->json([
                "res" => false,
                "msg" => "No tiene permiso para acceder a esta ruta"
            ], 401);
        }

        return parent::render($request, $exception);
    }
}
