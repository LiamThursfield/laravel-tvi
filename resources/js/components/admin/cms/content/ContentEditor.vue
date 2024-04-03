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
    import CmsMenuField from "./content_fields/CmsMenuField.vue";
    import CrmFormField from "./content_fields/CrmFormField.vue";
    import EduCourseField from "./content_fields/EduCourseField.vue";
    import CrmOrganisationUnitField from "./content_fields/CrmOrganisationUnitField.vue";
    import ImageField from "./content_fields/ImageField.vue";
    import NumberField from "./content_fields/NumberField.vue";
    import RepeaterField from "./content_fields/RepeaterField.vue";
    import TextAreaField from "./content_fields/TextAreaField.vue";
    import TextField from "./content_fields/TextField.vue";
    import WysiwygField from "./content_fields/WysiwygField.vue";

    export default {
        name: 'AdminCmsContentEditor',
        components: {
            CmsMenuField,
            CrmFormField,
            CrmOrganisationUnitField,
            EduCourseField,
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
                    case 'crm_organisation_unit':
                        return 'CrmOrganisationUnitField';
                    case 'edu_course':
                        return 'EduCourseField';
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
