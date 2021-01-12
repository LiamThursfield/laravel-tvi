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

        <form-field-error
            :error-class="errorClass"
            :error-message="errorMessage"
            :is-error="isError"
        />
    </div>
</template>

<script>
    import {baseFormGroupMixin} from "../../../mixins/admin/cms/forms/base-form-group";
    import FormFieldError from "./partials/FormFieldError";

    export default {
        name: "DateTimePickerGroup",
        mixins: [
            baseFormGroupMixin,
        ],
        components: {
            FormFieldError
        },
        props: {
            inputClass: {
                default: '',
                type: String
            },
            inputFormat: {
                default: 'DD/MM/YYYY HH:mm',
                type: String
            },
            inputPlaceholder: {
                default: 'Please select a date',
                type: String
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
            inputValueType: {
                default: 'YYYY-MM-DD HH:mm',
                type: String
            },
        },
        data() {
            return  {
                editableInput: '',
                isInitialised: false,
            }
        },
        mounted() {
            this.editableInput = this.inputValue;
            this.$nextTick(() => {
                this.isInitialised = true;
            })
        },
        methods: {
            onInput() {
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
                handler: "onInput"
            },
            inputValue: {
                handler: "onInputValueChange"
            },
        }
    }
</script>
