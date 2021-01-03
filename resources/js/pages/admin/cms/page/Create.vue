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
                Create Page
            </h1>

            <inertia-link
                v-if="userCan('cms.view')"
                class="
                    button button-default-responsive button-primary-subtle
                    flex flex-row items-center mr-2
                "
                :href="$route('admin.cms.pages.index')"
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
                    Create Page
                </span>
            </button>
        </div>


        <div class="bg-white py-6 shadow-subtle rounded-lg">
            <div class="block px-6 w-full">
                <select-group
                    :error_message="getPageErrorMessage('layout_id')"
                    label_text="Layout"
                    :select_any_enabled="true"
                    select_any_label="Please select a Layout"
                    :select_autofocus="true"
                    select_id="template_id"
                    select_name="template_id"
                    :select_options="layouts"
                    select_option_label_key="name"
                    select_option_value_key="id"
                    :select_required="true"
                    select_type="text"
                    v-model="form_data.layout_id"
                />

                <select-group
                    class="mt-4"
                    :error_message="getPageErrorMessage('template_id')"
                    label_text="Template"
                    :select_any_enabled="true"
                    select_any_label="Please select a template"
                    select_id="template_id"
                    select_name="template_id"
                    :select_options="templates"
                    select_option_label_key="name"
                    select_option_value_key="id"
                    :select_required="true"
                    select_type="text"
                    v-model="form_data.template_id"
                />


                <input-group
                    class="mt-4"
                    :error_message="getPageErrorMessage('name')"
                    input_autocomplete="page_name"
                    input_id="name"
                    input_name="name"
                    :input_required="true"
                    input_type="text"
                    label_text="Page Name"
                    @input="onNameInput"
                    v-model="form_data.name"
                />

                <input-group
                    class="mt-4"
                    :error_message="getPageErrorMessage('slug')"
                    input_autocomplete="page_slug"
                    input_id="slug"
                    input_name="slug"
                    :input_required="true"
                    input_type="text"
                    label_text="Page Slug"
                    @blur="onSlugBlur"
                    @input="onSlugInput"
                    v-model="form_data.slug"
                />
            </div>
        </div>

        <div
            v-if="!this.is_loading_template && selected_template_has_fields"
            class="bg-white mt-6 px-4 py-6 shadow-subtle rounded-lg"
        >
            <p class="text-lg">Fields</p>

            <content-editor
                :template_fields="this.selected_template.template_fields"
                v-model="form_data.content"
            />
        </div>
    </form>
</template>

<script>
    import slugify from "slugify";
    import ContentEditor from "../../../../components/admin/cms/content/ContentEditor";
    import InputGroup from "../../../../components/core/forms/InputGroup";
    import SelectGroup from "../../../../components/core/forms/SelectGroup";

    let CancelToken = axios.CancelToken;
    let templateCancelToken = CancelToken.source();

    export default {
        name: "AdminCmsPageCreate",
        components: {
            ContentEditor,
            InputGroup,
            SelectGroup,
        },
        layout: 'admin-layout',
        props: {
            'layouts': {
                type: Object,
                required: true
            },
            'templates': {
                type: Object,
                required: true
            },
        },
        data() {
            return {
                auto_update_slug: true,
                form_data: {
                    layout_id: '',
                    name: '',
                    slug: '',
                    template_id: '',
                },
                is_loading_template: false,
                selected_template: null,
            }
        },
        computed: {
            selected_template_has_fields() {
                try {
                    if (!this.selected_template) {
                        return false;
                    }

                    return this.selected_template.template_fields.length;
                } catch (e) {
                    return false;
                }
            },
            selected_template_id() {
                return this.form_data.template_id ?? '';
            },
        },
        methods: {
            cancelLoadTemplate() {
                if (this.is_loading_template) {
                    templateCancelToken.cancel('Template load cancelled');
                    templateCancelToken = CancelToken.source();
                }
            },
            onNameInput() {
                if (!this.auto_update_slug) {
                    return;
                }

                this.form_data.slug = this.slugify(this.form_data.name);
            },
            onSelectedTemplateIdChange: _.debounce(function () {
                this.selected_template = null;
                this.cancelLoadTemplate();

                if (!this.selected_template_id) {
                    return;
                }

                this.is_loading_template = true;

                axios.get(
                    this.$route('admin.api.cms.templates.index', this.selected_template_id)
                ).then(response => {
                    this.selected_template = _.cloneDeep(response.data.data);
                    this.setNewTemplateContent();
                }).catch(e => {
                    if (!axios.isCancel(e)) {
                        this.$errorToast('Failed to load selected template');
                        console.log(e); // TODO: This should go through to a log tracker once available
                    }
                }).finally(() => {
                    this.is_loading_template = false;
                })
            }, 500),
            onSlugBlur() {
                this.form_data.slug = this.slugify(this.form_data.slug)
            },
            onSlugInput() {
                this.auto_update_slug = false;
            },
            setNewTemplateContent() {
                if (!this.selected_template_has_fields) {
                    this.form_data.content = {};
                }

                // Get all fields from the template and set the default data
                let new_content = {};
                _.forEach(this.selected_template.template_fields, (template_field) => {
                    new_content[template_field.id] = {
                        data: '',
                        template_field_id: template_field.id,
                    };
                });

                // Replace the existing content
                this.$set(this.form_data, 'content', _.cloneDeep(new_content));
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
                    this.$route('admin.cms.pages.store'),
                    this.form_data
                );
            }
        },
        watch: {
            selected_template_id: {
                handler: 'onSelectedTemplateIdChange'
            }
        }
    }
</script>
