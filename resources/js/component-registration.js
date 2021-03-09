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
Vue.component('content-editor', require('./components/admin/cms/content/ContentEditor.vue').default);

// Icons
// Autoload any icons inside /components/core/icons
const iconFiles = require.context('./components/core/icons', true, /\.vue$/i);
iconFiles.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], iconFiles(key).default));

// Core
Vue.component('pagination', require('./components/core/pagination/Pagination.vue').default);
Vue.component('logo-light', require('./components/core/logos/LogoLight.vue').default);
