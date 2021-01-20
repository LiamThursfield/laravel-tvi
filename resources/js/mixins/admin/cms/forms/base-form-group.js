export const baseFormGroupMixin = {
    model: {
        prop: 'inputValue'
    },
    props: {
        errorClass: {
            default: 'mt-1 text-red-500 text-sm',
            type: String
        },
        errorHideOnInput: {
            default: true,
            type: Boolean
        },
        errorMessage: {
            default: '',
            type: String
        },
        inputAutofocus: {
            default: false,
            type: Boolean
        },
        inputClass: {
            default: 'border border-theme-base-subtle font-medium px-3 py-2 rounded w-full focus:border-theme-primary focus:outline-none focus:ring-0',
            type: String
        },
        inputDisabled: {
            default: false,
            type: Boolean
        },
        inputId: {
            required: true,
            type: String
        },
        inputName: {
            required: true,
            type: String
        },
        inputRequired: {
            default: false,
            type: Boolean
        },
        inputValue: {
            default: '',
            type: String | Number
        },
        inputWrapperClass: {
            default: '',
            type: String,
        },
        labelClass: {
            default: 'font-medium mb-2 text-theme-base-contrast text-sm tracking-wider',
            type: String
        },
        labelHidden: {
            default: false,
            type: Boolean
        },
        labelText: {
            required: true,
            type: String
        },
    },
    data() {
        return {
            hideError: false,
        }
    },
    computed: {
        formattedInputClass() {
            if (this.isError) {
                return this.inputClass + ' error';
            }
            return this.inputClass;
        },
        formattedLabelClass() {
            let labelClass = this.labelClass;

            if (this.labelHidden) {
                labelClass += ' hidden';
            }

            return labelClass;
        },
        isError() {
            if (!this.hideError && this.errorMessage && this.errorMessage !== '') {
                return true;
            }

            return false;
        }
    },
    methods: {
        autofocus() {
            if (this.inputAutofocus && this.$refs[this.inputId]) {
                this.$nextTick(() => {
                    this.$refs[this.inputId].focus();
                });
            }
        },
        blurInput() {
            if (this.$refs[this.inputId]) {
                this.$nextTick(() => {
                    this.$refs[this.inputId].blur();
                });
            }
        },
        onErrorMessageChange() {
            this.hideError = false;
        },
        onInput() {
            this.$emit('input', this.$refs[this.inputId].value);

            if (this.errorHideOnInput) {
                this.hideError = true;
            }
        },
        onInputBlur() {
            this.$emit('blur');
        },
    },
    watch: {
        errorMessage: {
            handler: "onErrorMessageChange"
        },
    }
}
