<template>
    <div class="flex flex-col space-y-4">

        <p
            v-if="getPageErrorMessage(content_field_slug)"
            class="text-theme-danger-contrast"
        >
            {{ getPageErrorMessage(content_field_slug) }}
        </p>

        <div
            v-for="templateField in templateFields"
            :key="templateField.id"
        >
            <component
                :is="getContentFieldComponent(templateField)"
                :template-field="templateField"
                @input="onEditableContentUpdate"
                v-model="editableContent[templateField.id].data"
            >
                <div>
                    <p class="flex flex-row items-baseline">
                        <span>{{ templateField.name }}</span>
                        <sup
                            v-if="templateField.is_required"
                            class="text-theme-danger-contrast"
                        >
                            *
                        </sup>
                    </p>
                    <p
                        v-if="templateField.description"
                        class="text-sm text-theme-base-subtle-contrast"
                    >
                        {{ templateField.description }}
                    </p>
                </div>
            </component>
        </div>
    </div>
</template>

<script>
    import _ from 'lodash';
    import ImageField from "./content_fields/ImageField";
    import NumberField from "./content_fields/NumberField";
    import TextAreaField from "./content_fields/TextAreaField";
    import TextField from "./content_fields/TextField";
    import WysiwygField from "./content_fields/WysiwygField";

    export default {
        name: 'AdminCmsContentEditor',
        components: {
            ImageField,
            NumberField,
            TextAreaField,
            TextField,
            WysiwygField,
        },
        model: {
            prop: 'content',
        },
        props: {
            content: {
                required: true,
                type: Array | Object
            },
            content_field_slug: {
                default: 'content',
                type: String,
            },
            templateFields: {
                required: true,
                type: Array
            }
        },
        data() {
            return {
                editableContent: {},
            }
        },
        created() {
            // If there is existing content, clone it
            if (typeof this.content === 'object' && Object.keys(this.content).length > 0) {
                this.editableContent = _.cloneDeep(this.content);
            }
        },
        methods: {
            getContentFieldComponent(templateField) {
                switch (templateField.type) {
                    case 'image':
                        return 'ImageField';
                    case 'number':
                        return 'NumberField';
                    case 'text':
                        return 'TextField';
                    case 'textarea':
                        return 'TextAreaField';
                    case 'wysiwyg':
                        return 'WysiwygField';
                    default:
                        this.$errorToast('Unregistered content field for template field: ' + templateField.type);
                        return false;
                }
            },
            onEditableContentUpdate() {
                this.$emit('input', _.cloneDeep(this.editableContent));
            }
        }
    }
</script>