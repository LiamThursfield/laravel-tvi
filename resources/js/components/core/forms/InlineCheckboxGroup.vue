<template>
    <div class="flex flex-col">
        <div class="flex flex-row">
            <input
                :id="inputId"
                :class="formattedInputClass"
                :disabled="inputDisabled"
                :false-value="inputValueFalse"
                :name="inputName"
                :ref="inputId"
                :required="inputRequired"
                :true-value="inputValueTrue"
                type="checkbox"
                @change="onInput"
                @keyup.esc="blurInput"
                v-model="editableValue"
            />

            <label
                :class="labelClass"
                :for="inputId"
            >
                <span class="flex flex-row items-baseline">
                    <span>{{ labelText }}</span>
                    <sup
                        v-if="inputRequired"
                        class="text-theme-danger-contrast"
                    >
                        *
                    </sup>
                </span>
            </label>
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
    import {checkboxFormGroupMixin} from "../../../mixins/admin/cms/forms/checkbox-form-group";
    import FormFieldError from "./partials/FormFieldError";

    export default {
        name: "InlineCheckboxGroup",
        mixins: [
            baseFormGroupMixin,
            checkboxFormGroupMixin,
        ],
        components: {
            FormFieldError
        },
        props: {
            inputClass: {
                default: 'cursor-pointer form-checkbox h-5 mr-2 rounded text-theme-primary w-5 focus:border-theme-primary focus:outline-none focus:ring focus:ring-primary',
                type: String
            },
            labelClass: {
                default: 'cursor-pointer flex-1 font-medium select-none text-theme-base-contrast text-sm tracking-wider',
                type: String
            },
        },
    }
</script>
