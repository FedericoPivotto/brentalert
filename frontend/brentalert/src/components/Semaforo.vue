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
<div class="d-flex justify-content-center mb-2">
    <div 
    v-bind:class="{
        'high':this.allStats.stato=='Elevata',
        'medium':this.allStats.stato=='Moderata',
        'low':this.allStats.stato=='Ordinaria',
        'very_low':this.allStats.stato=='Assente' || this.allStats.stato=='caricamento' }"
    class="brenta"></div>

    <div class="d-flex flex-column mb-2">
      <!-- Se supera gli 800m^3 -->
        <div v-if="this.allStats.stato=='Pericolo'" v-bind:class="{'p-shine':this.allStats.stato=='Pericolo'}" class="circle purple"></div>
        <div v-bind:class="{'r-shine':this.allStats.stato=='Elevata'}" class="circle red"></div>
        <div v-bind:class="{'o-shine':this.allStats.stato=='Moderata'}" class="circle orange"></div>
        <div v-bind:class="{'y-shine':this.allStats.stato=='Ordinaria'}" class="circle yellow"></div>
        <div v-bind:class="{'g-shine':this.allStats.stato=='Assente'}" class="circle green"></div>
    </div>
</div>
</template>

<script>

import {mapGetters} from 'vuex';

export default {

    name: 'Semaforo',

    computed:
    {
        ...mapGetters(['allStats'])
    }
}
</script>

<style>

</style>
