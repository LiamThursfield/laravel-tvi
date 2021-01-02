import _ from 'lodash';

export const contentFieldMixin = {
    model: {
        prop: 'content',
    },
    props: {
        content: {
            required: true,
        },
        template_field: {
            required: true,
            type: Object
        }
    },
    data() {
        return {
            editable_content: '',
        }
    },
    computed: {
        error_message() {
            // Returns either the first error message for the field, or false
            try {
                if (!Array.isArray(this.input_errors)) {
                    return this.input_errors;
                }

                return this.input_errors[0];
            } catch (e) {
                return false;
            }
        },
        input_errors() {
            try {
                let errors = [];
                _.forEach(this.$page.props.errors, (e, slug) => {
                    if (slug.indexOf(this.input_name) === 0) {
                        e = _.replace(e, this.input_name + '.', '');
                        e = _.replace(e, this.input_name, '');
                        errors.push(e);
                    }
                })

                return errors;
            } catch (e) {
                return false;
            }
        },
        input_name() {
            return 'content.' + this.template_field.id;
        }
    },
    created() {
        this.editable_content = _.cloneDeep(this.content);
    },
    methods: {
        onEditableContentUpdate: _.debounce(function () {
            this.$emit('input', this.editable_content);
        }, 100),
    },
    watch: {
        editable_content: {
            deep: true,
            handler: 'onEditableContentUpdate'
        }
    }
}
