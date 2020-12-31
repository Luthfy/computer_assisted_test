require('./bootstrap');

import Vue from 'vue';
import App from './layouts/App.vue'
import router from './router'
import Store from './Store/index'
import 'quasar/dist/quasar.min.css'
import Quasar from 'quasar/dist/quasar.umd.min'
import VueCountdown from '@chenfengyuan/vue-countdown';

Vue.use(Quasar)
Vue.component(VueCountdown.name, VueCountdown)

async function start(){
    const app = new Vue({
        router,
        el: '#app',
        store: Store,
        render: h => h(App)
    });
}

start()

