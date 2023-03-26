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
<div class="container-fluid">
<!--  <div class="d-flex justify-content-center mb-5">
    <img src="../assets/logo_small.png" alt="brentalert" class="logo-img">
    <span class="logo-text">BrentAlert</span>
  </div>
-->
  <div class="d-flex justify-content-around mb-5 ">
    <div class="d-flex flex-column justify-content-around ">
      <img src="../assets/logo_small.png" alt="brentalert" class="logo-img center">
    </div>
    <div class="d-flex flex-column justify-content-end ">
      <div class="logo-text ">BrentAlert</div>
      <div class="text-right logo-text-small">Bassano del Grappa</div>
    </div>
  </div>


  <!-- semaforo -->
  <Semaforo />

  <!-- stato -->
  <Stats />

  <!-- pulsante -->
  <div v-if="user.token" class="d-flex flex-row justify-content-center" >
    <router-link to="/contacts" class="btn btn-danger btnAlert" id="allertaButton">ALLERTA</router-link>
  </div>
  
</div>
</template>

<style>
.debug{
    border: 1px solid red;
    margin: 1px;
}
.debug1{
    border: 1px solid green;
    margin: 1px;
}
.center{
  display: block;
  margin-left: auto;
  margin-right: auto;
}


</style>
<script>

import Stats from '../components/Stats'
import Semaforo from '../components/Semaforo'
import { mapGetters } from 'vuex'

export default {
  name: 'Home',
  components: {
    Stats,
    Semaforo,
  },

  computed: mapGetters(['user']),
}
</script>
