require('./bootstrap');

import Vue from 'vue';
import { store } from './store/admin'

import { createInertiaApp } from '@inertiajs/vue2'

require('./plugins/toasted');
require('./plugins/vue2-datepicker');
require('./plugins/vue-cookies');
require('./plugins/vue-meta');
require('./plugins/ziggy');
require('./plugins/zora');

require('./filters/date-times');
require('./filters/prices');

require('./mixins/page-error');


require('./component-registration');

const app = createInertiaApp({
    progress: {
        // The delay after which the progress bar will
        // appear during navigation, in milliseconds.
        delay: 5,

        // Whether to include the default NProgress styles.
        includeCSS: false,

        // Whether the NProgress spinner will be shown.
        showSpinner: false,

    },
    resolve: (name) => require(`./pages/${name}.vue`),
    setup({ el, App, props, plugin }) {
        Vue.use(plugin)

        new Vue({
            store,
            render: h => h(App, props),
        }).$mount(el)
    },
});
