<?php
/*
 * Copyright (C) 2021 ITIS "E. Fermi", Bassano del Grappa (VI) Italy
 * Please refer to the AUTHORS file for more information.
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 */
 
namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class UfficioTecnicoAuthorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            // Access token from the request
            $token = JWTAuth::parseToken();
            // Try authenticating user
            $user = $token->authenticate();

        } catch (TokenExpiredException $e) {
            // Thrown if token has expired
            return $this->unauthorized('Your token has expired. Please, login again.');

        } catch (TokenInvalidException $e) {
            // Thrown if token invalid
            return $this->unauthorized('Your token is invalid. Please, login again.');

        } catch (JWTException $e) {
            // Thrown if token was not found in the request.
            return $this->unauthorized('Please, attach a Bearer Token to your request');

        } // If user was authenticated successfully and user is in one of the acceptable roles, send to next request.

        if( $user && $user->function == 'Ufficio Tecnico' ) {
            return $next($request);
        }

        return response()->json(['message' => 'Permission denied'], 401);
    }
}
