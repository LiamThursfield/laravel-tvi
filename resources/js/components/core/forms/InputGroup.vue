<template>
    <div class="flex flex-col">
        <label
            :class="formatted_label_class"
            :for="input_id"
        >
            <slot>
                <span class="flex flex-row items-baseline">
                    <span>{{ label_text }}</span>
                    <sup
                        v-if="input_required"
                        class="text-theme-danger-contrast"
                    >
                        *
                    </sup>
                </span>
            </slot>
        </label>

        <input
            :id="input_id"
            :class="formatted_input_class"
            :autocomplete="input_autocomplete"
            :disabled="input_disabled"
            :max="input_max"
            :maxlength="input_maxlength"
            :min="input_min"
            :minlength="input_minlength"
            :name="input_name"
            :placeholder="input_placeholder"
            :ref="input_id"
            :required="input_required"
            :type="input_type"
            :value="input_value"
            @blur="onInputBlur"
            @input="onInputKeyPress"
            @keyup.esc="blurInput"
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
        name: "InputGroup",
        model: {
            prop: 'input_value'
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
            error_hide_on_input: {
                default: true,
                type: Boolean
            },
            error_message: {
                default: '',
                type: false | String
            },
            input_autocomplete: {
                default: '',
                type: String
            },
            input_autofocus: {
                default: false,
                type: Boolean
            },
            input_class: {
                default: 'border border-theme-base-subtle font-medium px-3 py-2 rounded w-full focus:border-theme-primary focus:outline-none focus:ring-0',
                type: String
            },
            input_disabled: {
                default: false,
                type: Boolean
            },
            input_id: {
                required: true,
                type: String
            },
            input_max: {
                default: '',
                type: String | Number
            },
            input_maxlength: {
                default: '',
                type: String | Number
            },
            input_min: {
                default: '',
                type: String | Number
            },
            input_minlength: {
                default: '',
                type: String | Number
            },
            input_name: {
                required: true,
                type: String
            },
            input_placeholder: {
                default: '',
                type: String
            },
            input_required: {
                default: false,
                type: Boolean
            },
            input_type: {
                default: 'text',
                type: String
            },
            input_value: {
                default: '',
                type: String | Number
            },
            label_class: {
                default: 'font-medium mb-2 text-theme-base-contrast text-sm tracking-wider',
                type: String
            },
            label_hidden: {
                default: false,
                type: Boolean
            },
            label_text: {
                required: true,
                type: String
            },
        },
        data() {
            return  {
                hide_error: false
            }
        },
        computed: {
            formatted_input_class() {
                if (this.is_error) {
                    return this.input_class + ' error';
                }
                return this.input_class;
            },
            formatted_label_class() {
                let label_class = this.label_class;

                if (this.label_hidden) {
                    label_class += ' hidden';
                }

                return label_class;
            },
            is_error() {
                return !this.hide_error && this.error_message && this.error_message !== '';
            }
        },
        mounted() {
            this.autofocus();
        },
        methods: {
            autofocus() {
                if (this.input_autofocus && this.$refs[this.input_id]) {
                    this.$nextTick(() => {
                        this.$refs[this.input_id].focus();
                    });
                }
            },
            blurInput() {
                if (this.$refs[this.input_id]) {
                    this.$nextTick(() => {
                        this.$refs[this.input_id].blur();
                    });
                }
            },
            onErrorMessageChange() {
                this.hide_error = false;
            },
            onInputBlur() {
                this.$emit('blur');
            },
            onInputKeyPress() {
                this.$emit('input', this.$refs[this.input_id].value);

                if (this.error_hide_on_input) {
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
