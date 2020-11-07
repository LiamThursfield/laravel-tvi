// Add ziggy route helper
import Vue from "vue";

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
                if (this.$page.props.auth.user.super) {
                    return true;
                }

                // Get the value of the permission - if set
                let result =  permission.split('.').reduce(function(prev, curr) {
                    return prev ? prev[curr] : null
                }, this.$page.props.auth.user.permissions || self);

                // Parse the result as a bool
                return !!result;
            } catch (e) {
                return false;
            }
        },

        /**
         * Check whether a user has all of the given permissions
         * @param {array} permissions - array of dot notation permissions e.g. [users.view]
         * @returns {boolean}
         */
        userCanAll(permissions= []) {
            try {
                if (permissions.length === 0) {
                    return true;
                }

                let hasAllPermissions = true;

                permissions.forEach(permission => {
                    if (!this.userCan(permission)) {
                        hasAllPermissions = false;
                    }
                });

                return hasAllPermissions;
            } catch (e) {
                return false;
            }
        },

        /**
         * Check whether a user has any of the given permissions
         * @param {array} permissions - array of dot notation permissions e.g. [users.view]
         * @returns {boolean}
         */
        userCanAny(permissions= []) {
            try {
                if (permissions.length === 0) {
                    return true;
                }

                let hasAnyPermission = false;

                permissions.forEach(permission => {
                    if (this.userCan(permission)) {
                        hasAnyPermission = true;
                    }
                });

                return hasAnyPermission;
            } catch (e) {
                return false;
            }
        }
    }
})
