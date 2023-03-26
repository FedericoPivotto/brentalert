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

import axios from 'axios';

const state = {

    user:
    {
        username: "",
        password: "",
        token:"",
        token_type:"",
        expires_in:"",
        function:"Cittadino",
    }

};

const getters = {

    //ritorna l'utente ed i suoi dati
    user: (state) => (state.user), 

};

const actions = {

    already_logged({commit})
    {
        commit('setUser');
    },

    /*async refresh({commit},u)
    {
        var config = {
            headers:{
                Authorization: 'bearer '+ u.token
            }
        };

        try{
            const response= await axios.get(process.env.VUE_APP_API_URL+'auth/refresh', config);

            console.log(response);
            window.sessionStorage.setItem('token',response.data.token);
            window.sessionStorage.setItem('funzione',response.data.funzione);
            window.sessionStorage.setItem('username',u.username);
            window.sessionStorage.setItem('token_type',response.data.token_type);
            window.sessionStorage.setItem('expires_in',response.data.expires_in);
            window.sessionStorage.setItem('issued_at',Date.now());

            commit('setUser');
        }
        catch(error){
            console.log(error);
        }
    },*/

    async accedi({commit},u){ 
        
        try{
          const response= await axios.post(process.env.VUE_APP_API_URL+'/login' , {
                username:u.username,
                password:u.password
            });
            
            console.log(response);

            window.sessionStorage.setItem('token',response.data.token);
            window.sessionStorage.setItem('function',response.data.function);
            window.sessionStorage.setItem('username',u.username);
            window.sessionStorage.setItem('token_type',response.data.token_type);
            window.sessionStorage.setItem('expires_in',response.data.expires_in);
            window.sessionStorage.setItem('issued_at',Date.now());
            commit('setUser');
        }

        catch(error){
            console.log(error);
        } 
    },

    async esci({commit},u){ 

        var config = {
            headers:{
                Authorization: 'bearer '+ u.token
            }
        };

        try{
            const response= await axios.get(process.env.VUE_APP_API_URL+'/logout', config);
            console.log(response);
            commit('uscitaUtente');
            window.sessionStorage.removeItem('token');
            window.sessionStorage.removeItem('function');
            window.sessionStorage.removeItem('username');
            window.sessionStorage.removeItem('token_type');
            window.sessionStorage.removeItem('expires_in');
            window.sessionStorage.removeItem('issued_at',Date.now());
        }

        catch(error){
            console.log(error.response);
        }
        
    },

};

const mutations = {

    setUser: (state) => {
        state.user.token=window.sessionStorage.getItem('token');
        state.user.username=window.sessionStorage.getItem('username');
        state.user.token_type=window.sessionStorage.getItem('token_type');
        state.user.expires_in=window.sessionStorage.getItem('expires_in');
        state.user.function=window.sessionStorage.getItem('function');
    },

    uscitaUtente: (state) => {
        state.user.username='';
        state.user.password='';
        state.user.token='';
        state.user.token_type='';
        state.user.expires_in='';
        state.user.function='';
    }

};

export default{
    state,
    getters,
    actions,
    mutations
};
