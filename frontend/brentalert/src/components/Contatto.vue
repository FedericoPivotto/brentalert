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

<div class="card">
    <div class="card-header contatto-header" @click="toggle=!toggle">
    <span class="mb-0">
        {{sezione.sectionName}}
    </span>
    </div>

    <transition name="contact-appear">
    <div v-if="toggle" >
        <div v-bind:key="index"  v-for="(c,index) in sezione.contacts" class="card-body contatto-body">
            <div class="d-flex justify-content-between" >
                <span> {{c.name}} </span>
                <span class="text-right">
                    <i class="fa fa-phone call"></i> |
                    <i @click="sendMsg(c)" class="fab fa-telegram-plane"></i>
                </span>
            </div>
            <!--<a href="tel:{{this.data.telephone}}"><i class="fa fa-phone call"></i></a> | 
            <i onclick="msg({{json this}})" class="fab fa-telegram-plane"></i></span></div>-->
        </div>
    </div>
    </transition>
</div>


</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import axios from 'axios';

export default {

    name:'Contatto',
    props:['sezione'],

    data(){

        return{

            toggle:false,
        }
    },

    computed: mapGetters(['allStats','user']),

    methods:
    {
        ...mapActions(['summonBot']),

        async sendMsg(c)
        {
            var config = {
                headers:{
                    Authorization: 'bearer '+ this.user.token
                }
            };

            var toSend={
                name:c.name,
                chatID:c.data.chatID,
                idroLevel:this.allStats.livello,
                idroMaxLevel:3.33,
                idroDate:window.sessionStorage.getItem('ora_update'),
            }

            console.log(toSend)
            const response= await axios.post("https://brentalert2020.altervista.org/api/brentalert_v2/backend/brentapi/public/index.php/api/bot",toSend,config);
            console.log(response);
            
        }
    }
}
</script>

<style>

.contact-appear-enter-active
{
    animation: appear 250ms ease-in-out;
}

.contact-appear-leave-active
{
    animation: appear 250ms ease-in-out reverse;
}

@keyframes appear
{
    0%
    {
        opacity: 0;
    }

    100%
    {
        opacity: 1;
    }
}


.contatto-header
{
    font-family: bodyFontBlack;
    background-color: #3d52d5;
    color: white;
    font-size: 25px;
}
.contatto-header .btn
{
    color: white;
    text-align: center;
    width: 100%;
}
.contatto-body a
{
    color: black;
}

</style>
