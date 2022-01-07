<?php

namespace App\Exceptions;

use Exception;

class cvException extends Exception
{
    //

    public function render(){
        if ($exception instanceof ValidationException && $request->expectsJson()) {
            return response()->json(['message' => 'The given data was invalid.', 'errors' => $exception->validator->getMessageBag()], 422);
        }
    }
}
