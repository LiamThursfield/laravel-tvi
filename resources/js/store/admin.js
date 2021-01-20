/**
 * Admin Store
 */

import 'es6-promise/auto'
import Vuex from 'vuex';
import Vue from 'vue';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        // File Manager Modal
        isFileManagerModalOpen: false,
        fileManagerModalCallback: null,

        // Mobile Side Menu
        isMobileSideMenuOpen: false,
    },
    mutations: {
        // File Manager Modal
        closeFileManagerModal(state) {
            state.isFileManagerModalOpen = false;
            state.fileManagerModalCallback = null;
        },
        openFileManagerModel(state, callback = null) {
            state.isFileManagerModalOpen = true;
            state.fileManagerModalCallback = callback;
        },

        // Mobile Side Menu
        hideMobileSideMenu(state) {
            state.isMobileSideMenuOpen = false;
        },
        showMobileSideMenu(state) {
            state.isMobileSideMenuOpen = true;
        },
        toggleMobileSideMenu(state) {
            state.isMobileSideMenuOpen = !state.isMobileSideMenuOpen;
        },
    },
    getters: {
        isFileManagerOpen: state => state.isFileManagerModalOpen,
        isMobileSideMenuOpen: state => state.isMobileSideMenuOpen,
    }
});
