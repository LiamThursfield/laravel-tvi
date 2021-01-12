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

        <textarea
            :id="inputId"
            :class="formattedInputClass"
            :autocomplete="inputAutocomplete"
            :disabled="inputDisabled"
            :maxlength="inputMaxLength"
            :name="inputName"
            :rows="inputRows"
            :placeholder="inputPlaceholder"
            :ref="inputId"
            :required="inputRequired"
            :type="inputType"
            :value="inputValue"
            @blur="onInputBlur"
            @input="onInput"
            @keyup.esc="blurInput"
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
        name: "TextAreaGroup",
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
            inputMaxLength: {
                default: '',
                type: String | Number
            },
            inputPlaceholder: {
                default: '',
                type: String
            },
            inputRows: {
                default: '',
                type: String | Number
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
