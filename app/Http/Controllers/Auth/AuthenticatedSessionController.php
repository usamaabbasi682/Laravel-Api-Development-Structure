<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): UserResource
    {
        try {

            $request->authenticate();
            $user = $request->user();
            //$user->tokens()->delete();
            $token = $user->createToken('SPA_TOKEN_API')->plainTextToken;

            return UserResource::make(auth()->user())
                ->additional([
                    'success' => true,
                    'message' => 'User login successfully',
                    'token' => $token,
                ]);

        } catch (ValidationException $e) {

            return UserResource::make(NULL)
                ->additional([
                    'success' => false,
                    'message' => 'Email or Password is incorrect',
                ]);

        } catch (\Exception $e) {

            return UserResource::make(NULL)
                ->additional([
                    'success' => false,
                    'message' => 'Something went wrong. Please try again later.',
                ]);
        }

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): UserResource
    {
        auth()->user()->currentAccessToken()->delete();

        return UserResource::make(NULL)
            ->additional([
                'success' => true,
                'message' => 'Logout successfully',
            ]);
    }
}
