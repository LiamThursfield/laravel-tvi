<template>
    <div class="flex flex-col">
        <label
            :class="formattedLabelClass"
            :for="inputId"
        >
            <slot>
                <span class="flex flex-row items-baseline">
                    <span>{{ labelText }}</span>
                    <sup
                        v-if="inputRequired"
                        class="text-theme-danger-contrast"
                    >
                        *
                    </sup>
                </span>
            </slot>
        </label>

        <input
            :id="inputId"
            :class="formattedInputClass"
            :autocomplete="inputAutocomplete"
            :disabled="inputDisabled"
            :max="inputMax"
            :maxlength="inputMaxLength"
            :min="inputMin"
            :minlength="inputMinLength"
            :name="inputName"
            :placeholder="inputPlaceholder"
            :ref="inputId"
            :required="inputRequired"
            :type="inputType"
            :value="inputValue"
            @blur="onInputBlur"
            @input="onInputKeyPress"
            @keyup.esc="blurInput"
        />

        <div>
            <transition name="slide-down-fade">
                <p
                    v-if="isError"
                    :class="errorClass"
                >
                    {{ errorMessage }}
                </p>
            </transition>
        </div>
    </div>
</template>

<script>
    export default {
        name: "InputGroup",
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
                type: false | String
            },
            inputAutocomplete: {
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
            inputMax: {
                default: '',
                type: String | Number
            },
            inputMaxLength: {
                default: '',
                type: String | Number
            },
            inputMin: {
                default: '',
                type: String | Number
            },
            inputMinLength: {
                default: '',
                type: String | Number
            },
            inputName: {
                required: true,
                type: String
            },
            inputPlaceholder: {
                default: '',
                type: String
            },
            inputRequired: {
                default: false,
                type: Boolean
            },
            inputType: {
                default: 'text',
                type: String
            },
            inputValue: {
                default: '',
                type: String | Number
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
            return  {
                hideError: false
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
                return !this.hideError && this.errorMessage && this.errorMessage !== '';
            }
        },
        mounted() {
            this.autofocus();
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
            onInputBlur() {
                this.$emit('blur');
            },
            onInputKeyPress() {
                this.$emit('input', this.$refs[this.inputId].value);

                if (this.errorHideOnInput) {
                    this.hideError = true;
                }
            },
        },
        watch: {
            errorMessage: {
                handler: "onErrorMessageChange"
            },
        }
    }
</script>
