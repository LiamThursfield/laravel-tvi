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
Vue.prototype.$routeCurrent = (...args) => route().current(...args);

Vue.mixin({
    methods: {
        /**
         * Check whether a user has a given permission
         * @param permission - dot notation permission e.g. users.view
         * @returns {boolean}
         */
        userCan(permission = '') {
            try {
                if (this.$page.auth.user.super) {
                    return true;
                }

                // Get the value of the permission - if set
                let result =  permission.split('.').reduce(function(prev, curr) {
                    return prev ? prev[curr] : null
                }, this.$page.auth.user.permissions || self);

                // Parse the result as a bool
                return !!result;
            } catch (e) {
                return false;
            }
        }
    }
})

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
Vue.component('admin-layout', require('./layouts/admin/AdminLayout.vue').default);
Vue.component('auth-layout', require('./layouts/auth/AuthLayout.vue').default);
Vue.component('website-layout', require('./layouts/website/WebsiteLayout.vue').default);

// Admin
Vue.component('side-menu', require('./components/admin/menus/SideMenu.vue').default);
Vue.component('top-menu', require('./components/admin/menus/TopMenu.vue').default);

// Icons
// Autoload any icons inside /components/core/icons
const iconFiles = require.context('./components/core/icons', true, /\.vue$/i);
iconFiles.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], iconFiles(key).default));

// Core
Vue.component('pagination', require('./components/core/pagination/Pagination.vue').default);

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
