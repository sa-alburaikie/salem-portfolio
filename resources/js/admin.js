import './bootstrap';

import { createApp } from 'vue';
import Swal from 'sweetalert2';
window.Swal = Swal;
const toast = Swal.mixin({
    toast:true,
    position:'top-end',
    showConfirmButton:false,
    timer:3000
});
window.toast = toast;

import admin from './components/Admin.vue';
import router from './route';

createApp(admin).use(router).mount("#admin");
