<template>
    <form
        class="max-w-5xl mx-auto"
        autocomplete="off"
        @submit.prevent="submit"
    >
        <div
            v-if="userCan('cms.create')"
            class="flex flex-row items-center mb-6"
        >
            <h1 class="mr-auto text-lg">
                Create Template
            </h1>

            <inertia-link
                v-if="userCan('cms.view')"
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
                    :errorMessage="getPageErrorMessage('type')"
                    labelText="Template Type"
                    :selectAnyEnabled="true"
                    selectAnyLabel="Please select a template type"
                    :selectAutoFocus="true"
                    selectId="type"
                    selectName="type"
                    :selectOptions="templateTypes"
                    :selectRequired="true"
                    v-model="formData.type"
                />

                <input-group
                    class="mt-4"
                    :errorMessage="getPageErrorMessage('name')"
                    inputAutocomplete="template_name"
                    inputId="name"
                    inputName="name"
                    :inputRequired="true"
                    inputType="text"
                    labelText="Template Name"
                    @input="onNameInput"
                    v-model="formData.name"
                />

                <input-group
                    class="mt-4"
                    :errorMessage="getPageErrorMessage('slug')"
                    inputAutocomplete="template_slug"
                    inputId="slug"
                    inputName="slug"
                    :inputRequired="true"
                    inputType="text"
                    labelText="Template Slug"
                    @blur="onSlugBlur"
                    @input="onSlugInput"
                    v-model="formData.slug"
                />

                <input-group
                    class="mt-4"
                    :errorMessage="getPageErrorMessage('description')"
                    inputAutocomplete="template_description"
                    inputId="description"
                    inputName="description"
                    inputType="text"
                    labelText="Description"
                    v-model="formData.description"
                />
            </div>
        </div>

        <div class="bg-white mt-6 py-6 shadow-subtle rounded-lg">
            <div class="block px-6 w-full">
                <template-field-editor
                    :templateFieldSettings="templateFieldSettings"
                    :templateFieldTypes="templateFieldTypes"
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
