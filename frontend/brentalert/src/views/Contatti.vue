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
  <!-- titolo -->
    <div class="d-flex justify-content-center mb-5">
      <span class="logo-text">Contatti</span>
    </div>

    <!-- contenuto -->
    <div id="messOk" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
      Messaggio inviato correttamente
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

    <div id="messKo" class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
      Messaggio non inviato
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

    <div class="accordion">
        <div v-bind:key="index"  v-for="(sez,index) in allContatti">
            <Contatto  :sezione="sez" />
        </div>
    </div>

  

    <div class="container-fluid">
      <div class="flex-row">
        <p id="result">&nbsp;</p>
      </div>
    </div>

</div>

</template>

<script>

import Contatto from '../components/Contatto'
import {mapActions, mapGetters} from 'vuex'

export default {

    name:'Contatti',

    components:
    {
        Contatto,
    },

    methods:
    {
        ...mapActions(['fetchContatti'])
    },

    computed: mapGetters(['allContatti','user']),

    created()
    {
        this.fetchContatti(this.user.token);
    }
}
</script>

<style scoped>

.dropbtn
{
    height:100%;
    width:100%;
    background-color: #3d52d5;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    border:none;
    border-radius: 3.5px;
    cursor: pointer;
    color: #fff;
}

.dropdown-content
{
    display: flex;
    position: relative;
    left:20px;
    background-color: #FBFFF1;
    width: 275px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    opacity: 0;
    font-size: 0px;
    transition: opacity 400ms ease-in-out;
    border-radius:5px;
}

.show
{
    font-size:18px;
    display:block;
    opacity: 1;
}

.dropdown-content p
{
    color: black;
    padding: 12px 12px;
    text-decoration: none;
    font-family: Roboto;
}

.dropdown-content p:hover
{
    background-color: #ddd;
}

.rotate
{
    transition: all 500ms ease-in-out;
}

.down
{
    animation: rotate(90deg);
}

</style>
