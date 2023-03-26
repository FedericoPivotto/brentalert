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
  <div class="d-flex flex-column">
    <div class="d-flex flex-row-reverse justify-content-center mb-3">
      <div class="element-name text-center" id="livello-idrometrico">{{this.allStats.livello}} m</div>
      <div class="row-name text-left">Livello</div>
    </div>

    <div class="d-flex flex-row-reverse justify-content-center mb-3">
      <div class="element-name text-center" 
      id="portata" 
      v-html="this.allStats.portata + ' m<sup>3</sup>/s'"></div>
      <div class="row-name text-left">Portata</div>
    </div>

    <div class="d-flex flex-row-reverse justify-content-center mb-1">
      <div class=" element-name text-center" id="stato">{{this.allStats.stato}}</div>
      <div class=" row-name text-left">Criticità</div>
    </div>

      <div class="d-flex row justify-content-center updates mt-3 text-center">
        Ultimo rilevamento Brenta a Barzizza: <br> {{this.allStats.ora_update}} Ora Solare
      </div>
  </div>
</template>

<script>

import {mapGetters,mapActions} from 'vuex';

export default {

    name: 'Stats',

    methods:
    {
      ...mapActions(['fetchStats'])
    },

    computed:
    {
      ...mapGetters(['allStats']),
    },

    created()
    {
      this.fetchStats();
    }
}
</script>

<style>

</style>
