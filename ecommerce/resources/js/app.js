// Require Vue

/*window.Vue = '';
define(function (require) {
    window.Vue = require('vue');
});*/

import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

/*// Register Vue Components
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
*/

import App from './components/App.vue';
import HomeCompoent from './components/HomeComponent.vue';
import LoginComponent from './components/LoginComponent.vue';
import SeachComponent from './components/SearchComponent.vue';
 
export const routes = [
    {
        name: 'home',
        path: '/home',
        component: HomeCompoent
    },
    {
        name: 'login',
        path: '/login',
        component: LoginComponent
    },
    {
        name: 'search',
        path: '/search',
        component: SeachComponent
    }
];



const router = new VueRouter({
    mode: 'history',
    routes: routes
});


// Initialize Vue
const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App),
});