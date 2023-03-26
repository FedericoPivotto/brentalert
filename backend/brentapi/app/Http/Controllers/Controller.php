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
 
namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

//import auth facades
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    //Add this method to the Controller class
    protected function respondWithToken($token)
    {
        return response()->json([
            'token' 	 => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
            'function' 	 => Auth::user()->function
        ], 200);
    }
}
