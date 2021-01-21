export const checkboxFormGroupMixin = {
    props: {
        inputValue: {
            default: false,
            type: String | Number | Boolean
        },
        inputValueFalse: {
            default: false,
            type: String | Number | Boolean
        },
        inputValueTrue: {
            default: true,
            type: String | Number | Boolean
        },
    },
    data() {
        return  {
            editableValue: false,
        }
    },
    computed: {
        isChecked() {
            return this.editableValue === this.inputValueTrue;
        },
    },
    mounted() {
        this.editableValue = this.inputValue;
        this.autofocus();
    },
    methods: {
        onInput() {
            this.$emit('input', this.isChecked ? this.inputValueTrue : this.inputValueFalse);

            if (this.errorHideOnInput) {
                this.hideError = true;
            }
        },
    },
}
