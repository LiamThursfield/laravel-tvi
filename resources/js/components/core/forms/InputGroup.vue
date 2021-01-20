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

        <div :class="inputWrapperClass">
            <slot name="inputPrepend" />

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
                @input="onInput"
                @keyup.esc="blurInput"
            />

            <slot name="inputAppend" />
        </div>

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
        name: "InputGroup",
        mixins: [
            baseFormGroupMixin,
        ],
        components: {
            FormFieldError
        },
        props: {
            inputAutocomplete: {
                default: '',
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
            inputPlaceholder: {
                default: '',
                type: String
            },
            inputType: {
                default: 'text',
                type: String
            },
        },
        mounted() {
            this.autofocus();
        },
    }
</script>
