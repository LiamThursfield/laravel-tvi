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
            v-if="!editable_template_fields.length"
            class="border-2 border-theme-base-subtle mt-6 px-4 py-3 rounded text-center text-theme-base-subtle-contrast"
        >
            No template fields
        </p>

        <draggable
            v-else
            class="mt-6"
            :animation="200"
            :disabled="is_view_only"
            ghostClass="ghost"
            handle=".draggable-handle"
            @end="onDraggableEnd"
            @sort="onDraggableSort"
            @start="onDraggableStart"
            v-model="editable_template_fields"
        >
            <transition-group
                :name="!is_dragging ? 'flip-field' : null"
                type="transition"
            >
                <article
                    v-for="(template_field, index) in editable_template_fields"
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
                            <template v-if="template_field.name && template_field.name.length">
                                {{ template_field.name }}
                            </template>
                            <template v-else>
                                New Template Field
                            </template>
                        </span>
                    </header>

                    <p class="p-4">
                        <template-field
                            :is_autofocus_disabled="is_autofocus_disabled"
                            :template_field_types="template_field_types"
                            :template_field_settings="template_field_settings"
                            @input="updateTemplateFields"
                            v-model="editable_template_fields[index]"
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
            prop: 'template_fields'
        },
        props: {
            is_editing: {
                default: false,
                type: Boolean
            },
            is_view_only: {
                default: false,
                type: Boolean
            },
            'template_field_settings': {
                type: Object,
                required: true
            },
            template_field_types: {
                required: true,
                type: Object,
            },
            template_fields: {
                required: true,
                type: Array
            },
        },
        data() {
            return {
                editable_template_fields: [],
                is_autofocus_disabled: false,
                is_dragging: false,
            }
        },
        created() {
            if (this.is_editing) {
                this.is_autofocus_disabled = true;
            }
            this.editable_template_fields = _.cloneDeep(this.template_fields);
        },
        methods: {
            addTemplateField() {
                this.is_autofocus_disabled = false;

                this.editable_template_fields.push({
                    description: '',
                    is_required: false,
                    name: '',
                    order: this.template_fields.length,
                    settings: {},
                    slug: '',
                    type: '',
                });

                this.updateTemplateFields();
            },
            deleteTemplateField(index) {
                try {
                    this.editable_template_fields.splice(index, 1);
                    this.reorderTemplateFields();
                } catch (e) {
                    this.$errorToast('Failed to delete field');
                    console.log(e); // TODO: This should go through to a log tracker once available
                }
            },
            onDraggableEnd() {
                this.is_dragging = false;
                this.reorderTemplateFields();
            },
            onDraggableSort() {
                // Clear page errors as indexes have changed
                this.$page.props.errors = {};
            },
            onDraggableStart() {
                this.is_dragging = true;
            },
            onTemplateFieldsChange(fields) {
                this.editable_template_fields = _.cloneDeep(fields);
            },
            onEditableTemplateFieldInput() {
                this.updateTemplateFields();
            },
            reorderTemplateFields() {
                try {
                    if (!this.editable_template_fields.length) {
                        this.updateTemplateFields();
                        return;
                    }

                    this.editable_template_fields.forEach((field, index) => {
                        this.editable_template_fields[index].order = index;
                    });

                    this.updateTemplateFields();
                } catch (e) {
                    throw "Failed to reorder fields: " + e
                }
            },
            updateTemplateFields() {
                this.$emit('input', _.cloneDeep(this.editable_template_fields));
            }
        },
        watch: {
            template_fields: {
                handler: 'onTemplateFieldsChange'
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

