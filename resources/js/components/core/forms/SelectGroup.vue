<template>
    <div class="flex flex-col">
        <label
            :class="formattedLabelClass"
            :for="selectId"
        >
            <slot>
                <span class="flex flex-row items-baseline">
                    <span>{{ labelText }}</span>
                    <sup
                        v-if="selectRequired"
                        class="text-theme-danger-contrast"
                    >
                        *
                    </sup>
                </span>
            </slot>
        </label>

        <select
            :id="selectId"
            :class="formattedSelectClass"
            :disabled="selectDisabled"
            :name="selectName"
            :ref="selectId"
            :required="selectRequired"
            @change="onSelectChange"
            @keyup.esc="blurSelect"
        >
            <option
                v-if="selectAnyEnabled"
                :disabled="isOptionDisabled(selectAnyValue)"
                :selected="isOptionSelected(selectAnyValue)"
                :value="selectAnyValue"
            >
                {{ selectAnyLabel}}
            </option>

            <option
                v-for="(option, key) in formattedOptions"
                :key="`${selectId}-option-${option.value}`"
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
            prop: 'selectValue'
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
            selectAnyEnabled: {
                default: false,
                type: Boolean
            },
            selectAnyLabel: {
                default: "Any",
                type: String
            },
            selectAnyClass: {
                default: "",
                type: String
            },
            selectAnyValue: {
                default: '',
            },
            selectAutofocus: {
                default: false,
                type: Boolean
            },
            selectClass: {
                default: 'border border-theme-base-subtle cursor-pointer font-medium form-select px-3 py-2 rounded w-full focus:border-theme-primary focus:outline-none focus:ring-0 focus:shadow-none',
                type: String
            },
            selectDisabled: {
                default: false,
                type: Boolean
            },
            selectId: {
                required: true,
                type: String
            },
            selectName: {
                required: true,
                type: String
            },
            selectOptionLabelKey: {
                default: false,
                type: Boolean | String | Number
            },
            selectOptionValueKey: {
                default: false,
                type: Boolean | String | Number
            },
            selectOptions: {
                required: true,
                type: Object
            },
            selectRequired: {
                default: false,
                type: Boolean
            },
            selectValue: {
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

                _.forEach(this.selectOptions, (option, key) => {
                    // Default the label and value for the select
                    let label = option;
                    let value = key;

                    // Set a custom label if necessary
                    if (
                        this.selectOptionLabelKey !== false &&
                        option.hasOwnProperty(this.selectOptionLabelKey)
                    ) {
                        label = option[this.selectOptionLabelKey];
                    }

                    // Set a custom value if necessary
                    if (
                        this.selectOptionValueKey !== false &&
                        option.hasOwnProperty(this.selectOptionValueKey)
                    ) {
                        value = option[this.selectOptionValueKey];
                    }

                    options[key] = {
                        label: label,
                        value: value,
                    };
                });

                return options;
            },
            formattedSelectClass() {
                let selectClass = this.selectClass;

                if (this.isError) {
                    selectClass += ' error';
                }

                if (this.isAnyOptionSelected) {
                    selectClass += ' ' + this.selectAnyClass;
                }

                return selectClass;
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
                return this.selectValue === this.selectAnyValue || this.selectValue === null;
            }
        },
        mounted() {
            this.autofocus();
        },
        methods: {
            autofocus() {
                if (this.selectAutofocus && this.$refs[this.selectId]) {
                    this.$nextTick(() => {
                        this.$refs[this.selectId].focus();
                    });
                }
            },
            blurSelect() {
                if (this.$refs[this.selectId]) {
                    this.$nextTick(() => {
                        this.$refs[this.selectId].blur();
                    });
                }
            },
            isOptionDisabled(option_value) {
                if (!this.selectRequired) {
                    return false;
                }

                if (option_value === '') {
                    return true;
                }

                return false;
            },
            isOptionSelected(option_value) {
                return option_value === this.selectValue;
            },
            onErrorMessageChange() {
                this.hideError = false;
            },
            onSelectChange() {
                this.$emit('input', this.$refs[this.selectId].value);

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
