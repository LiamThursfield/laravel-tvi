<template>
    <form
        class="max-w-5xl mx-auto"
        autocomplete="off"
        @submit.prevent="submit"
    >
        <div
            v-if="userCan('cms.edit')"
            class="flex flex-row items-center mb-6"
        >
            <h1 class="mr-auto text-lg">
                Edit Template - {{ template.name }}
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
                    Edit Template
                </span>
            </button>
        </div>


        <div class="bg-white py-6 shadow-subtle rounded-lg">
            <div class="block px-6 w-full">

                <select-group
                    :error_message="getPageErrorMessage('type')"
                    label_text="Template Type"
                    :select_any_enabled="true"
                    select_any_label="Please select a template type"
                    :select_autofocus="true"
                    select_id="type"
                    select_name="type"
                    :select_options="template_types"
                    :select_required="true"
                    select_type="text"
                    v-model="form_data.type"
                />

                <input-group
                    class="mt-4"
                    :error_message="getPageErrorMessage('name')"
                    input_autocomplete="template_name"
                    input_id="name"
                    input_name="name"
                    :input_required="true"
                    input_type="text"
                    label_text="Template Name"
                    @input="onNameInput"
                    v-model="form_data.name"
                />

                <input-group
                    class="mt-4"
                    :error_message="getPageErrorMessage('slug')"
                    input_autocomplete="template_slug"
                    input_id="slug"
                    input_name="slug"
                    :input_required="true"
                    input_type="text"
                    label_text="Template Slug"
                    @blur="onSlugBlur"
                    v-model="form_data.slug"
                />

                <input-group
                    class="mt-4"
                    :error_message="getPageErrorMessage('description')"
                    input_autocomplete="template_description"
                    input_id="description"
                    input_name="description"
                    input_type="text"
                    label_text="Description"
                    v-model="form_data.description"
                />
            </div>
        </div>

        <div class="bg-white mt-6 py-6 shadow-subtle rounded-lg">
            <div class="block px-6 w-full">
                <template-field-editor
                    :is_editing="true"
                    :template_field_settings="template_field_settings"
                    :template_field_types="template_field_types"
                    v-model="form_data.template_fields"
                />
            </div>
        </div>
    </form>
</template>

<script>
    import _ from 'lodash';
    import slugify from 'slugify';
    import InputGroup from "../../../../components/core/forms/InputGroup";
    import SelectGroup from "../../../../components/core/forms/SelectGroup";
    import TemplateFieldEditor from "../../../../components/admin/cms/templates/TemplateFieldEditor"

    export default {
        name: "AdminCmsTemplateEdit",
        components: {
            InputGroup,
            SelectGroup,
            TemplateFieldEditor,
        },
        layout: 'admin-layout',
        props: {
            'template': {
                type: Object,
                required: true,
            },
            'template_field_settings': {
                type: Object,
                required: true
            },
            'template_field_types': {
                type: Object,
                required: true
            },
            'template_types': {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                auto_update_slug: false,
                form_data: {},
            }
        },
        created() {
            this.form_data = _.cloneDeep(this.template);
        },
        methods: {
            onNameInput() {
                if (!this.auto_update_slug) {
                    return;
                }

                this.form_data.slug = this.slugify(this.form_data.name);
            },
            onSlugBlur() {
                this.form_data.slug = this.slugify(this.form_data.slug)
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
                this.$inertia.put(
                    this.$route('admin.cms.templates.update', this.template.id),
                    this.form_data
                );
            }
        }
    }
</script>
