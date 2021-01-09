<template>
    <div>
        <div
            class="
                flex flex-col
                md:flex-row md:space-x-4
            "
        >
            <select-group
                class="flex-1"
                :errorMessage="getErrorMessage('type')"
                labelText="Field Type"
                :selectAnyEnabled="true"
                selectAnyLabel="Please select a field type"
                :selectAutoFocus="!is_autofocus_disabled"
                :selectId="`template-field-${templateField.order}-type`"
                :selectName="`template-field-${templateField.order}-type`"
                :selectOptions="templateFieldTypes"
                :selectRequired="true"
                @input="updateTemplateField"
                v-model="editable_templateField.type"
            />

            <input-group
                class="flex-1 mt-4 md:mt-0"
                :inputDisabled="true"
                :inputId="`template-field-${templateField.order}-order`"
                :inputName="`template-field-${templateField.order}-order`"
                inputType="number"
                labelText="Order"
                @input="updateTemplateField"
                v-model="editable_templateField.order"
            />
        </div>

        <div
            class="
                flex flex-col
                md:flex-row md:space-x-4
            "
        >
            <input-group
                class="flex-1 mt-4"
                :errorMessage="getErrorMessage('name')"
                :inputId="`template-field-${templateField.order}-name`"
                :inputName="`template-field-${templateField.order}-name`"
                :inputRequired="true"
                inputType="text"
                labelText="Field Name"
                @input="onNameInput"
                v-model="editable_templateField.name"
            />

            <input-group
                class="flex-1 mt-4"
                :errorMessage="getErrorMessage('slug')"
                :inputId="`template-field-${templateField.order}-slug`"
                :inputName="`template-field-${templateField.order}-slug`"
                :inputRequired="true"
                inputType="text"
                labelText="Field Slug"
                @blur="onSlugBlur"
                @input="onSlugInput"
                v-model="editable_templateField.slug"
            />
        </div>

        <input-group
            class="mt-4"
            :errorMessage="getErrorMessage('description')"
            :inputId="`template-field-${templateField.order}-description`"
            :inputName="`template-field-${templateField.order}-description`"
            inputType="text"
            labelText="Description"
            @input="updateTemplateField"
            v-model="editable_templateField.description"
        />

        <checkbox-group
            class="mt-4"
            :checkboxId="`template-field-${templateField.order}-is_required`"
            :checkboxName="`template-field-${templateField.order}-is_required`"
            :errorMessage="getErrorMessage('is_required')"
            labelText="Required?"
            @input="updateTemplateField"
            v-model="editable_templateField.is_required"
        />

        <!-- TODO: Implement Settings based on Type -->
        <component
            v-if="settings_component"
            :is="settings_component"
            :default_settings="default_fieldSettings"
            :templateField="editable_templateField"
            @input="updateTemplateField"
            v-model="editable_templateField.settings"
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
            prop: 'templateField'
        },
        props: {
            errorMessage_key_prefix: {
                default: 'templateFields',
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
            templateField: {
                required: true,
                type: Object
            },
            templateFieldSettings: {
                required: true,
                type: Object
            },
            templateFieldTypes: {
                required: true,
                type: Object,
            }
        },
        data() {
            return {
                autoUpdateSlug: true,
                editable_templateField: {
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
            default_fieldSettings() {
                if (!this.editable_templateField.type) {
                    return false;
                }

                try {
                    return this.templateFieldSettings[this.editable_templateField.type];
                } catch (e) {
                    return {};
                }
            },
            errorMessage_key() {
                return this.errorMessage_key_prefix + '.' + this.editable_templateField.order + '.';
            },
            settings_component() {
                if (!this.editable_templateField.type) {
                    return false;
                }

                switch (this.editable_templateField.type) {
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
            this.editable_templateField = _.cloneDeep(this.templateField);

            // If there is an existing slug, disable the auto slug update
            if (this.editable_templateField.slug && this.editable_templateField.slug !== '') {
                this.autoUpdateSlug = false;
            }
        },
        methods: {
            getErrorMessage(field) {
                let message = this.getPageErrorMessage(this.errorMessage_key + field);
                message = message.replace(this.errorMessage_key, '');
                return message;
            },
            onNameInput() {
                if (!this.autoUpdateSlug) {
                    this.updateTemplateField();
                    return;
                }

                this.editable_templateField.slug = this.slugify(this.editable_templateField.name);
                this.updateTemplateField();
            },
            onSlugBlur() {
                this.editable_templateField.slug = this.slugify(this.editable_templateField.slug);
                this.updateTemplateField();
            },
            onSlugInput() {
                this.autoUpdateSlug = false;
            },
            onTemplateFieldUpdate() {
                this.editable_templateField = _.cloneDeep(this.templateField);
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
                this.$emit('input', _.cloneDeep(this.editable_templateField));
            }
        },
        watch: {
            // TODO: I'd like a more elegant / efficient solution
            // - This fixes some "oddities" to ensure data is re-ordered properly via draggable
            // - But it does get called quite a lot, especially if there are a lot of fields
            templateField: {
                deep: true,
                handler: 'onTemplateFieldUpdate'
            }
        }
    }
</script>
