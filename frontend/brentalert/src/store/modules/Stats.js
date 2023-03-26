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

import axios from "axios";
import moment from "moment";

const state = {

    stats:
    {
        livello:0,
        portata:0,
        stato:'caricamento',
        ora_update: ''
        // ora_update:'22/04/2020 14:30'
    }

};

const getters = {

    allStats: (state) => (state.stats),

    getLiv: (state) => (state.stats.livello),

    getPort: (state) => (state.stats.portata),

    getStato: (state) => (state.stats.stato),

    getUpd: (state) => (state.stats.ora_update),

};

const actions = {

    async fetchStats({commit})
    {
        var liv = 0;
        var port= 0;
        var dNow = new Date();

        // console.log(process.env);
        const response = await axios.get(process.env.VUE_APP_API_URL+'/brentalevel')

        let json_data = response.data;
        // console.log(json_data);

        if (json_data.STAZIONE.SENSORE[0].PARAMNM == "Livello idrometrico") {
            var sensoreL = json_data.STAZIONE.SENSORE[0];
            for (var i = sensoreL.DATI.length - 1; i >= 0; i--) {
                if (!isNaN(sensoreL.DATI[i].VM)) {
                    liv = sensoreL.DATI[i].VM;
                    var d_ist = sensoreL.DATI[i]["@attributes"].ISTANTE;
                    window.sessionStorage.setItem('ora_update',d_ist);
                    dNow = moment(d_ist, "YYYYMMDDhhmm");
                    break;
                }
            }
        }

        if (json_data.STAZIONE.SENSORE[1].PARAMNM == "Portata") {
            var sensoreP = json_data.STAZIONE.SENSORE[1];
            for (var k = sensoreP.DATI.length - 1; k >= 0; k--) {
                if (!isNaN(sensoreP.DATI[k].VM)) {
                    port = Math.round(sensoreP.DATI[k].VM);
                    //var d_ist = sensore.DATI[i]["@attributes"].ISTANTE;
                    //dNow = moment(d_ist, "YYYYMMDDhhmm");
                    break;
                }
            }
        }

        commit('setStats',{l:liv,p:port,d:dNow});
    }

};

const mutations = {

    setStats: (state,data) =>
    {   
        state.stats.livello=data.l;
        state.stats.portata=data.p;
        state.stats.ora_update=data.d.format('DD[/]MM[/]YYYY [-] HH:mm');

      //nuovi dati
      //Stato --> criticità
        if(state.stats.livello >= 3.5)
          state.stats.stato='Pericolo' //viola
        else if(state.stats.livello < 3.5 && state.stats.livello >= 3.20)
          state.stats.stato='Elevata' //rosso
        else if(state.stats.livello < 3.20 && state.stats.livello >= 2.80)
            state.stats.stato='Moderata' //arancio
        else if(state.stats.livello < 2.80 && state.stats.livello >= 2.30)
            state.stats.stato='Ordinaria'   //giallo
        else
            state.stats.stato='Assente'  //verde
        
        //
        // if(state.stats.livello>=3.33)
        //     state.stats.stato='Allerta'
        //
        // else if(state.stats.livello<3.33 && state.stats.livello>=1.22)
        //     state.stats.stato='Instabile'
        //
        // else
        //     state.stats.stato='Sicuro'
    }

}

export default{
    state,
    getters,
    actions,
    mutations
};
