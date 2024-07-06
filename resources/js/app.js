import Vue from 'vue';
import App from './App.vue';
import router from './router';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css'
import 'bootstrap';

// import { library } from '@fortawesome/fontawesome-svg-core'

// require("bootstrap-css-only/css/bootstrap.min.css");
// require("mdbvue/lib/css/mdb.min.css");
require("@fortawesome/fontawesome-free/css/all.min.css");

// import * as mdbvue from 'mdbvue'
// for (const component in mdbvue) {
//   Vue.component(component, mdbvue[component])
// }

import BootstrapVue from 'bootstrap-vue';
import FlashMessage from '@smartweb/vue-flash-message';
Vue.use(BootstrapVue);
Vue.use(FlashMessage);





new Vue({
    el: '#app',
    router,
    render: h => h(App)
});
