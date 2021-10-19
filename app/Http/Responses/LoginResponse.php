<?php
namespace App\Http\Responses;
use Laravel\Fortify\Contracts\LoginResponse as ContractsLoginResponse;

class LoginResponse implements ContractsLoginResponse
{
    public function toResponse($request)
    {
        if (auth()->user()->hasRole(['user'])) {
            return redirect()->intended(config('fortify.home'));
        } else if(auth()->user()->hasRole(['super-admin'])) {
            return redirect()->intended(config('fortify.dashboard'));
        }
    }
}
