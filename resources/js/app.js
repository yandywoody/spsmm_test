require('./bootstrap');
window.Vue = require('vue').default;

import App from './components/App.vue';
import VueAxios from 'vue-axios';
import VueRouter from 'vue-router';
import axios from 'axios';
import {
    routes
} from './routes';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);

import Swal from 'sweetalert2'
window.Swal = Swal
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
window.Toast = Toast

// import Select2Component
import select2 from 'v-select2-component';
Vue.component ('select2', select2);

import Datepicker from 'vuejs-datepicker'
Vue.component ("Datepicker", Datepicker);

import Datetimepicker from "vue-datetime-picker";
Vue.component ("vue-datetime-picker", Datetimepicker);

Vue.prototype.$base_url_api = "http://localhost:8000/api/";

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App),
});