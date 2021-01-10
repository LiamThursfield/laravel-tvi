import Vue from "vue";

Vue.mixin({
    methods: {
        clearPageErrorMessage(field) {
            try {
                console.log('here');
                this.$page.props.errors[field] = null;
            } catch (e) {
                return;
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
        }
    }
});
