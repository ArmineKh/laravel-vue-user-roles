/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// const { default: store } = require('./store');

require('./bootstrap');
window.Vue = require('vue').default;
import axios from 'axios';
import VueAxios from 'vue-axios';
import Auth from './Auth.js';

Vue.prototype.auth = Auth;
Vue.use(VueAxios, axios);

import App from './app.vue';
import router from './router/index';


const app = new Vue({
    el: '#app',
    router,
    render: h => h(App),
});