<template>
    <div>
        <select-group
            :error_message="getErrorMessage('type')"
            label_text="Field Type"
            :select_any_enabled="true"
            select_any_label="Please select a field type"
            :select_autofocus="!is_autofocus_disabled"
            :select_id="`template-field-${template_field.order}-type`"
            :select_name="`template-field-${template_field.order}-type`"
            :select_options="template_field_types"
            :select_required="true"
            select_type="text"
            @input="updateTemplateField"
            v-model="editable_template_field.type"
        />

        <input-group
            class="mt-4"
            :error_message="getErrorMessage('name')"
            :input_id="`template-field-${template_field.order}-name`"
            :input_name="`template-field-${template_field.order}-name`"
            :input_required="true"
            input_type="text"
            label_text="Field Name"
            @input="onNameInput"
            v-model="editable_template_field.name"
        />

        <input-group
            class="mt-4"
            :error_message="getErrorMessage('slug')"
            :input_id="`template-field-${template_field.order}-slug`"
            :input_name="`template-field-${template_field.order}-slug`"
            :input_required="true"
            input_type="text"
            label_text="Field Slug"
            @blur="onSlugBlur"
            @input="onSlugInput"
            v-model="editable_template_field.slug"
        />

        <input-group
            class="mt-4"
            :error_message="getErrorMessage('description')"
            :input_id="`template-field-${template_field.order}-description`"
            :input_name="`template-field-${template_field.order}-description`"
            input_type="text"
            label_text="Description"
            @input="updateTemplateField"
            v-model="editable_template_field.description"
        />

        <checkbox-group
            class="mt-4"
            :checkbox_id="`template-field-${template_field.order}-is_required`"
            :checkbox_name="`template-field-${template_field.order}-is_required`"
            :error_message="getErrorMessage('is_required')"
            label_text="Required?"
            @input="updateTemplateField"
            v-model="editable_template_field.is_required"
        />

        <input-group
            class="mt-4"
            :error_message="getErrorMessage('settings')"
            :input_disabled="true"
            :input_id="`template-field-${template_field.order}-order`"
            :input_name="`template-field-${template_field.order}-order`"
            input_type="number"
            label_text="Order"
            @input="updateTemplateField"
            v-model="editable_template_field.order"
        />

        <!-- TODO: Implement Settings based on Type -->
        <component
            v-if="settings_component"
            :is="settings_component"
            :default_settings="default_field_settings"
            :template_field="editable_template_field"
            @input="updateTemplateField"
            v-model="editable_template_field.settings"
        >
            <p class="font-semibold mt-6 text-theme-base-subtle-contrast">
                Settings
            </p>
        </component>
    </div>
</template>

<script>
    import slugify          from "slugify";
    import CheckboxGroup    from "../../../../core/forms/CheckboxGroup";
    import InputGroup       from "../../../../core/forms/InputGroup";
    import NumberSettings   from "./template_field_settings/NumberSettings";
    import SelectGroup      from "../../../../core/forms/SelectGroup";
    import TextSettings     from "./template_field_settings/TextSettings";
    import TextAreaSettings from "./template_field_settings/TextAreaSettings";

    export default {
        name: "TemplateField",
        components: {
            CheckboxGroup,
            InputGroup,
            NumberSettings,
            SelectGroup,
            TextSettings,
            TextAreaSettings,
        },
        model: {
            prop: 'template_field'
        },
        props: {
            error_message_key_prefix: {
                default: 'template_fields',
                type: String
            },
            is_autofocus_disabled: {
                default: false,
                type: Boolean
            },
            is_view_only: {
                default: false,
                type: Boolean
            },
            template_field: {
                required: true,
                type: Object
            },
            template_field_settings: {
                required: true,
                type: Object
            },
            template_field_types: {
                required: true,
                type: Object,
            }
        },
        data() {
            return {
                auto_update_slug: true,
                editable_template_field: {
                    description: '',
                    is_required: false,
                    name: '',
                    order: 0,
                    settings: {},
                    slug: '',
                    type: '',
                },
            }
        },
        computed: {
            default_field_settings() {
                if (!this.editable_template_field.type) {
                    return false;
                }

                try {
                    return this.template_field_settings[this.editable_template_field.type];
                } catch (e) {
                    return {};
                }
            },
            error_message_key() {
                return this.error_message_key_prefix + '.' + this.editable_template_field.order + '.';
            },
            settings_component() {
                if (!this.editable_template_field.type) {
                    return false;
                }

                switch (this.editable_template_field.type) {
                    case 'number' :
                        return 'number-settings';
                    case 'text' :
                        return 'text-settings';
                    case 'textarea' :
                        return 'text-area-settings';
                    default:
                        return false;
                }
            },
        },
        created() {
            this.editable_template_field = _.cloneDeep(this.template_field);

            // If there is an existing slug, disable the auto slug update
            if (this.editable_template_field.slug && this.editable_template_field.slug !== '') {
                this.auto_update_slug = false;
            }
        },
        methods: {
            getErrorMessage(field) {
                let message = this.getPageErrorMessage(this.error_message_key + field);
                message = message.replace(this.error_message_key, '');
                return message;
            },
            onNameInput() {
                if (!this.auto_update_slug) {
                    this.updateTemplateField();
                    return;
                }

                this.editable_template_field.slug = this.slugify(this.editable_template_field.name);
                this.updateTemplateField();
            },
            onSlugBlur() {
                this.editable_template_field.slug = this.slugify(this.editable_template_field.slug);
                this.updateTemplateField();
            },
            onSlugInput() {
                this.auto_update_slug = false;
            },
            onTemplateFieldUpdate() {
                this.editable_template_field = _.cloneDeep(this.template_field);
            },
            slugify(value) {
                if (!value || !value.length) {
                    return '';
                }

                return slugify(
                    value, {
                        lower: true,
                    }
                );
            },
            updateTemplateField() {
                this.$emit('input', _.cloneDeep(this.editable_template_field));
            }
        },
        watch: {
            // TODO: I'd like a more elegant / efficient solution
            // - This fixes some "oddities" to ensure data is re-ordered properly via draggable
            // - But it does get called quite a lot, especially if there are a lot of fields
            template_field: {
                deep: true,
                handler: 'onTemplateFieldUpdate'
            }
        }
    }
</script>
