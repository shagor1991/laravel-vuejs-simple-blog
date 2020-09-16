
require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'
import {routes} from './routes'

Vue.use(VueRouter)
const router = new VueRouter({
    routes // short for `routes: routes`
})

// Markdown editor
import 'v-markdown-editor/dist/v-markdown-editor.css';
import Editor from 'v-markdown-editor'
Vue.use(Editor);

// v-select
import vSelect from 'vue-select'
Vue.component('v-select', vSelect)

// import Select2Component
import Select2 from 'v-select2-component';
Vue.component('Select2', Select2);

Vue.component('admin-master', require('./components/AdminMaster.vue').default);

import Vue from 'vue'
import { Form, HasError, AlertError } from 'vform'
window.Form= Form
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

// Sweet Alert
import Swal from 'sweetalert2'
window.Swal= Swal

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })
window.Toast= Toast

// Vuex 
import Vuex from 'vuex'
import storeData from './store'
Vue.use(Vuex)
const store = new Vuex.Store(
  storeData
)


const app = new Vue({
    router,
    el: '#app',
    store
});
