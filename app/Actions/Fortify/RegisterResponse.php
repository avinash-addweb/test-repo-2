<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\JsonResponse;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;
use Laravel\Fortify\Fortify;

class RegisterResponse implements RegisterResponseContract
{
    private $guard;

    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

    public function toResponse($request){
        $this->guard->logout(); // logs out the session
        if($request->wantsJson()) {
            return response()->json([
                'code' => 200,
                'message' => __("You are successfully registered."),
                'data' => []
            ],200);
        }
        return redirect()->intended(Fortify::redirects('register'));
    }
}