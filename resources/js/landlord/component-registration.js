import Vue from "vue";


/**
 * Global component imports
 */

import { Link } from "@inertiajs/vue2";
Vue.component('inertia-link', Link);

// Layouts
Vue.component('website-layout', require('./layouts/website/WebsiteLayout.vue').default);

// Icons
// Autoload any icons inside /components/core/icons
const iconFiles = require.context('../components/core/icons', true, /\.vue$/i);
iconFiles.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], iconFiles(key).default));
