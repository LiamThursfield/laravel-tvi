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

        <div>
            <div :class="inputWrapperClass">
                <input
                    :id="inputId"
                    :class="formattedInputClass"
                    :disabled="inputDisabled"
                    :name="inputName"
                    :ref="inputId"
                    :required="inputRequired"
                    :type="inputType"
                    @blur="onInputBlur"
                    @keyup.esc="blurInput"
                    @keydown.enter.prevent.stop="addValue"
                    v-model="newValue"
                />

                <button
                    :class="inputButtonClass"
                    type="button"
                    @click="addValue"
                >
                    Add
                </button>
            </div>

            <div
                v-if="editableInputValue.length"
                :class="inputValuesWrapperClass"
            >
                <button
                    v-for="(value, index) in editableInputValue"
                    :key="`value-${index}-${value}`"
                    :class="inputValuesClass"
                    type="button"
                    @click="removeValue(index)"
                >
                    {{ value }}

                    <icon-x :class="inputValuesCloseClass" />
                </button>
            </div>
        </div>

        <form-field-error
            :error-class="errorClass"
            :error-message="errorMessage"
            :is-error="isError"
        />
    </div>
</template>

<script>
    import _ from 'lodash';
    import {baseFormGroupMixin} from "../../../mixins/admin/cms/forms/base-form-group";
    import FormFieldError from "./partials/FormFieldError";

    export default {
        name: "ArrayGroup",
        mixins: [
            baseFormGroupMixin,
        ],
        components: {
            FormFieldError
        },
        props: {
            inputAllowDuplicates: {
                default: false,
                type: Boolean,
            },
            inputButtonClass: {
                default: 'border border-l-0 border-theme-primary-subtle button button-primary-subtle rounded-l-none',
                type: String
            },
            inputClass: {
                default: 'border border-theme-base-subtle font-medium px-3 py-2 rounded-l w-full focus:border-theme-primary focus:outline-none focus:ring-0',
                type: String
            },
            inputTrimValues: {
                default: true,
                type: Boolean,
            },
            inputType: {
                default: 'text',
                type: String
            },
            inputValuesClass: {
                default: 'bg-theme-base-subtle cursor-pointer flex flex-row items-center m-1 px-2 py-1 rounded text-sm text-theme-base-subtle-contrast focus:outline-none focus:ring hover:bg-theme-base-subtle-contrast hover:text-theme-base-subtle',
                type: String
            },
            inputValuesCloseClass: {
                default: 'h-4 ml-2 w-4',
                type: String
            },
            inputValuesWrapperClass: {
                default: 'flex flex-row flex-wrap items-center -mx-1 my-1',
                type: String
            },
            inputWrapperClass: {
                default: 'flex flex-row items-center',
                type: String
            }
        },
        data() {
            return {
                editableInputValue: [],
                newValue: ''
            }
        },
        mounted() {
            try {
                if (Array.isArray(this.inputValue)) {
                    this.editableInputValue = _.clone(this.inputValue);
                } else if (this.inputValue && this.inputValue.length) {
                    this.editableInputValue = this.inputValue.split(',');
                } else {
                    this.editableInputValue = [];
                }
            } catch (e) {
                this.editableInputValue = [];
            }
        },
        methods: {
            addValue() {
                if (this.errorHideOnInput) {
                    this.hideError = true;
                }

                if (this.inputTrimValues) {
                    this.newValue = this.newValue.trim();
                }

                if (!this.newValue.length) {
                    this.$errorToast('Please enter a valid value.');
                    return;
                }

                if (!this.inputAllowDuplicates && this.editableInputValue.indexOf(this.newValue) >= 0) {
                    this.$errorToast('Duplicate values not allowed.');
                    return;
                }

                this.editableInputValue.push(this.newValue);
                this.newValue = '';
                this.autofocus();

                this.onEditableInputChange();
            },
            removeValue(index) {
                if (this.errorHideOnInput) {
                    this.hideError = true;
                }

                try {
                    this.editableInputValue.splice(index, 1);
                    this.onEditableInputChange();
                } catch (e) {
                    this.$errorToast('Failed to remove value.');
                    console.log(e);
                }
            },
            onEditableInputChange() {
                this.$emit('input', this.editableInputValue);
            }
        },
    }
</script>
