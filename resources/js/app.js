import Vue from 'vue'
import http from "./services/https";
import {
    AlertPlugin,
    ButtonPlugin,
    CardPlugin,
    FormGroupPlugin,
    FormInputPlugin,
    FormPlugin,
    ProgressPlugin
} from 'bootstrap-vue'

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.component('user-login-component', require('./components/UserLoginComponent.vue').default);
Vue.component('user-registration-component', require('./components/UserRegistrationComponent.vue').default);
Vue.component('github-token-form-component', require('./components/GithubTokenFormComponent.vue').default);

Vue.use(CardPlugin);
Vue.use(FormPlugin);
Vue.use(FormGroupPlugin);
Vue.use(FormInputPlugin);
Vue.use(ProgressPlugin);
Vue.use(ButtonPlugin);
Vue.use(AlertPlugin);

Vue.prototype.$http = http;
Vue.prototype.$user = window.User;

const app = new Vue({
    el: '#app'
})
