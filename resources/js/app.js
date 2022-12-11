/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')
import axios from 'axios'
import VueAxios from 'vue-axios'
import { createApp } from 'vue'
import statIndex from './pages/statistic/Index'
import AccessToken from "./components/AccessToken";

import store from './store'
const app = createApp({})
app.component('stat-index', statIndex)
app.component('access-token', AccessToken)
axios.defaults.withCredentials = true;
app.use(store);
app.use(VueAxios, axios)
app.mount('#app')

