import Vue from "vue";
import _ from 'lodash';

Vue.mixin({
    methods: {
        clearPageErrorMessage(field) {
            try {
                this.$page.props.errors[field] = null;
            } catch (e) {
                return '';
            }
        },
        getPageErrorMessage(field) {
            try {
                let error = this.$page.props.errors[field];

                if (!error) {
                    return '';
                }

                if (Array.isArray(error)) {
                    return error[0];
                }

                return error;
            } catch (e) {
                return '';
            }
        },
        getPageErrorMessageFromArrayField(fieldSlug, toString = true) {
            try {
                let errors = [];

                _.forEach(this.$page.props.errors, (message, key) => {
                    // Ensure the error is for the array field, and the message is unique
                    if (key.indexOf(fieldSlug + '.') === 0 && errors.indexOf(message) < 0) {
                        errors.push(message);
                    }
                });

                if (toString) {
                    errors = errors.join(', ');
                }

                return errors;
            } catch (e) {
                return '';
            }
        }
    }
});
