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

    contatti:[],
};

const getters = {

    allContatti: (state) => (state.contatti), 

};

const actions = {

    async fetchContatti({commit},t)
    {
        var config = {
            headers:{
                Authorization: 'bearer '+ t
            }
        };

        const response= await axios.get(process.env.VUE_APP_API_URL+'/contatti',config);

        commit('setContatti',response.data.sections)
    }

};

const mutations = {

    setContatti: (state, con) => (state.contatti=con)

};

export default{
    state,
    getters,
    actions,
    mutations
};
