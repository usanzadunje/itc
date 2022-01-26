<?php

namespace App\Http\Responses;

use App\Http\Resources\UserResource;
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
                'user' => new UserResource($request->user()),
            ], Response::HTTP_OK)
            : redirect()->intended(Fortify::redirects('login'))->with('success', 'Welcome back!');
    }
}