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
                Create Layout
            </h1>

            <inertia-link
                v-if="userCan('cms_advanced.view')"
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
                    :error-message="getPageErrorMessage('template_id')"
                    label-text="Template"
                    :input-any-option-enabled="true"
                    input-any-option-label="Please select a template"
                    :input-autofocus="true"
                    input-id="template_id"
                    input-name="template_id"
                    :input-options="isTemplates ? templates : {}"
                    input-option-label-key="name"
                    input-option-value-key="id"
                    :input-required="true"
                    @errorHidden="clearPageErrorMessage('template_id')"
                    v-model="formData.template_id"
                />

                <input-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('name')"
                    input-autocomplete="layout_name"
                    input-id="name"
                    input-name="name"
                    :input-required="true"
                    input-type="text"
                    label-text="Layout Name"
                    @errorHidden="clearPageErrorMessage('name')"
                    @input="onNameInput"
                    v-model="formData.name"
                />

                <input-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('slug')"
                    input-autocomplete="layout_slug"
                    input-id="slug"
                    input-name="slug"
                    :input-required="true"
                    input-type="text"
                    label-text="Layout Slug"
                    @blur="onSlugBlur"
                    @errorHidden="clearPageErrorMessage('slug')"
                    @input="onSlugInput"
                    v-model="formData.slug"
                />
            </div>
        </div>

        <div
            v-if="!this.isLoadingTemplate && selectedTemplateHasFields"
            class="bg-white mt-6 px-4 py-6 shadow-subtle rounded-lg"
        >
            <p class="text-lg">Fields</p>

            <content-editor
                class="mt-4"
                :template-fields="selectedTemplate.template_fields"
                v-model="formData.content"
            />
        </div>
    </form>
</template>

<script>
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
            templates: {
                type: Object | Array,
                required: true
            },
        },
        data() {
            return {
                autoUpdateSlug: true,
                formData: {
                    name: '',
                    slug: '',
                    template_id: '',
                },
                isLoadingTemplate: false,
                selectedTemplate: null,
            }
        },
        computed: {
            isTemplates() {
                try {
                    return Object.keys(this.templates).length;
                } catch (e) {
                    return false;
                }
            },
            selectedTemplateHasFields() {
                try {
                    if (!this.selectedTemplate) {
                        return false;
                    }

                    return this.selectedTemplate.template_fields.length;
                } catch (e) {
                    return false;
                }
            },
            selectedTemplateId() {
                return this.formData.template_id ?? '';
            },
        },
        methods: {
            cancelLoadTemplate() {
                if (this.isLoadingTemplate) {
                    templateCancelToken.cancel('Template load cancelled');
                    templateCancelToken = CancelToken.source();
                }
            },
            onNameInput() {
                if (!this.autoUpdateSlug) {
                    return;
                }

                this.formData.slug = this.slugify(this.formData.name);
            },
            onSelectedTemplateIdChange: _.debounce(function () {
                this.selectedTemplate = null;
                this.cancelLoadTemplate();

                if (!this.selectedTemplateId) {
                    return;
                }

                this.isLoadingTemplate = true;

                axios.get(
                    this.$route('admin.api.cms.templates.show', this.selectedTemplateId)
                ).then(response => {
                    this.selectedTemplate = _.cloneDeep(response.data.data);
                    this.setNewTemplateContent();
                }).catch(e => {
                    if (!axios.isCancel(e)) {
                        this.$errorToast('Failed to load selected template');
                        console.log(e); // TODO: This should go through to a log tracker once available
                    }
                }).finally(() => {
                    this.isLoadingTemplate = false;
                })
            }, 500),
            onSlugBlur() {
                this.formData.slug = this.slugify(this.formData.slug)
            },
            onSlugInput() {
                this.autoUpdateSlug = false;
            },
            setNewTemplateContent() {
                if (!this.selectedTemplateHasFields) {
                    this.formData.content = {};
                }

                // Get all fields from the template and set the default data
                let new_content = {};
                _.forEach(this.selectedTemplate.template_fields, (templateField) => {
                    new_content[templateField.id] = {
                        data: '',
                        template_field_id: templateField.id,
                    };
                });

                // Replace the existing content
                this.$set(this.formData, 'content', _.cloneDeep(new_content));
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
                    this.formData
                );
            }
        },
        watch: {
            selectedTemplateId: {
                handler: 'onSelectedTemplateIdChange'
            }
        }
    }
</script>
