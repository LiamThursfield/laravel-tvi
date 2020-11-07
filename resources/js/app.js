require('./bootstrap');

import Vue from 'vue';
import { store } from './store/admin'

import { App, plugin } from '@inertiajs/inertia-vue'
Vue.use(plugin);

require('./plugins/inertia-progress');
require('./plugins/toasted');
require('./plugins/vue-cookies');
require('./plugins/vue-meta');
require('./plugins/ziggy');

require('./mixins/page-error');

require('./component-registration');


const el = document.getElementById('app');
new Vue({
    store,
    render: h => h(App, {
        props: {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: name => import(`./pages/${name}`).then(module => module.default),
        },
    }),
}).$mount(el);
