<?php

namespace App\Http\Responses;

use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use Symfony\Component\HttpFoundation\Response;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;


class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param Request $request
     * @return Response
     */
    public function toResponse($request) {
        return $request->wantsJson()
            ? response()->json([
                'message' => 'Successfully logged-in!',
                'user' => $request->user()->only('id', 'name', 'email') ?: null,
            ], 201)
            : redirect()->intended(Fortify::redirects('login'))->with('success', 'Welcome back!');
    }
}