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

        <date-picker
            :id="input_id"
            :class="formatted_input_class"
            :disabled="input_disabled"
            :format="input_format"
            :placeholder="input_placeholder"
            :required="input_required"
            :time-title-format="input_time_title_format"
            :title-format="input_title_format"
            :type="input_type"
            :value-type="input_value_type"
            v-model="editable_input"
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
        name: "DateTimePickerGroup",
        model: {
            prop: 'input_value'
        },
        props: {
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
            input_class: {
                default: '',
                type: String
            },
            input_disabled: {
                default: false,
                type: Boolean
            },
            input_format: {
                default: 'DD/MM/YYYY HH:mm',
                type: String
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
                default: 'Please select a date',
                type: String
            },
            input_required: {
                default: false,
                type: Boolean
            },
            input_time_title_format: {
                default: 'DD/MM/YYYY HH:mm',
                type: String
            },
            input_title_format: {
                default: 'DD/MM/YYYY HH:mm',
                type: String
            },
            input_type: {
                default: 'datetime',
                type: String
            },
            input_value: {
                default: '',
                type: String | Number
            },
            input_value_type: {
                default: 'YYYY-MM-DD HH:mm',
                type: String
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
                editable_input: '',
                hide_error: false,
                is_initialised: false,
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
            this.editable_input = this.input_value;
            this.$nextTick(() => {
                this.is_initialised = true;
            })
        },
        methods: {
            onErrorMessageChange() {
                this.hide_error = false;
            },
            onEditableInputChange() {
                if (!this.is_initialised) {
                    return;
                }

                this.$emit('input', this.editable_input);

                if (this.error_hide_on_input) {
                    this.hide_error = true;
                }
            },
            onInputValueChange() {
                if (this.input_value !== this. editable_input) {
                    this.editable_input = this.input_value;
                }
            }
        },
        watch: {
            editable_input: {
                handler: "onEditableInputChange"
            },
            error_message: {
                handler: "onErrorMessageChange"
            },
            input_value: {
                handler: "onInputValueChange"
            },
        }
    }
</script>
