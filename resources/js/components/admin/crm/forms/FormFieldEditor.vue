<template>
    <div>
        <div class="flex flex-row items-center">
            <span class="font-medium mb-4 text-theme-base-contrast tracking-wider">
                Form Fields
            </span>
        </div>

        <p
            v-if="!editableFormFields.length"
            class="bg-theme-base-subtle mt-6 px-4 py-3 rounded text-center text-theme-base-subtle-contrast"
        >
            No form fields
        </p>

        <draggable
            v-else
            class="mt-6"
            :animation="200"
            :disabled="isViewOnly"
            ghost-class="ghost"
            handle=".draggable-handle"
            @end="onDraggableEnd"
            @sort="onDraggableSort"
            @start="onDraggableStart"
            v-model="editableFormFields"
        >
            <transition-group
                :name="!isDragging ? 'flip-field' : null"
                type="transition"
            >
                <article
                    v-for="(formField, index) in editableFormFields"
                    :key="`form-field-${index}`"
                    class="border-2 border-theme-base-subtle mt-4 overflow-hidden rounded"
                >
                    <!-- Draggable Header -->
                    <header
                        class="
                            draggable-handle
                            bg-theme-base-subtle cursor-move flex flex-row items-center px-4 py-3
                        "
                    >
                        <icon-grid-dots class="w-5" />

                        <span class="flex-1 pl-4">
                            <template v-if="formField.name && formField.name.length">
                                {{ formField.name }}
                            </template>
                            <template v-else>
                                New Form Field
                            </template>
                        </span>
                    </header>

                    <p class="p-4">
                        <form-field
                            :crm-form-field-types="crmFormFieldTypes"
                            :form-field-types="selectableFormFieldTypes"
                            :form-field-settings="formFieldSettings"
                            :is-autofocus-disabled="isAutofocusDisabled"
                            @input="updateFormFields"
                            v-model="editableFormFields[index]"
                        />
                    </p>

                    <footer class="flex flex-row items-center px-4 py-3">
                        <button
                            class="
                                button button-small
                                bg-transparent border border-theme-base-subtle-contrast flex flex-row items-center ml-auto text-sm text-theme-base-subtle-contrast
                                hover:bg-theme-danger-contrast hover:text-theme-danger hover:border-theme-danger-contrast
                            "
                            type="button"
                            @click="deleteFormField(index)"
                        >
                            <icon-trash class="h-4 w-4" />
                            <span class="pl-2">Delete</span>
                        </button>
                    </footer>

                </article>
            </transition-group>
        </draggable>

        <div class="flex flex-row items-center mt-6">
            <button
                class="button button-primary-subtle button-small ml-auto text-sm"
                type="button"
                @click="addFormField"
            >
                Add Field
            </button>
        </div>

    </div>
</template>

<script>
    import _ from 'lodash';
    import draggable from 'vuedraggable';
    import FormField from "./form_fields/FormField";

    export default {
        name: 'FormFieldEditor',
        components: {
            draggable,
            FormField,
        },
        model: {
            prop: 'formFields'
        },
        props: {
            crmFormFieldTypes: {
                type: Object,
                required: true
            },
            formFields: {
                required: true,
                type: Array
            },
            formFieldSettings: {
                type: Object,
                required: true
            },
            isEditing: {
                default: false,
                type: Boolean
            },
            isViewOnly: {
                default: false,
                type: Boolean
            },
            standardFormFieldTypes: {
                type: Object,
                required: true
            },
        },
        data() {
            return {
                editableFormFields: [],
                isAutofocusDisabled: false,
                isDragging: false,
            }
        },
        computed: {
            selectedFormFieldTypes() {
                let types = new Set();

                _.forEach(this.editableFormFields, field => {
                    if (field.type) {
                        types.add(field.type);
                    }
                });

                return types;
            },
            selectableFormFieldTypes() {

                // CRM fields can only be selected once
                let availableCrmTypes = {};
                _.forEach(this.crmFormFieldTypes, (label, slug) => {
                    if (!this.selectedFormFieldTypes.has(slug)) {
                        availableCrmTypes[slug] = label;
                    }
                });

                return {...availableCrmTypes, ...this.standardFormFieldTypes};

            },
        },
        created() {
            if (this.isEditing) {
                this.isAutofocusDisabled = true;
            }
            this.editableFormFields = _.cloneDeep(this.formFields);
        },
        methods: {
            addFormField() {
                this.isAutofocusDisabled = false;

                this.editableFormFields.push({
                    is_required: false,
                    name: '',
                    order: this.formFields.length,
                    settings: {},
                    slug: '',
                    type: '',
                });

                this.updateFormFields();
            },
            deleteFormField(index) {
                try {
                    this.editableFormFields.splice(index, 1);
                    this.reorderFormFields();
                } catch (e) {
                    this.$errorToast('Failed to delete field');
                    console.log(e); // TODO: This should go through to a log tracker once available
                }
            },
            onDraggableEnd() {
                this.isDragging = false;
                this.reorderFormFields();
            },
            onDraggableSort() {
                // Clear page errors as indexes have changed
                this.$page.props.errors = {};
            },
            onDraggableStart() {
                this.isDragging = true;
            },
            onFormFieldsChange(fields) {
                this.editableFormFields = _.cloneDeep(fields);
            },
            reorderFormFields() {
                try {
                    if (!this.editableFormFields.length) {
                        this.updateFormFields();
                        return;
                    }

                    this.editableFormFields.forEach((field, index) => {
                        this.editableFormFields[index].order = index;
                    });

                    this.updateFormFields();
                } catch (e) {
                    throw "Failed to reorder fields: " + e
                }
            },
            updateFormFields() {
                this.$emit('input', _.cloneDeep(this.editableFormFields));
            }
        },
        watch: {
            formFields: {
                handler: 'onFormFieldsChange'
            },
        }
    }
</script>

<style scoped>
    .ghost {
        opacity: 0.35;
    }

    .flip-field-move {
        transition: transform 0.5s;
    }

    .no-move {
        transition: transform 0s;
    }
</style>
