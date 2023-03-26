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
 
import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import VueAnalytics from 'vue-analytics';

if('serviceWorker' in navigator){
    navigator.serviceWorker
      .register('/sw.js')
      .then(function(){
        console.log("Service Worker registered.")
      });
  }

Vue.config.productionTip = false

Vue.use(require('vue-moment'));

Vue.use(VueAnalytics, {
  id: '261466641',
  router
});

new Vue({
  store,
  router,
  render: h => h(App)
}).$mount('#app')
