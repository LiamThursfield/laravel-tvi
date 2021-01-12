<template>
    <div class="flex flex-col">
        <label
            :class="labelClass"
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
            :disabled="inputDisabled"
            :false-value="inputDisabled"
            :name="inputName"
            :ref="inputId"
            :required="inputRequired"
            :true-value="inputValueTrue"
            type="checkbox"
            @change="onCheckboxChange"
            @keyup.esc="blurCheckbox"
            v-model="editableValue"
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
        name: "CheckboxGroup",
        model: {
            prop: 'inputValue'
        },
        props: {
            errorClass: {
                default: 'mt-1 text-red-500 text-sm',
                type: String
            },
            errorHideOnChange: {
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
                default: 'cursor-pointer form-checkbox h-5 mt-2 rounded text-theme-primary w-5 focus:border-theme-primary focus:outline-none focus:ring focus:ring-primary',
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
                default: false,
                type: String | Number | Boolean
            },
            inputDisabled: {
                default: false,
                type: String | Number | Boolean
            },
            inputValueTrue: {
                default: true,
                type: String | Number | Boolean
            },
            labelClass: {
                default: 'cursor-pointer font-medium select-none text-theme-base-contrast text-sm tracking-wider',
                type: String
            },
            labelText: {
                required: true,
                type: String
            },
        },
        data() {
            return  {
                editableValue: false,
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
            isChecked() {
                return this.editableValue === this.inputValueTrue;
            },
            isError() {
                return !this.hideError && this.errorMessage && this.errorMessage !== '';
            }
        },
        mounted() {
            this.editableValue = this.inputValue;
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
            blurCheckbox() {
                if (this.$refs[this.inputId]) {
                    this.$nextTick(() => {
                        this.$refs[this.inputId].blur();
                    });
                }
            },
            onErrorMessageChange() {
                this.hideError = false;
            },
            onCheckboxChange(e) {
                this.$emit('input', this.isChecked ? this.inputValueTrue : this.inputDisabled);

                if (this.errorHideOnChange) {
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
