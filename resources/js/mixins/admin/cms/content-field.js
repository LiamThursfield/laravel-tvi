import _ from 'lodash';

export const contentFieldMixin = {
    model: {
        prop: 'content',
    },
    props: {
        content: {
            required: true,
        },
        templateField: {
            required: true,
            type: Object
        }
    },
    data() {
        return {
            editableContent: '',
        }
    },
    computed: {
        errorMessage() {
            // Returns either the first error message for the field, or false
            try {
                if (!Array.isArray(this.inputErrors)) {
                    return this.inputErrors;
                }

                return this.inputErrors[0];
            } catch (e) {
                return false;
            }
        },
        inputErrors() {
            try {
                let errors = [];
                _.forEach(this.$page.props.errors, (e, slug) => {
                    if (slug.indexOf(this.inputName) === 0) {
                        e = _.replace(e, this.inputName + '.', '');
                        e = _.replace(e, this.inputName, '');
                        errors.push(e);
                    }
                })

                return errors;
            } catch (e) {
                return false;
            }
        },
        inputName() {
            return 'content.' + this.templateField.id;
        }
    },
    created() {
        this.editableContent = _.cloneDeep(this.content);
    },
    methods: {
        onEditableContentUpdate: _.debounce(function () {
            this.$emit('input', this.editableContent);
        }, 100),
    },
    watch: {
        editableContent: {
            deep: true,
            handler: 'onEditableContentUpdate'
        }
    }
}
