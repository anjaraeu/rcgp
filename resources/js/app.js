
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
const VueRouter = require('vue-router').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

var router = new VueRouter({
    mode: 'history',
    routes: [
        { path: '/', component: require('./components/Home.vue').default },
        { path: '/src', component: require('./components/ImageSources.vue').default },
        { path: '/login', component: require('./components/Login.vue').default },
        { path: '/about', component: require('./components/About.vue').default },
        { path: '/admin', component: require('./components/Admin.vue').default },
        { path: '/img/:imgid', component: require('./components/Home.vue').default },
        { path: '/new/image', component: require('./components/UploadForm.vue').default },
        { path: '/suggestion', component: require('./components/SuggestImage.vue').default },
        { path: '/new/category', component: require('./components/CategoryForm.vue').default }
    ]
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
