import Vue from "vue";

Vue.mixin({
    methods: {
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
