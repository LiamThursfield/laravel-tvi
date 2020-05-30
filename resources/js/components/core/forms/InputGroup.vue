<template>
    <div class="flex flex-col">
        <label
            :class="label_class"
            :for="input_id"
        >
            {{ label_text }}
        </label>

        <input
            :id="input_id"
            :class="formatted_input_class"
            :autocomplete="input_autocomplete"
            :disabled="input_disabled"
            :name="input_name"
            :placeholder="input_placeholder"
            :ref="input_id"
            :required="input_required"
            :type="input_type"
            :value="input_value"
            @input="onInputKeyPress"
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
                type: String
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
                default: 'rounded shadow mt-2 px-3 py-2 focus:outline-none focus:shadow-outline-indigo',
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
                type: String
            },
            label_class: {
                default: 'font-bold text-gray-700 text-sm tracking-wider',
                type: String
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
            onErrorMessageChange() {
                this.hide_error = false;
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
