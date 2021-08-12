<template>
    <div>
        <div class="flex flex-row items-center">
            <span class="text-lg">Template Fields</span>
            <button
                class="button button-primary-subtle button-small ml-auto text-sm"
                type="button"
                @click="addTemplateField"
            >
                Add Field
            </button>
        </div>

        <p
            v-if="!editableTemplateFields.length"
            class="bg-theme-base-subtle mt-6 px-4 py-3 rounded text-center text-theme-base-subtle-contrast"
        >
            No template fields
        </p>

        <template v-else>
            <draggable
                class="mt-6"
                :animation="200"
                :disabled="isViewOnly"
                ghost-class="ghost"
                handle=".draggable-handle"
                @end="onDraggableEnd"
                @sort="onDraggableSort"
                @start="onDraggableStart"
                v-model="editableTemplateFields"
            >
                <transition-group
                    :name="!isDragging ? 'flip-field' : null"
                    type="transition"
                >
                    <article
                        v-for="(templateField, index) in editableTemplateFields"
                        :key="`template-field-${index}`"
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
                                <template v-if="templateField.name && templateField.name.length">
                                    {{ templateField.name }}
                                </template>
                                <template v-else>
                                    New Template Field
                                </template>
                            </span>
                        </header>

                        <p class="p-4">
                            <template-field
                                :is-autofocus-disabled="isAutofocusDisabled"
                                :template-field-types="templateFieldTypes"
                                :template-field-settings="templateFieldSettings"
                                @input="updateTemplateFields"
                                v-model="editableTemplateFields[index]"
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
                                @click="deleteTemplateField(index)"
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
                @click="addTemplateField"
            >
                Add Field
            </button>
        </div>
        </template>
    </div>
</template>

<script>
    import _ from 'lodash';
    import draggable from 'vuedraggable';
    import TemplateField from "./template_fields/TemplateField";

    export default {
        name: 'TemplateFieldEditor',
        components: {
            draggable,
            TemplateField
        },
        model: {
            prop: 'templateFields'
        },
        props: {
            isEditing: {
                default: false,
                type: Boolean
            },
            isViewOnly: {
                default: false,
                type: Boolean
            },
            templateFieldSettings: {
                required: true,
                type: Object,
            },
            templateFieldTypes: {
                required: true,
                type: Object,
            },
            templateFields: {
                required: true,
                type: Array,
            },
        },
        data() {
            return {
                editableTemplateFields: [],
                isAutofocusDisabled: false,
                isDragging: false,
            }
        },
        created() {
            if (this.isEditing) {
                this.isAutofocusDisabled = true;
            }
            this.editableTemplateFields = _.cloneDeep(this.templateFields);
        },
        methods: {
            addTemplateField() {
                this.isAutofocusDisabled = false;

                this.editableTemplateFields.push({
                    description: '',
                    is_required: false,
                    name: '',
                    order: this.templateFields.length,
                    settings: {},
                    slug: '',
                    type: '',
                });

                this.updateTemplateFields();
            },
            deleteTemplateField(index) {
                try {
                    this.editableTemplateFields.splice(index, 1);
                    this.reorderTemplateFields();
                } catch (e) {
                    this.$errorToast('Failed to delete field');
                    console.log(e); // TODO: This should go through to a log tracker once available
                }
            },
            getTemplateFieldTypesKeys() {
                try {
                    return Object.keys(this.templateFieldTypes);
                } catch (e) {
                    return [];
                }
            },
            onDraggableEnd() {
                this.isDragging = false;
                this.reorderTemplateFields();
            },
            onDraggableSort() {
                // Clear page errors as indexes have changed
                this.$page.props.errors = {};
            },
            onDraggableStart() {
                this.isDragging = true;
            },
            onTemplateFieldsChange(fields) {
                this.editableTemplateFields = _.cloneDeep(fields);
            },
            onTemplateFieldTypesChange() {
                try {
                    let allowedFields = this.getTemplateFieldTypesKeys();
                    _.forEach(this.editableTemplateFields, (field, key) => {
                        if (field.type && allowedFields.indexOf(field.type) < 0) {
                            this.editableTemplateFields[key].type = '';
                        }
                    });

                    this.updateTemplateFields();
                } catch (e) {
                    console.log(e); // TODO: Replace with error tracker
                }
            },
            reorderTemplateFields() {
                try {
                    if (!this.editableTemplateFields.length) {
                        this.updateTemplateFields();
                        return;
                    }

                    this.editableTemplateFields.forEach((field, index) => {
                        this.editableTemplateFields[index].order = index;
                    });

                    this.updateTemplateFields();
                } catch (e) {
                    throw "Failed to reorder fields: " + e
                }
            },
            updateTemplateFields() {
                this.$emit('input', _.cloneDeep(this.editableTemplateFields));
            }
        },
        watch: {
            templateFields: {
                handler: 'onTemplateFieldsChange'
            },
            templateFieldTypes: {
                handler: 'onTemplateFieldTypesChange',
                deep: true,
            }
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

