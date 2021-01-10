<template>
    <div class="flex flex-col">
        <label
            :class="labelClass"
            :for="checkboxId"
        >
            <slot>
                <span class="flex flex-row items-baseline">
                    <span>{{ labelText }}</span>
                    <sup
                        v-if="checkboxRequired"
                        class="text-theme-danger-contrast"
                    >
                        *
                    </sup>
                </span>
            </slot>
        </label>

        <input
            :id="checkboxId"
            :class="formattedCheckboxClass"
            :disabled="checkboxDisabled"
            :false-value="checkboxDisabled"
            :name="checkboxName"
            :ref="checkboxId"
            :required="checkboxRequired"
            :true-value="checkboxValueTrue"
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
            prop: 'checkboxValue'
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
            checkboxAutofocus: {
                default: false,
                type: Boolean
            },
            checkboxClass: {
                default: 'cursor-pointer form-checkbox h-5 mt-2 rounded text-theme-primary w-5 focus:border-theme-primary focus:outline-none focus:ring focus:ring-primary',
                type: String
            },
            checkboxDisabled: {
                default: false,
                type: Boolean
            },
            checkboxId: {
                required: true,
                type: String
            },
            checkboxName: {
                required: true,
                type: String
            },
            checkboxRequired: {
                default: false,
                type: Boolean
            },
            checkboxValue: {
                default: false,
                type: String | Number | Boolean
            },
            checkboxDisabled: {
                default: false,
                type: String | Number | Boolean
            },
            checkboxValueTrue: {
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
            formattedCheckboxClass() {
                if (this.isError) {
                    return this.checkboxClass + ' error';
                }
                return this.checkboxClass;
            },
            isChecked() {
                return this.editableValue === this.checkboxValueTrue;
            },
            isError() {
                return !this.hideError && this.errorMessage && this.errorMessage !== '';
            }
        },
        mounted() {
            this.editableValue = this.checkboxValue;
            this.autofocus();
        },
        methods: {
            autofocus() {
                if (this.checkboxAutofocus && this.$refs[this.checkboxId]) {
                    this.$nextTick(() => {
                        this.$refs[this.checkboxId].focus();
                    });
                }
            },
            blurCheckbox() {
                if (this.$refs[this.checkboxId]) {
                    this.$nextTick(() => {
                        this.$refs[this.checkboxId].blur();
                    });
                }
            },
            onErrorMessageChange() {
                this.hideError = false;
            },
            onCheckboxChange(e) {
                this.$emit('input', this.isChecked ? this.checkboxValueTrue : this.checkboxDisabled);

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
