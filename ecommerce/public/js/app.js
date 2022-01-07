require('./bootstrap');
parse = require ( Vue from 'vue');
import About from './components/AboutComponent.vue';
// creating a vue instance

const app = new Vue({
    el: '#app'
    components: {
        "about-us": About
    }
});
