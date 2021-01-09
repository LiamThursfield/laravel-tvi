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

        <date-picker
            :id="inputId"
            :class="formattedInputClass"
            :disabled="inputDisabled"
            :format="inputFormat"
            :placeholder="inputPlaceholder"
            :required="inputRequired"
            :time-title-format="inputTimeTitleFormat"
            :title-format="inputTitleFormat"
            :type="inputType"
            :value-type="inputValueType"
            v-model="editableInput"
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
        name: "DateTimePickerGroup",
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
            inputClass: {
                default: '',
                type: String
            },
            inputDisabled: {
                default: false,
                type: Boolean
            },
            inputFormat: {
                default: 'DD/MM/YYYY HH:mm',
                type: String
            },
            inputId: {
                required: true,
                type: String
            },
            inputName: {
                required: true,
                type: String
            },
            inputPlaceholder: {
                default: 'Please select a date',
                type: String
            },
            inputRequired: {
                default: false,
                type: Boolean
            },
            inputTimeTitleFormat: {
                default: 'DD/MM/YYYY HH:mm',
                type: String
            },
            inputTitleFormat: {
                default: 'DD/MM/YYYY HH:mm',
                type: String
            },
            inputType: {
                default: 'datetime',
                type: String
            },
            inputValue: {
                default: '',
                type: String | Number
            },
            inputValueType: {
                default: 'YYYY-MM-DD HH:mm',
                type: String
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
                editableInput: '',
                hideError: false,
                isInitialised: false,
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
            this.editableInput = this.inputValue;
            this.$nextTick(() => {
                this.isInitialised = true;
            })
        },
        methods: {
            onErrorMessageChange() {
                this.hideError = false;
            },
            onEditableInputChange() {
                if (!this.isInitialised) {
                    return;
                }

                this.$emit('input', this.editableInput);

                if (this.errorHideOnInput) {
                    this.hideError = true;
                }
            },
            onInputValueChange() {
                if (this.inputValue !== this. editableInput) {
                    this.editableInput = this.inputValue;
                }
            }
        },
        watch: {
            editableInput: {
                handler: "onEditableInputChange"
            },
            errorMessage: {
                handler: "onErrorMessageChange"
            },
            inputValue: {
                handler: "onInputValueChange"
            },
        }
    }
</script>
