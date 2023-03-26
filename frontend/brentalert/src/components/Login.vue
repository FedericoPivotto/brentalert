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
    <div v-if="user.token==''" class="modal fade" id="login_form" tabindex="-1" role="dialog" aria-labelledby="login_form" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Login</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <div >
                <label class="mr-2 col-form-label">Username: </label>
                <input type="text" class="form-control" placeholder="Username" v-model="user.username"/>
            </div>

            <div >
                <label class="mr-2 col-form-label">Password: </label>
                <input type="password" class="form-control" placeholder="Password" v-model="user.password"/>
            </div>

            <div class="text-center" style="margin-top: 20px;">
                <button type="button" class="btn btn-primary" id="log" data-dismiss="modal" aria-label="Close" 
                @click.prevent="login">
                Accedi
                </button>
            </div>
            </div>

        </div>
        </div>
    </div>

    <div v-else class="modal fade" id="logout_form" tabindex="-1" role="dialog" aria-labelledby="login_form" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">{{user.username}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            Conferma uscita

            <div class="text-center" style="margin-top: 20px;">
                <button @click="logout" type="button" class="btn btn-primary" id="logOut" data-dismiss="modal" aria-label="Close">
                    Logout
                </button>
                <button type="button" class="btn btn-danger"  data-dismiss="modal" aria-label="Close">
                Annulla
                </button>

            </div>
            </div>
        </div>
        </div>
    </div>

</div>
</template>

<script>

import {mapGetters, mapActions} from 'vuex';
import router from '../router';

export default {

    name:'Login',

    data()
    {
        return{
            failed:false,
            loading:false,
            prolongue:false
        }
    },

    computed: mapGetters(['user']),

    methods:
    {
        ...mapActions(['accedi','esci','already_logged']),

        async login()
        {   
            this.failed=false;
            this.loading=!this.loading;

            try
            {
                await this.accedi(this.user); //aspetta che questa funzione sia eseguita per proseguire
            }
            catch(err)
            {
                this.failed=true;
            }

            this.loading=!this.loading;
        },

        logout()
        {  
           this.esci(this.user); 

           if(this.$route.name=='Contatti')
            router.push("/");
        },

        /*exp_check()
        {   
            var t=sessionStorage.getItem('token');
            var at=sessionStorage.getItem('issued_at');
            var exp=sessionStorage.getItem('expires_in');

            var rem=exp-((Date.now()-at)/1000);
            //console.log(rem);
            
            //richiede la prolunga la sessione un'ora prima dalla scadenza
            /*if(t!=null && t!=undefined)
                window.setTimeout(()=>{ 
                    this.prolongue=!this.prolongue; 
                    bus.$emit('set-blur', this.prolongue); 
                }, rem*1000-(3600000));
        },*/
    },

    created()
    {
        //se c'è il token nel session storage quando viene aggiornata la pagina
        if(sessionStorage.getItem('token')!=null && sessionStorage.getItem('token')!=undefined)
            this.already_logged();
    }

}
</script>

<style>

</style>
