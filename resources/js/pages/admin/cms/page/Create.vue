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
            <h1 class="font-medium mr-auto text-lg">
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
                    :error-message="getPageErrorMessage('layout_id')"
                    label-text="Layout"
                    :input-any-option-enabled="true"
                    input-any-option-label="Please select a Layout"
                    :input-autofocus="true"
                    input-id="layout_id"
                    input-name="layout_id"
                    :input-options="isLayouts ? layouts : {}"
                    input-option-label-key="name"
                    input-option-value-key="id"
                    :input-required="true"
                    @errorHidden="clearPageErrorMessage('layout_id')"
                    v-model="formData.layout_id"
                />

                <select-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('template_id')"
                    label-text="Template"
                    :input-any-option-enabled="true"
                    input-any-option-label="Please select a template"
                    input-id="template_id"
                    input-name="template_id"
                    :input-options="isTemplates ? templates : {}"
                    input-option-label-key="name"
                    input-option-value-key="id"
                    :input-required="true"
                    @errorHidden="clearPageErrorMessage('template_id')"
                    v-model="formData.template_id"
                />

                <select-group
                    v-if="parentPagesUrls"
                    class="mt-4"
                    :error-message="getPageErrorMessage('parent_id')"
                    label-text="Parent Page"
                    :input-any-option-enabled="true"
                    input-any-option-label="Please select a parent (optional)"
                    input-id="parent_id"
                    input-name="parent_id"
                    :input-options="parentPagesUrls"
                    input-option-label-key="label"
                    input-option-value-key="id"
                    @errorHidden="clearPageErrorMessage('parent_id')"
                    v-model="formData.parent_id"
                />

                <input-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('name')"
                    input-autocomplete="page_name"
                    input-id="name"
                    input-name="name"
                    :input-required="true"
                    input-type="text"
                    label-text="Page Name"
                    @errorHidden="clearPageErrorMessage('name')"
                    @input="onNameInput"
                    v-model="formData.name"
                />

                <input-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('slug')"
                    input-autocomplete="page_slug"
                    input-id="slug"
                    input-name="slug"
                    :input-required="true"
                    input-type="text"
                    label-text="Page Slug"
                    @blur="onSlugBlur"
                    @errorHidden="clearPageErrorMessage('slug')"
                    @input="onSlugInput"
                    v-model="formData.slug"
                />
            </div>
        </div>

        <div
            class="bg-white mt-6 overflow-x-hidden px-6 py-6 shadow-subtle rounded-lg"
        >
            <metadata-editor
                v-model="formData.metadata"
            />
        </div>

        <div
            class="bg-white mt-6 px-6 py-6 shadow-subtle rounded-lg"
        >
            <url-editor
                :computed-url="computedUrl"
                :parent-url="selectedParentPageUrl"
                @isAvailable="onUrlIsAvailableEvent"
                v-model="formData.url"
            />
        </div>

        <div
            v-if="!this.isLoadingTemplate && selectedTemplateHasFields"
            class="bg-white mt-6 px-6 py-6 shadow-subtle rounded-lg"
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
    import MetadataEditor from "../../../../components/admin/cms/metadata/MetadataEditor";
    import SelectGroup from "../../../../components/core/forms/SelectGroup";
    import UrlEditor from "../../../../components/admin/cms/urls/UrlEditor";

    let CancelToken = axios.CancelToken;
    let templateCancelToken = CancelToken.source();

    export default {
        name: "AdminCmsPageCreate",
        components: {
            InputGroup,
            MetadataEditor,
            SelectGroup,
            UrlEditor,
        },
        layout: 'admin-layout',
        props: {
            layouts: {
                required: true,
                type: Object | Array,
            },
            parentPages: {
                required: true,
                type: Object | Array | null,
            },
            templates: {
                required: true,
                type: Object | Array,
            },
        },
        data() {
            return {
                autoUpdateSlug: true,
                computedUrl: '',
                formData: {
                    layout_id: '',
                    metadata: {},
                    name: '',
                    parent_id: '',
                    slug: '',
                    template_id: '',
                    url: {},
                },
                isLoadingTemplate: false,
                isUrlAvailable: false,
                selectedTemplate: null,
            }
        },
        computed: {
            isLayouts() {
                try {
                    return Object.keys(this.layouts).length;
                } catch (e) {
                    return false;
                }
            },
            isTemplates() {
                try {
                    return Object.keys(this.templates).length;
                } catch (e) {
                    return false;
                }
            },
            parentPagesUrls() {
                try {
                    if (!Object.keys(this.parentPages).length) {
                        return null;
                    }

                    let pages = {};
                    _.forEach(this.parentPages, (page, key) => {
                        pages[key] = {
                            id: page.id,
                            label: page.name + ' => ' + page.url.url_full,
                            url_full: page.url.url_full,
                            url_main: page.url.url_main,
                        };
                    });

                    return pages;
                } catch (e) {
                    return null;
                }
            },
            parentPagesMap() {
                try {
                    if (!Object.keys(this.parentPages).length) {
                        return null;
                    }

                    let map = {};
                    _.forEach(this.parentPages, (page, key) => {
                        map[page.id] = key;
                    });

                    return map;
                } catch (e) {
                    return null;
                }
            },
            selectedParentPage() {
                try {
                    if (!this.formData.parent_id) {
                        return null;
                    }

                    return this.parentPages[
                        this.parentPagesMap[this.formData.parent_id]
                    ];
                } catch (e) {
                    return null;
                }
            },
            selectedParentPageUrl() {
                try {
                    return this.selectedParentPage.url.url_full;
                } catch (e) {
                    return null;
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
                this.computedUrl = this.formData.slug;
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
                this.computedUrl = this.formData.slug;
            },
            onUrlIsAvailableEvent(isAvailable) {
                this.isUrlAvailable = isAvailable;
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
                if (!this.isUrlAvailable) {
                    this.$errorToast('Unable to create page. URL is unavailable');
                    return;
                }

                this.$inertia.post(
                    this.$route('admin.cms.pages.store'),
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
