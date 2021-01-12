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

        <select
            :id="inputId"
            :class="formattedInputClass"
            :disabled="inputDisabled"
            :name="inputName"
            :ref="inputId"
            :required="inputRequired"
            @change="onSelectChange"
            @keyup.esc="blurSelect"
        >
            <option
                v-if="inputAnyOptionEnabled"
                :disabled="isOptionDisabled(inputAnyOptionValue)"
                :selected="isOptionSelected(inputAnyOptionValue)"
                :value="inputAnyOptionValue"
            >
                {{ inputAnyOptionLabel}}
            </option>

            <option
                v-for="(option, key) in formattedOptions"
                :key="`${inputId}-option-${option.value}`"
                :disabled="isOptionDisabled(option.value)"
                :selected="isOptionSelected(option.value)"
                :value="option.value"
            >
                {{ option.label }}
            </option>
        </select>


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
    import _ from 'lodash';

    export default {
        name: 'SelectGroup',
        model: {
            prop: 'inputValue'
        },
        props: {
            errorClass: {
                default: 'mt-1 text-red-500 text-sm',
                type: String
            },
            errorHideOnSelect: {
                default: true,
                type: Boolean
            },
            errorMessage: {
                default: '',
                type: String
            },
            inputAnyOptionEnabled: {
                default: false,
                type: Boolean
            },
            inputAnyOptionLabel: {
                default: "Any",
                type: String
            },
            inputAnyOptionClass: {
                default: "",
                type: String
            },
            inputAnyOptionValue: {
                default: '',
            },
            inputAutofocus: {
                default: false,
                type: Boolean
            },
            inputClass: {
                default: 'border border-theme-base-subtle cursor-pointer font-medium form-select px-3 py-2 rounded w-full focus:border-theme-primary focus:outline-none focus:ring-0 focus:shadow-none',
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
            inputOptionLabelKey: {
                default: false,
                type: Boolean | String | Number
            },
            inputOptionValueKey: {
                default: false,
                type: Boolean | String | Number
            },
            inputOptions: {
                required: true,
                type: Object
            },
            inputRequired: {
                default: false,
                type: Boolean
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
            formattedOptions() {
                let options = {};

                _.forEach(this.inputOptions, (option, key) => {
                    // Default the label and value for the select
                    let label = option;
                    let value = key;

                    // Set a custom label if necessary
                    if (
                        this.inputOptionLabelKey !== false &&
                        option.hasOwnProperty(this.inputOptionLabelKey)
                    ) {
                        label = option[this.inputOptionLabelKey];
                    }

                    // Set a custom value if necessary
                    if (
                        this.inputOptionValueKey !== false &&
                        option.hasOwnProperty(this.inputOptionValueKey)
                    ) {
                        value = option[this.inputOptionValueKey];
                    }

                    options[key] = {
                        label: label,
                        value: value,
                    };
                });

                return options;
            },
            formattedInputClass() {
                let inputClass = this.inputClass;

                if (this.isError) {
                    inputClass += ' error';
                }

                if (this.isAnyOptionSelected) {
                    inputClass += ' ' + this.inputAnyOptionClass;
                }

                return inputClass;
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
            },
            isAnyOptionSelected() {
                return this.inputValue === this.inputAnyOptionValue || this.inputValue === null;
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
            blurSelect() {
                if (this.$refs[this.inputId]) {
                    this.$nextTick(() => {
                        this.$refs[this.inputId].blur();
                    });
                }
            },
            isOptionDisabled(option_value) {
                if (!this.inputRequired) {
                    return false;
                }

                if (option_value === '') {
                    return true;
                }

                return false;
            },
            isOptionSelected(option_value) {
                return option_value === this.inputValue;
            },
            onErrorMessageChange() {
                this.hideError = false;
            },
            onSelectChange() {
                this.$emit('input', this.$refs[this.inputId].value);

                if (this.errorHideOnSelect) {
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
