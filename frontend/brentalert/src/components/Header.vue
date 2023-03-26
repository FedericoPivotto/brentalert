<!--
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
-->

<template>
<div>
    <nav class="navbar navbar-expand-lg navbar-light">
            <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#toggle_dropdown" aria-controls="toggle_dropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            
<!--            <button v-if="user.token==''" class="btn btn-primary" href="#" id="logbtn" data-toggle="modal" data-target="#login_form">Login</button>
            <button v-else class="btn btn-warning" href="#" id="logbtn_out" data-toggle="modal" data-target="#logout_form">{{user.username}}</button>
   -->         
            <div class="collapse navbar-collapse" id="toggle_dropdown">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <router-link class="nav-link" to="/">Home</router-link>
                </li>
                <li v-if="user.token!=''" class="nav-item">
                    <router-link class="nav-link" to="/contacts">Contatti</router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" to="/about">About</router-link>
                </li>
            </ul>
        </div>
    </nav>

    <Login />

</div>
</template>

<script>

import Login from './Login'
import {mapGetters} from 'vuex'

export default {

    name:'Header',

    components:
    {
        Login,
    },

    computed: mapGetters(['user']),

}
</script>

<style>

</style>
