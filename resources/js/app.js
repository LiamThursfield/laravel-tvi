/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import { InertiaApp } from '@inertiajs/inertia-vue';
import Vue from 'vue';

Vue.use(InertiaApp);

// Add ziggy route helper
Vue.prototype.$route = (...args) => route(...args).url();

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

/**
 * Global component imports
 */

// App Components
Vue.component('app-layout', require('./layouts/app/AppLayout.vue').default);

// Admin Components
Vue.component('admin-layout', require('./layouts/admin/AdminLayout.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = document.getElementById('app');

new Vue({
    render: h => h(InertiaApp, {
        props: {
            initialPage: JSON.parse(app.dataset.page),
            resolveComponent: name => import(`./pages/${name}`).then(module => module.default),
        },
    }),
}).$mount(app);
