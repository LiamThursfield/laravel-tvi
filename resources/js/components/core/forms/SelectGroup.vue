<template>
    <div class="flex flex-col">
        <label
            :class="formatted_label_class"
            :for="select_id"
        >
            <slot>
                <span class="flex flex-row items-baseline">
                    <span>{{ label_text }}</span>
                    <sup
                        v-if="select_required"
                        class="text-theme-danger-contrast"
                    >
                        *
                    </sup>
                </span>
            </slot>
        </label>

        <select
            :id="select_id"
            :class="formatted_select_class"
            :disabled="select_disabled"
            :name="select_name"
            :ref="select_id"
            :required="select_required"
            @change="onSelectChange"
            @keyup.esc="blurSelect"
        >
            <option
                v-if="select_any_enabled"
                :disabled="isOptionDisabled(select_any_value)"
                :selected="isOptionSelected(select_any_value)"
                :value="select_any_value"
            >
                {{ select_any_label}}
            </option>

            <option
                v-for="(option, key) in formatted_options"
                :key="`${select_id}-option-${option.value}`"
                :disabled="isOptionDisabled(option.value)"
                :selected="isOptionSelected(option.value)"
                :value="option.value"
            >
                {{ option.label }}
            </option>
        </select>


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
    import _ from 'lodash';

    export default {
        name: 'SelectGroup',
        model: {
            prop: 'select_value'
        },
        props: {
            error_class: {
                default: 'mt-1 text-red-500 text-sm',
                type: String
            },
            error_hide_on_select: {
                default: true,
                type: Boolean
            },
            error_message: {
                default: '',
                type: String
            },
            select_any_enabled: {
                default: false,
                type: Boolean
            },
            select_any_label: {
                default: "Any",
                type: String
            },
            select_any_class: {
                default: "",
                type: String
            },
            select_any_value: {
                default: '',
            },
            select_autofocus: {
                default: false,
                type: Boolean
            },
            select_class: {
                default: 'border border-theme-base-subtle cursor-pointer font-medium form-select px-3 py-2 rounded w-full focus:border-theme-primary focus:outline-none focus:ring-0 focus:shadow-none',
                type: String
            },
            select_disabled: {
                default: false,
                type: Boolean
            },
            select_id: {
                required: true,
                type: String
            },
            select_name: {
                required: true,
                type: String
            },
            select_option_label_key: {
                default: false,
                type: Boolean | String | Number
            },
            select_option_value_key: {
                default: false,
                type: Boolean | String | Number
            },
            select_options: {
                required: true,
                type: Object
            },
            select_required: {
                default: false,
                type: Boolean
            },
            select_value: {
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
            formatted_options() {
                let options = {};

                _.forEach(this.select_options, (option, key) => {
                    // Default the label and value for the select
                    let label = option;
                    let value = key;

                    // Set a custom label if necessary
                    if (
                        this.select_option_label_key !== false &&
                        option.hasOwnProperty(this.select_option_label_key)
                    ) {
                        label = option[this.select_option_label_key];
                    }

                    // Set a custom value if necessary
                    if (
                        this.select_option_value_key !== false &&
                        option.hasOwnProperty(this.select_option_value_key)
                    ) {
                        value = option[this.select_option_value_key];
                    }

                    options[key] = {
                        label: label,
                        value: value,
                    };
                });

                return options;
            },
            formatted_select_class() {
                let select_class = this.select_class;

                if (this.is_error) {
                    select_class += ' error';
                }

                if (this.is_any_option_selected) {
                    select_class += ' ' + this.select_any_class;
                }

                return select_class;
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
            },
            is_any_option_selected() {
                return this.select_value === this.select_any_value || this.select_value === null;
            }
        },
        mounted() {
            this.autofocus();
        },
        methods: {
            autofocus() {
                if (this.select_autofocus && this.$refs[this.select_id]) {
                    this.$nextTick(() => {
                        this.$refs[this.select_id].focus();
                    });
                }
            },
            blurSelect() {
                if (this.$refs[this.select_id]) {
                    this.$nextTick(() => {
                        this.$refs[this.select_id].blur();
                    });
                }
            },
            isOptionDisabled(option_value) {
                if (!this.select_required) {
                    return false;
                }

                if (option_value === '') {
                    return true;
                }

                return false;
            },
            isOptionSelected(option_value) {
                return option_value === this.select_value;
            },
            onErrorMessageChange() {
                this.hide_error = false;
            },
            onSelectChange() {
                this.$emit('input', this.$refs[this.select_id].value);

                if (this.error_hide_on_select) {
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
