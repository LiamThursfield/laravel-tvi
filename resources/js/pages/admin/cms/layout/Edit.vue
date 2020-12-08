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
                Edit Layout
            </h1>

            <inertia-link
                v-if="userCan('cms.view')"
                class="
                    button button-default-responsive button-primary-subtle
                    flex flex-row items-center mr-2
                "
                :href="$route('admin.cms.layouts.index')"
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
                    Create Layout
                </span>
            </button>
        </div>


        <div class="bg-white py-6 shadow-subtle rounded-lg">
            <div class="block px-6 w-full">

                <select-group
                    :error_message="getPageErrorMessage('template_id')"
                    label_text="Template"
                    :select_any_enabled="true"
                    select_any_label="Please select a template"
                    :select_autofocus="true"
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
                    input_autocomplete="layout_name"
                    input_id="name"
                    input_name="name"
                    :input_required="true"
                    input_type="text"
                    label_text="Layout Name"
                    @input="onNameInput"
                    v-model="form_data.name"
                />

                <input-group
                    class="mt-4"
                    :error_message="getPageErrorMessage('slug')"
                    input_autocomplete="layout_slug"
                    input_id="slug"
                    input_name="slug"
                    :input_required="true"
                    input_type="text"
                    label_text="Layout Slug"
                    @blur="onSlugBlur"
                    @input="onSlugInput"
                    v-model="form_data.slug"
                />
            </div>
        </div>
    </form>
</template>

<script>
    import _ from 'lodash';
    import slugify from "slugify";
    import InputGroup from "../../../../components/core/forms/InputGroup";
    import SelectGroup from "../../../../components/core/forms/SelectGroup";

    let CancelToken = axios.CancelToken;
    let templateCancelToken = CancelToken.source();

    export default {
        name: "AdminCmsLayoutCreate",
        components: {
            InputGroup,
            SelectGroup,
        },
        layout: 'admin-layout',
        props: {
            'layout': {
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
                auto_update_slug: false,
                form_data: {},
                is_initialised_template: false,
                is_loading_template: false,
                selected_template: null,
            }
        },
        computed: {
            selected_template_id() {
                return this.form_data.template_id ?? '';
            },
        },
        created() {
            this.form_data = {
                id:             this.layout.id,
                name:           this.layout.name,
                slug:           this.layout.slug,
                template_id:    this.layout.template_id,
            };

            this.selected_template = _.cloneDeep(this.layout.template);
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
                // The template id is set by default, so no need to re-load initially
                if (!this.is_initialised_template) {
                    this.is_initialised_template = true;
                    return;
                }

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
                    this.$route('admin.cms.layouts.store'),
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
