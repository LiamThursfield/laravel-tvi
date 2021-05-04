<template>
    <form
        class="max-w-5xl mx-auto"
        autocomplete="off"
        @submit.prevent="submit"
    >
        <div
            v-if="userCan('cms_advanced.create')"
            class="flex flex-row items-center mb-6"
        >
            <h1 class="font-medium mr-auto text-lg">
                Create Template
            </h1>

            <inertia-link
                v-if="userCan('cms_advanced.view')"
                class="
                    button button-default-responsive button-primary-subtle
                    flex flex-row items-center mr-2
                "
                :href="$route('admin.cms.templates.index')"
            >
                <icon-chevron-left
                    class="w-5 md:mr-2"
                />
                <span
                    class="hidden md:inline"
                >
                    Back
                </span>
            </inertia-link>

            <button
                class="
                    button button-default-responsive button-primary
                    flex flex-row items-center
                "
                type="submit"
            >
                <icon-save class="w-5 md:mr-2"/>

                <span
                    class="hidden md:inline"
                >
                    Create Template
                </span>
            </button>
        </div>


        <div class="bg-white py-6 shadow-subtle rounded-lg">
            <div class="block px-6 w-full">

                <select-group
                    :error-message="getPageErrorMessage('type')"
                    label-text="Template Type"
                    :input-any-option-enabled="true"
                    input-any-option-label="Please select a template type"
                    :input-autofocus="true"
                    input-id="type"
                    input-name="type"
                    :input-options="templateTypes"
                    :input-required="true"
                    v-model="formData.type"
                    @errorHidden="clearPageErrorMessage('type')"
                />

                <input-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('name')"
                    input-autocomplete="template_name"
                    input-id="name"
                    input-name="name"
                    :input-required="true"
                    input-type="text"
                    label-text="Template Name"
                    @input="onNameInput"
                    v-model="formData.name"
                    @errorHidden="clearPageErrorMessage('name')"
                />

                <input-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('slug')"
                    input-autocomplete="template_slug"
                    input-id="slug"
                    input-name="slug"
                    :input-required="true"
                    input-type="text"
                    label-text="Template Slug"
                    @blur="onSlugBlur"
                    @input="onSlugInput"
                    v-model="formData.slug"
                    @errorHidden="clearPageErrorMessage('slug')"
                />

                <input-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('description')"
                    input-autocomplete="template_description"
                    input-id="description"
                    input-name="description"
                    input-type="text"
                    label-text="Description"
                    v-model="formData.description"
                    @errorHidden="clearPageErrorMessage('description')"
                />
            </div>
        </div>

        <div class="bg-white mt-6 py-6 shadow-subtle rounded-lg">
            <div class="block px-6 w-full">
                <template-field-editor
                    :template-field-settings="templateFieldSettings"
                    :template-field-types="allowedTemplateFieldTypes"
                    v-model="formData.template_fields"
                />
            </div>
        </div>
    </form>
</template>

<script>
    import slugify from 'slugify';
    import InputGroup from "../../../../components/core/forms/InputGroup";
    import SelectGroup from "../../../../components/core/forms/SelectGroup";
    import TemplateFieldEditor from "../../../../components/admin/cms/templates/TemplateFieldEditor"

    export default {
        name: "AdminCmsTemplateCreate",
        components: {
            InputGroup,
            SelectGroup,
            TemplateFieldEditor,
        },
        layout: 'admin-layout',
        props: {
            'repeaterTemplateFieldTypes': {
                type: Object,
                required: true
            },
            'templateFieldSettings': {
                type: Object,
                required: true
            },
            'templateFieldTypes': {
                type: Object,
                required: true
            },
            'templateTypes': {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                autoUpdateSlug: true,
                formData: {
                    description: '',
                    name: '',
                    slug: '',
                    template_fields: [],
                    type: '',
                },
            }
        },
        computed: {
            allowedTemplateFieldTypes() {
                if (this.formData.type === 'repeater') {
                    return this.repeaterTemplateFieldTypes;
                }

                return this.templateFieldTypes;
            }
        },
        methods: {
            onNameInput() {
                if (!this.autoUpdateSlug) {
                    return;
                }

                this.formData.slug = this.slugify(this.formData.name);
            },
            onSlugBlur() {
                this.formData.slug = this.slugify(this.formData.slug)
            },
            onSlugInput() {
                this.autoUpdateSlug = false;
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
            submit() {
                this.$inertia.post(
                    this.$route('admin.cms.templates.store'),
                    this.formData
                );
            }
        }
    }
</script>
