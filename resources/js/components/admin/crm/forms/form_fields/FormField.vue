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
                :input-id="`form-field-${formField.order}-type`"
                :input-name="`form-field-${formField.order}-type`"
                :input-options="selectableFormFieldTypes"
                :input-required="true"
                @errorHidden="clearErrorMessage('type')"
                @input="updateFormField"
                v-model="editableFormField.type"
            />

            <input-group
                class="flex-1 mt-4 md:mt-0"
                :input-disabled="true"
                :input-id="`form-field-${formField.order}-order`"
                :input-name="`form-field-${formField.order}-order`"
                input-type="number"
                label-text="Order"
                @input="updateFormField"
                v-model="editableFormField.order"
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
                :input-id="`template-field-${formField.order}-name`"
                :input-name="`template-field-${formField.order}-name`"
                :input-required="true"
                input-type="text"
                label-text="Field Name"
                @errorHidden="clearErrorMessage('name')"
                @input="onNameInput"
                v-model="editableFormField.name"
            />

            <input-group
                class="flex-1 mt-4"
                :error-message="getErrorMessage('slug')"
                :input-disabled="isCrmFieldType"
                :input-id="`template-field-${formField.order}-slug`"
                :input-name="`template-field-${formField.order}-slug`"
                :input-required="true"
                input-type="text"
                label-text="Field Slug"
                @blur="onSlugBlur"
                @input="onSlugInput"
                v-model="editableFormField.slug"
            />
        </div>

        <checkbox-group
            class="mt-4"
            :input-id="`template-field-${formField.order}-is_required`"
            :input-name="`template-field-${formField.order}-is_required`"
            :error-message="getErrorMessage('is_required')"
            label-text="Required?"
            @input="updateFormField"
            v-model="editableFormField.is_required"
        />


        <component
            v-if="settingsComponent"
            :is="settingsComponent"
            :default-settings="defaultFieldSettings"
            :form-field="editableFormField"
            @input="updateFormField"
            v-model="editableFormField.settings"
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
    import NumberSettings   from "./form_field_settings/NumberSettings";
    import SelectGroup      from "../../../../core/forms/SelectGroup";
    import TextAreaSettings from "./form_field_settings/TextAreaSettings";
    import TextSettings     from "./form_field_settings/TextSettings";

    export default {
        name: "FormField",
        components: {
            CheckboxGroup,
            InputGroup,
            NumberSettings,
            SelectGroup,
            TextAreaSettings,
            TextSettings,
        },
        model: {
            prop: 'formField'
        },
        props: {
            crmFormFieldTypes: {

            },
            errorMessageKeyPrefix: {
                default: 'formFields',
                type: String
            },
            formField: {
                required: true,
                type: Object
            },
            formFieldSettings: {
                required: true,
                type: Object
            },
            formFieldTypes: {
                required: true,
                type: Object,
            },
            isAutofocusDisabled: {
                default: false,
                type: Boolean
            },
            isViewOnly: {
                default: false,
                type: Boolean
            },
        },
        data() {
            return {
                autoUpdateSlug: true,
                editableFormField: {
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
                if (!this.editableFormField.type) {
                    return false;
                }

                try {
                    return this.formFieldSettings[this.editableFormField.type];
                } catch (e) {
                    return {};
                }
            },
            errorMessageKey() {
                return this.errorMessageKeyPrefix + '.' + this.editableFormField.order + '.';
            },
            isCrmFieldType() {
                try {
                    if (!this.editableFormField) {
                        return false;
                    }

                    return Object.keys(this.crmFormFieldTypes).indexOf(this.editableFormField.type) >= 0;
                } catch (e) {
                    return false;
                }
            },
            selectableFormFieldTypes() {
                let types = {};

                // Add the currently selected type if it's a CRM type
                if (this.isCrmFieldType) {
                    types[this.editableFormField.type] = this.crmFormFieldTypes[this.editableFormField.type];
                }

                types = {...types, ...this.formFieldTypes}

                return types;
            },
            settingsComponent() {
                if (!this.editableFormField.type) {
                    return false;
                }

                switch (this.editableFormField.type) {
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
            this.editableFormField = _.cloneDeep(this.formField);

            // If there is an existing slug, disable the auto slug update
            if (this.editableFormField.slug && this.editableFormField.slug !== '') {
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
            onEditableFormFieldUpdate() {
                if (this.isCrmFieldType) {
                    // Use the type as slug for CRM fields
                    this.$set(
                        this.editableFormField,
                        'slug',
                        this.editableFormField.type
                    );
                }
            },
            onFormFieldUpdate() {
                this.editableFormField = _.cloneDeep(this.formField);
            },
            onNameInput() {
                if (!this.autoUpdateSlug || this.isCrmFieldType) {
                    this.updateFormField();
                    return;
                }

                this.editableFormField.slug = this.slugify(this.editableFormField.name);
                this.updateFormField();
            },
            onSlugBlur() {
                this.editableFormField.slug = this.slugify(this.editableFormField.slug);
                this.updateFormField();
            },
            onSlugInput() {
                this.autoUpdateSlug = false;
            },
            slugify(value) {
                if (!value || !value.length) {
                    return '';
                }

                return slugify(value, {
                    lower: true,
                    replacement: '_',
                });
            },
            updateFormField() {
                this.$emit('input', _.cloneDeep(this.editableFormField));
            }
        },
        watch: {
            editableFormField: {
                deep: true,
                handler: 'onEditableFormFieldUpdate'
            },
            // TODO: I'd like a more elegant / efficient solution
            // - This fixes some "oddities" to ensure data is re-ordered properly via draggable
            // - But it does get called quite a lot, especially if there are a lot of fields
            formField: {
                deep: true,
                handler: 'onFormFieldUpdate'
            }
        }
    }
</script>