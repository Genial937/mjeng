<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;


class TokenEntrustAbility extends BaseMiddleware
{
    public function handle($request, Closure $next, $roles, $permissions, $validateAll = false)
    {

        if (!$token = $this->auth->setRequest($request)->getToken()) {
            //  return $this->respond('tymon.jwt.absent', 'token_not_provided', 400);
            return response()->json([
                'success' => false,
                'error' => 'token_not_provided',
            ], \Illuminate\Http\JsonResponse::HTTP_BAD_REQUEST);
        }

        try {
            $user = $this->auth->authenticate($token);
        } catch (TokenExpiredException $e) {
            // return $this->respond('tymon.jwt.expired', 'token_expired', $e->getStatusCode(), [$e]);
            return response()->json([
                'success' => false,
                'error' => 'something went wrong',
                'exception' => $e->getMessage()
            ], \Illuminate\Http\JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        } catch (JWTException $e) {
            // return $this->respond('tymon.jwt.invalid', 'token_invalid', $e->getStatusCode(), [$e]);
            return response()->json([
                'success' => false,
                'error' => 'something went wrong',
                'exception' => $e->getMessage()
            ], \Illuminate\Http\JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        if (!$user) {
            return response()->json([
                'success' => false,
                'error' => 'user_not_found',
            ], \Illuminate\Http\JsonResponse::HTTP_NOT_FOUND);
        }

        if (!$request->user()->ability(explode('|', $roles), explode('|', $permissions), array('validate_all' => $validateAll))) {
            //return $this->respond('tymon.jwt.invalid', 'token_invalid', 401, 'Unauthorized');
            return response()->json([
                'success' => false,
                'error' => 'Unauthorized access',
            ], \Illuminate\Http\JsonResponse::HTTP_UNAUTHORIZED);
        }


        // $this->events->fire('tymon.jwt.valid', $user);

        return $next($request);
    }
}
