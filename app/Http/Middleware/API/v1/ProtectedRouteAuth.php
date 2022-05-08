<?php

namespace App\Http\Middleware\API\v1;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProtectedRouteAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try{
            $user = JWTAuth::parseToken()->authenticate();
        }
        catch(\Exception $e) {
            if($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['status' => 'Token inválido'], 401);
            }else if($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(['status' => 'Token expirado'], 401);
            }else{
                return response()->json(['status' => 'Autorização de Token não encontrada']);
            }
        }
        return $next($request);
    }
}
