<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use Symfony\Component\HttpFoundation\Response;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param Request $request
     * @return Response
     */
    public function toResponse($request): Response {

        return $request->wantsJson()
            ? response()->json([
                'message' => 'Successfully registered!',
                'user' => $request->user()->only('id', 'name', 'email') ?: null,
            ], 201)
            : redirect()->intended(Fortify::redirects('register'))->with('success', 'Successfully registered, welcome!');
    }
}