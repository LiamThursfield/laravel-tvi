import Vue from "vue";


/**
 * Global component imports
 */

import { Link } from "@inertiajs/vue2";
Vue.component('inertia-link', Link);

// Layouts
import AdminLayout from './layouts/admin/AdminLayout.vue'
Vue.component('admin-layout', AdminLayout);
import AuthLayout from './layouts/auth/AuthLayout.vue'
Vue.component('auth-layout', AuthLayout);
import WebsiteLayout from './layouts/website/WebsiteLayout.vue'
Vue.component('website-layout', WebsiteLayout);

// Icons
// Autoload any icons inside /components/core/icons
const iconFiles = import.meta.globEager('../components/core/icons/*.vue');
Object.entries(iconFiles).forEach(([path, m]) => {
    const componentName = path.split('/').pop().split('.')[0];
    Vue.component(componentName, m.default);
});

// Core
import SideMenu from "../components/core/menus/SideMenu.vue";
Vue.component('side-menu', SideMenu);

import TopMenu from "../components/core/menus/TopMenu.vue";
Vue.component('top-menu', TopMenu);

import Pagination from "../components/core/pagination/Pagination.vue";
Vue.component('pagination', Pagination);

import LogoLight from "../components/core/logos/LogoLight.vue";
Vue.component('logo-light', LogoLight);

