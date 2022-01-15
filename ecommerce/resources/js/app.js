// Require Vue

/*window.Vue = '';
define(function (require) {
    window.Vue = require('vue');
});*/

import Vue from 'vue';

// Register Vue Components
Vue.component('exampleComponent', require('./components/ExampleComponent.vue').default);

// Initialize Vue
const app = new Vue({
    el: '#app',
});