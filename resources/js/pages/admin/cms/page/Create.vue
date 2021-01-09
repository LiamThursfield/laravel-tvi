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
                    :errorMessage="getPageErrorMessage('layout_id')"
                    labelText="Layout"
                    :selectAnyEnabled="true"
                    selectAnyLabel="Please select a Layout"
                    :selectAutoFocus="true"
                    selectId="layout_id"
                    selectName="layout_id"
                    :selectOptions="layouts"
                    selectOptionLabelKey="name"
                    selectOptionValueKey="id"
                    :selectRequired="true"
                    v-model="formData.layout_id"
                />

                <select-group
                    class="mt-4"
                    :errorMessage="getPageErrorMessage('template_id')"
                    labelText="Template"
                    :selectAnyEnabled="true"
                    selectAnyLabel="Please select a template"
                    selectId="template_id"
                    selectName="template_id"
                    :selectOptions="templates"
                    selectOptionLabelKey="name"
                    selectOptionValueKey="id"
                    :selectRequired="true"
                    v-model="formData.template_id"
                />

                <select-group
                    v-if="parentPagesUrls"
                    class="mt-4"
                    :errorMessage="getPageErrorMessage('parent_id')"
                    labelText="Parent Page"
                    :selectAnyEnabled="true"
                    selectAnyLabel="Please select a parent (optional)"
                    selectId="parent_id"
                    selectName="parent_id"
                    :selectOptions="parentPagesUrls"
                    selectOptionLabelKey="label"
                    selectOptionValueKey="id"
                    v-model="formData.parent_id"
                />

                <input-group
                    class="mt-4"
                    :errorMessage="getPageErrorMessage('name')"
                    inputAutocomplete="page_name"
                    inputId="name"
                    inputName="name"
                    :inputRequired="true"
                    inputType="text"
                    labelText="Page Name"
                    @input="onNameInput"
                    v-model="formData.name"
                />

                <input-group
                    class="mt-4"
                    :errorMessage="getPageErrorMessage('slug')"
                    inputAutocomplete="page_slug"
                    inputId="slug"
                    inputName="slug"
                    :inputRequired="true"
                    inputType="text"
                    labelText="Page Slug"
                    @blur="onSlugBlur"
                    @input="onSlugInput"
                    v-model="formData.slug"
                />
            </div>
        </div>

        <div
            class="bg-white mt-6 px-6 py-6 shadow-subtle rounded-lg"
        >
            <url-editor
                :parent-url="selectedParentPageUrl"
                v-model="formData.url"
            />
        </div>

        <div
            v-if="!this.isLoadingTemplate && selectedTemplateHasFields"
            class="bg-white mt-6 px-6 py-6 shadow-subtle rounded-lg"
        >
            <p class="text-lg">Fields</p>

            <content-editor
                :templateFields="this.selectedTemplate.template_fields"
                v-model="formData.content"
            />
        </div>
    </form>
</template>

<script>
    import slugify from "slugify";
    import ContentEditor from "../../../../components/admin/cms/content/ContentEditor";
    import InputGroup from "../../../../components/core/forms/InputGroup";
    import SelectGroup from "../../../../components/core/forms/SelectGroup";
    import UrlEditor from "../../../../components/admin/cms/urls/UrlEditor";

    let CancelToken = axios.CancelToken;
    let templateCancelToken = CancelToken.source();

    export default {
        name: "AdminCmsPageCreate",
        components: {
            ContentEditor,
            InputGroup,
            SelectGroup,
            UrlEditor,
        },
        layout: 'admin-layout',
        props: {
            'layouts': {
                type: Object,
                required: true
            },
            'parentPages': {
                type: Object | Array | null,
                required: true
            },
            'templates': {
                type: Object,
                required: true
            },
        },
        data() {
            return {
                autoUpdateSlug: true,
                formData: {
                    layout_id: '',
                    name: '',
                    parent_id: '',
                    slug: '',
                    template_id: '',
                    url: {},
                },
                isLoadingTemplate: false,
                selectedTemplate: null,
            }
        },
        computed: {
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
            },
            onSelectedTemplateIdChange: _.debounce(function () {
                this.selectedTemplate = null;
                this.cancelLoadTemplate();

                if (!this.selectedTemplateId) {
                    return;
                }

                this.isLoadingTemplate = true;

                axios.get(
                    this.$route('admin.api.cms.templates.index', this.selectedTemplateId)
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
