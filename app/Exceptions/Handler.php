<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Routing\Exceptions\InvalidSignatureException;

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
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (InvalidSignatureException $e) {
            $notification = array(
                'message' => 'Your request is not valid',
                'alert-type' => 'error'
            );
            return redirect()->route('verification.notice')->with($notification);
        });

        $this->renderable(function (\Exception $e) {
            if ($e->getPrevious() instanceof \Illuminate\Session\TokenMismatchException) {
                $notification = array(
                    'message' => 'Something went wrong',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
        });
    }
}
