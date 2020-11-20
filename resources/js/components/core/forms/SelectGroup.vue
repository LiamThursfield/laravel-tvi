<template>
    <div class="flex flex-col">
        <label
            :class="label_class"
            :for="select_id"
        >
            {{ label_text }}
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
                v-for="(label, value) in all_options"
                :key="`${select_id}-option-${value}`"
                :disabled="isOptionDisabled(value)"
                :selected="isOptionSelected(value)"
                :value="value"
            >
                {{ label }}
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
            select_any_value: {
                default: '',
            },
            select_autofocus: {
                default: false,
                type: Boolean
            },
            select_class: {
                default: 'border border-theme-base-subtle cursor-pointer font-medium form-select mt-2 px-3 py-2 rounded w-full focus:border-theme-primary focus:outline-none focus:shadow-none',
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
                type: String
            },
            label_class: {
                default: 'font-medium text-theme-base-contrast text-sm tracking-wider',
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
            all_options() {
                let options = {};

                if (this.select_any_enabled) {
                    options[this.select_any_value] = this.select_any_label;
                }

                options = Object.assign(options, this.select_options);

                return options;
            },
            formatted_select_class() {
                if (this.is_error) {
                    return this.select_class + ' error';
                }
                return this.select_class;
            },
            is_error() {
                return !this.hide_error && this.error_message && this.error_message !== '';
            },
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
