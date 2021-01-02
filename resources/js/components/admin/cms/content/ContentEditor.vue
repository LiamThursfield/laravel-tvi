<template>
    <div class="flex flex-col space-y-4">

        <p
            v-if="getPageErrorMessage(content_field_slug)"
            class="text-theme-danger-contrast"
        >
            {{ getPageErrorMessage(content_field_slug) }}
        </p>

        <div
            v-for="template_field in template_fields"
            :key="template_field.id"
        >
            <component
                :is="getContentFieldComponent(template_field)"
                :template_field="template_field"
                @input="onEditableContentUpdate"
                v-model="editable_content[template_field.id].data"
            >
                <div>
                    <p class="flex flex-row items-baseline">
                        <span>{{ template_field.name }}</span>
                        <sup
                            v-if="template_field.is_required"
                            class="text-theme-danger-contrast"
                        >
                            *
                        </sup>
                    </p>
                    <p
                        v-if="template_field.description"
                        class="text-sm text-theme-base-subtle-contrast"
                    >
                        {{ template_field.description }}
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
            template_fields: {
                required: true,
                type: Array
            }
        },
        data() {
            return {
                editable_content: {},
            }
        },
        created() {
            // If there is existing content, clone it
            if (typeof this.content === 'object' && Object.keys(this.content).length > 0) {
                this.editable_content = _.cloneDeep(this.content);
            }
        },
        methods: {
            getContentFieldComponent(template_field) {
                switch (template_field.type) {
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
                        this.$errorToast('Unregistered content field for template field: ' + template_field.type);
                        return false;
                }
            },
            onEditableContentUpdate() {
                this.$emit('input', _.cloneDeep(this.editable_content));
            }
        }
    }
</script>
