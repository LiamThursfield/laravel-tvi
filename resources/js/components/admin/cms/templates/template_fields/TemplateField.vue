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
                :error-message="getErrorMessage('type')"
                label-text="Field Type"
                :input-any-option-enabled="true"
                input-any-option-label="Please select a field type"
                :input-autofocus="!isAutofocusDisabled"
                :input-id="`template-field-${templateField.order}-type`"
                :input-name="`template-field-${templateField.order}-type`"
                :input-options="templateFieldTypes"
                :input-required="true"
                @errorHidden="clearErrorMessage('type')"
                @input="updateTemplateField"
                v-model="editableTemplateField.type"
            />

            <input-group
                class="flex-1 mt-4 md:mt-0"
                :input-disabled="true"
                :input-id="`template-field-${templateField.order}-order`"
                :input-name="`template-field-${templateField.order}-order`"
                input-type="number"
                label-text="Order"
                @input="updateTemplateField"
                v-model="editableTemplateField.order"
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
                :error-message="getErrorMessage('name')"
                :input-id="`template-field-${templateField.order}-name`"
                :input-name="`template-field-${templateField.order}-name`"
                :input-required="true"
                input-type="text"
                label-text="Field Name"
                @errorHidden="clearErrorMessage('name')"
                @input="onNameInput"
                v-model="editableTemplateField.name"
            />

            <input-group
                class="flex-1 mt-4"
                :error-message="getErrorMessage('slug')"
                :input-id="`template-field-${templateField.order}-slug`"
                :input-name="`template-field-${templateField.order}-slug`"
                :input-required="true"
                input-type="text"
                label-text="Field Slug"
                @blur="onSlugBlur"
                @errorHidden="clearErrorMessage('slug')"
                @input="onSlugInput"
                v-model="editableTemplateField.slug"
            />
        </div>

        <input-group
            class="mt-4"
            :error-message="getErrorMessage('description')"
            :input-id="`template-field-${templateField.order}-description`"
            :input-name="`template-field-${templateField.order}-description`"
            input-type="text"
            label-text="Description"
            @errorHidden="clearErrorMessage('description')"
            @input="updateTemplateField"
            v-model="editableTemplateField.description"
        />

        <checkbox-group
            class="mt-4"
            :error-message="getErrorMessage('is_required')"
            :input-id="`template-field-${templateField.order}-is_required`"
            :input-name="`template-field-${templateField.order}-is_required`"
            label-text="Required?"
            @errorHidden="clearErrorMessage('is_required')"
            @input="updateTemplateField"
            v-model="editableTemplateField.is_required"
        />

        <component
            v-if="settingsComponent"
            :is="settingsComponent"
            :default-settings="defaultFieldSettings"
            :template-field="editableTemplateField"
            @input="updateTemplateField"
            v-model="editableTemplateField.settings"
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
    import RepeaterSettings from "./template_field_settings/RepeaterSettings";
    import SelectGroup      from "../../../../core/forms/SelectGroup";
    import TextAreaSettings from "./template_field_settings/TextAreaSettings";
    import TextSettings     from "./template_field_settings/TextSettings";

    export default {
        name: "TemplateField",
        components: {
            CheckboxGroup,
            InputGroup,
            NumberSettings,
            RepeaterSettings,
            SelectGroup,
            TextAreaSettings,
            TextSettings,
        },
        model: {
            prop: 'templateField'
        },
        props: {
            errorMessageKeyPrefix: {
                default: 'templateFields',
                type: String
            },
            isAutofocusDisabled: {
                default: false,
                type: Boolean
            },
            isViewOnly: {
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
                editableTemplateField: {
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
            defaultFieldSettings() {
                if (!this.editableTemplateField.type) {
                    return false;
                }

                try {
                    return this.templateFieldSettings[this.editableTemplateField.type];
                } catch (e) {
                    return {};
                }
            },
            errorMessageKey() {
                return this.errorMessageKeyPrefix + '.' + this.editableTemplateField.order + '.';
            },
            settingsComponent() {
                if (!this.editableTemplateField.type) {
                    return false;
                }

                switch (this.editableTemplateField.type) {
                    case 'number' :
                        return 'number-settings';
                    case 'repeater' :
                        return 'repeater-settings';
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
            this.editableTemplateField = _.cloneDeep(this.templateField);

            // If there is an existing slug, disable the auto slug update
            if (this.editableTemplateField.slug && this.editableTemplateField.slug !== '') {
                this.autoUpdateSlug = false;
            }
        },
        methods: {
            clearErrorMessage(field) {
                this.clearPageErrorMessage(this.errorMessageKey + field);
            },
            getErrorMessage(field) {
                let message = this.getPageErrorMessage(this.errorMessageKey + field);
                message = message.replace(this.errorMessageKey, '');
                return message;
            },
            onNameInput() {
                if (!this.autoUpdateSlug) {
                    this.updateTemplateField();
                    return;
                }

                this.editableTemplateField.slug = this.slugify(this.editableTemplateField.name);
                this.updateTemplateField();
            },
            onSlugBlur() {
                this.editableTemplateField.slug = this.slugify(this.editableTemplateField.slug);
                this.updateTemplateField();
            },
            onSlugInput() {
                this.autoUpdateSlug = false;
            },
            onTemplateFieldUpdate() {
                this.editableTemplateField = _.cloneDeep(this.templateField);
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
                this.$emit('input', _.cloneDeep(this.editableTemplateField));
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
