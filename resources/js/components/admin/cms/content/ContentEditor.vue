<template>
    <div class="flex flex-col space-y-4">

        <p
            v-if="getPageErrorMessage(contentFieldSlug)"
            class="text-theme-danger-contrast"
        >
            {{ getPageErrorMessage(contentFieldSlug) }}
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
                <div class="mb-2">
                    <p class="flex flex-row font-medium items-baseline text-theme-base-contrast text-sm tracking-wider">
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
    import CmsMenuField from "./content_fields/CmsMenuField";
    import CrmFormField from "./content_fields/CrmFormField";
    import ImageField from "./content_fields/ImageField";
    import NumberField from "./content_fields/NumberField";
    import RepeaterField from "./content_fields/RepeaterField";
    import TextAreaField from "./content_fields/TextAreaField";
    import TextField from "./content_fields/TextField";
    import WysiwygField from "./content_fields/WysiwygField";

    export default {
        name: 'AdminCmsContentEditor',
        components: {
            CmsMenuField,
            CrmFormField,
            ImageField,
            NumberField,
            RepeaterField,
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
            contentFieldSlug: {
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
                    case 'cms_menu':
                        return 'CmsMenuField';
                    case 'crm_form':
                        return 'CrmFormField';
                    case 'image':
                        return 'ImageField';
                    case 'number':
                        return 'NumberField';
                    case 'repeater':
                        return 'RepeaterField';
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
