/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import { InertiaApp } from '@inertiajs/inertia-vue';
import Vue from 'vue';

import { store } from './store/admin'

Vue.use(InertiaApp);

// Add ziggy route helper
Vue.prototype.$route = (...args) => route(...args).url();
Vue.prototype.$routeCheck = (...args) => route().check(...args);

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

// Layouts
Vue.component('app-layout', require('./layouts/app/AppLayout.vue').default);
Vue.component('admin-layout', require('./layouts/admin/AdminLayout.vue').default);
Vue.component('auth-layout', require('./layouts/auth/AuthLayout.vue').default);

// Admin
Vue.component('side-menu', require('./components/admin/menus/SideMenu.vue').default);
Vue.component('top-menu', require('./components/admin/menus/TopMenu.vue').default);

// Icons
Vue.component('icon-close', require('./components/core/icons/IconClose.vue').default);
Vue.component('icon-hamburger-menu', require('./components/core/icons/IconHamburgerMenu.vue').default);
Vue.component('icon-home', require('./components/core/icons/IconHome.vue').default);
Vue.component('icon-settings', require('./components/core/icons/IconSettings.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = document.getElementById('app');

new Vue({
    store,
    render: h => h(InertiaApp, {
        props: {
            initialPage: JSON.parse(app.dataset.page),
            resolveComponent: name => import(`./pages/${name}`).then(module => module.default),
        },
    }),
}).$mount(app);
