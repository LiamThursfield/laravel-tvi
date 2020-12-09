<template>
    <div class="flex flex-col">
        <label
            :class="label_class"
            :for="checkbox_id"
        >
            {{ label_text }}
        </label>

        <input
            :id="checkbox_id"
            :class="formatted_checkbox_class"
            :disabled="checkbox_disabled"
            :false-value="checkbox_value_false"
            :name="checkbox_name"
            :ref="checkbox_id"
            :required="checkbox_required"
            :true-value="checkbox_value_true"
            type="checkbox"
            @change="onCheckboxChange"
            @keyup.esc="blurCheckbox"
            v-model="editable_value"
        />

        <div>
            <transition name="slide-down-fade">
                <p
                    v-if="is_error"
                    :class="error_class"
                >
                    {{ error_message}}
                </p>
            </transition>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CheckboxGroup",
        model: {
            prop: 'checkbox_value'
        },
        props: {
            allow_parent_updates: {
                default: true,
                type: Boolean
            },
            error_class: {
                default: 'mt-1 text-red-500 text-sm',
                type: String
            },
            error_hide_on_change: {
                default: true,
                type: Boolean
            },
            error_message: {
                default: '',
                type: String
            },
            checkbox_autofocus: {
                default: false,
                type: Boolean
            },
            checkbox_class: {
                default: 'cursor-pointer form-checkbox h-5 mt-2 rounded text-theme-primary w-5 focus:border-theme-primary focus:outline-none focus:ring focus:ring-primary',
                type: String
            },
            checkbox_disabled: {
                default: false,
                type: Boolean
            },
            checkbox_id: {
                required: true,
                type: String
            },
            checkbox_name: {
                required: true,
                type: String
            },
            checkbox_required: {
                default: false,
                type: Boolean
            },
            checkbox_value: {
                default: false,
                type: String | Number | Boolean
            },
            checkbox_value_false: {
                default: false,
                type: String | Number | Boolean
            },
            checkbox_value_true: {
                default: true,
                type: String | Number | Boolean
            },
            label_class: {
                default: 'cursor-pointer font-medium select-none text-theme-base-contrast text-sm tracking-wider',
                type: String
            },
            label_text: {
                required: true,
                type: String
            },
        },
        data() {
            return  {
                editable_value: false,
                hide_error: false
            }
        },
        computed: {
            formatted_checkbox_class() {
                if (this.is_error) {
                    return this.checkbox_class + ' error';
                }
                return this.checkbox_class;
            },
            is_checked() {
                return this.editable_value === this.checkbox_value_true;
            },
            is_error() {
                return !this.hide_error && this.error_message && this.error_message !== '';
            }
        },
        mounted() {
            this.editable_value = this.checkbox_value;
            this.autofocus();
        },
        methods: {
            autofocus() {
                if (this.checkbox_autofocus && this.$refs[this.checkbox_id]) {
                    this.$nextTick(() => {
                        this.$refs[this.checkbox_id].focus();
                    });
                }
            },
            blurCheckbox() {
                if (this.$refs[this.checkbox_id]) {
                    this.$nextTick(() => {
                        this.$refs[this.checkbox_id].blur();
                    });
                }
            },
            onErrorMessageChange() {
                this.hide_error = false;
            },
            onCheckboxChange(e) {
                this.$emit('input', this.is_checked ? this.checkbox_value_true : this.checkbox_value_false);

                if (this.error_hide_on_change) {
                    this.hide_error = true;
                }
            },
        },
        watch: {
            error_message: {
                handler: "onErrorMessageChange"
            },
        }
    }
</script>
