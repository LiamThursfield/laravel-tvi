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
            :disabled="inputDisabled"
            :false-value="inputDisabled"
            :name="inputName"
            :ref="inputId"
            :required="inputRequired"
            :true-value="inputValueTrue"
            type="checkbox"
            @change="onInput"
            @keyup.esc="blurInput"
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
    import {baseFormGroupMixin} from "../../../mixins/admin/cms/forms/base-form-group";
    import {checkboxFormGroupMixin} from "../../../mixins/admin/cms/forms/checkbox-form-group";
    import FormFieldError from "./partials/FormFieldError";

    export default {
        name: "CheckboxGroup",
        mixins: [
            baseFormGroupMixin,
            checkboxFormGroupMixin,
        ],
        components: {
            FormFieldError
        },
        props: {
            inputClass: {
                default: 'cursor-pointer form-checkbox h-5 mt-2 rounded text-theme-primary w-5 focus:border-theme-primary focus:outline-none focus:ring focus:ring-primary',
                type: String
            },
            labelClass: {
                default: 'cursor-pointer font-medium select-none text-theme-base-contrast text-sm tracking-wider',
                type: String
            },
        },
    }
</script>
