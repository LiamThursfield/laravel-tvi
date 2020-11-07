import Vue from "vue";


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
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
