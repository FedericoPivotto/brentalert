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
 
/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// API route group
$router->group(['prefix' => 'api'], function () use ($router) {
    // POST method
        // Matches "/api/register
        $router->post('register', 'UserController@register');

        // Matches "/api/login
        $router->post('login', 'AuthController@login');

        // Matches "api/bot
        $router->post('bot', 'BotController@sendMessage');

        // Matches "api/addResident
        $router->post('addResident', 'ContactController@addResident');

    // GET method
        // Matches "/api/logout
        $router->get('logout', 'AuthController@logout');

        // Matches "/api/refresh
        $router->get('refresh', 'AuthController@refresh');

        // Matches "/api/profile
        $router->get('profile', 'UserController@profile');

        // Matches "/api/users/1 
        // get one user by id
        $router->get('users/{id}', 'UserController@singleUser');

        // Matches "/api/users
        $router->get('users', 'UserController@allUsers');

        // Matches "api/brentalevel
        $router->get('brentalevel', 'BrentaController@brentaLevel');

        // Matches "api/contatti
        $router->get('contatti', 'ContactController@getContacts');

    // PUT method
        // Matches "/api/password/1 
        // get one user by id
        /* $router->put('password/{id}', 'UserController@modifyPassword'); */
});
