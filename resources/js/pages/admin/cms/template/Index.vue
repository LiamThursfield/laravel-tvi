<template>
    <section>
        <div
            class="flex flex-row items-center mb-6"
        >
            <h1 class="font-medium mr-auto text-lg">
                 Templates
            </h1>

            <inertia-link
                v-if="userCan('cms_advanced.create')"
                class="
                    button button-default-responsive button-primary
                    flex flex-row items-center
                "
                :href="$route('admin.cms.templates.create')"
            >
                <icon-plus class="w-5 md:mr-2"/>

                <span
                    class="hidden md:inline"
                >
                    Create Template
                </span>
            </inertia-link>
        </div>

        <div class="bg-white py-6 shadow-subtle rounded-lg">
            <h1 class="font-semibold px-6 text-gray-850">
                Search
                <button
                    class="
                        text-sm text-theme-base-subtle-contrast
                        focus:outline-none focus:text-theme-primary
                        hover:text-theme-primary
                    "
                    @click="setSearchOptions"
                >
                    (Clear)
                </button>
            </h1>

            <!--Search Panel -->
            <div
                class="
                    flex flex-col items-center mt-4 px-6 space-y-4
                    md:flex-row md:space-y-0 md:space-x-8
                "
            >
                <div class="w-full md:w-1/3">
                    <input-group
                        input-autocomplete="template_name_search"
                        input-class="form-control form-control-short"
                        input-id="template_name"
                        input-name="template_name"
                        input-placeholder="Template Name"
                        input-type="text"
                        :label-hidden="true"
                        label-text="Template Name"
                        v-model="editableSearchOptions.template_name"
                    />
                </div>

                <div class="w-full md:w-1/3">
                    <input-group
                        input-autocomplete="template_slug_search"
                        input-class="form-control form-control-short"
                        input-id="template_slug"
                        input-name="template_slug"
                        input-placeholder="Template Slug"
                        input-type="text"
                        :label-hidden="true"
                        label-text="Template Slug"
                        v-model="editableSearchOptions.template_slug"
                    />
                </div>

                <div class="w-full md:w-1/3">
                    <select-group
                        :label-hidden="true"
                        label-text="Template Type"
                        :input-any-option-enabled="true"
                        input-any-option-label="Template Type"
                        input-class="form-control form-control-short"
                        input-id="template_type"
                        input-name="template_type"
                        :input-options="templateTypes"
                        v-model="editableSearchOptions.template_type"
                    />
                </div>
            </div>

            <p
                v-if="!templatesData"
                class="bg-theme-base-subtle mt-8 mx-6 px-6 py-4 rounded text-center text-theme-base-subtle-contrast"
            >
                No templates
            </p>

            <template v-else>

                <!-- Search Results -->
                <div class="block mt-8 overflow-x-auto w-full">
                    <table class="table table-hover table-striped w-full">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Type</th>
                            <th v-if="showTemplateActions"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr
                            v-for="(template, index) in templatesData"
                            :key="`template-${template.id}`"
                        >
                            <td>
                                {{ template.name }}
                            </td>
                            <td>
                                {{ template.slug }}
                            </td>
                            <td>
                                {{ getTemplateTypeLabel(template.type) }}
                            </td>
                            <td v-if="showTemplateActions">
                                <div class="flex flex-row items-center justify-end -mx-1">
                                    <inertia-link
                                        v-if="userCan('cms_advanced.edit')"
                                        class="
                                            flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                                            focus:outline-none focus:ring
                                            hover:bg-theme-info hover:text-theme-info-contrast
                                        "
                                        :href="$route('admin.cms.templates.edit', template.id)"
                                        title="Edit Template"
                                    >
                                        <icon-edit
                                            class="w-4"
                                        />
                                    </inertia-link>

                                    <button
                                        v-if="userCan('cms_advanced.delete')"
                                        class="
                                            flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                                            focus:outline-none focus:ring
                                            hover:bg-theme-danger hover:text-theme-danger-contrast
                                        "
                                        title="Delete Template"
                                        @click="checkDelete(template)"
                                    >
                                        <icon-trash
                                            class="w-4"
                                        />
                                    </button>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div
                    v-if="showPagination"
                    class="flex flex-row justify-center mt-12 px-6"
                >
                    <pagination :pagination="templates.pagination" />
                </div>
            </template>

            <confirmation-modal
                confirm-text="Delete"
                confirm-type="danger"
                :show-modal="showDeleteModal"
                :message-text="deleteModalText"
                @cancelAction="cancelDelete"
                @closeModal="cancelDelete"
                @confirmAction="confirmDelete"
            />
        </div>
    </section>
</template>

<script>
    import _ from 'lodash';
    import { Inertia } from '@inertiajs/inertia'
    import ConfirmationModal from "../../../../components/core/modals/ConfirmationModal";
    import InputGroup from "../../../../components/core/forms/InputGroup";
    import SelectGroup from "../../../../components/core/forms/SelectGroup";

    export default {
        name: "AdminCmsTemplateIndex",
        components: {
            ConfirmationModal,
            InputGroup,
            SelectGroup
        },
        layout: 'admin-layout',
        props: {
            searchOptions: {
                required: true,
                type: Object|Array,
            },
            templates: {
                required: true,
                type: Object,
            },
            templateTypes: {
                required: true,
                type: Object,
            }
        },
        data() {
            return {
                editableSearchOptions: {
                    per_page        : 15,
                    template_name   : '',
                    template_slug   : '',
                    template_type   : '',
                },
                isInitialised: false,
                isLoadingDelete: false,
                showDeleteModal: false,
                templateToDelete: null,
            }
        },
        computed: {
            deleteModalText() {
                try {
                    return 'Do you really want to delete \'' + this.templateToDelete.name + '\'?';
                } catch (e) {
                    return 'Do you really want to delete this template?'
                }
            },
            showPagination() {
                try {
                    return this.templates.pagination.last_page > 1;
                } catch (e) {
                    return false;
                }
            },
            showTemplateActions() {
                return this.userCan('cms_advanced.edit') || this.userCan('cms_advanced.delete');
            },
            templatesData() {
                if (!this.templates || !this.templates.data || this.templates.data.length < 1) {
                    return false;
                }

                return this.templates.data;
            }
        },
        mounted() {
            this.setSearchOptions(this.searchOptions);
        },
        methods: {
            cancelDelete() {
                if (!this.isLoadingDelete) {
                    this.showDeleteModal = false;
                    this.templateToDelete = null;
                }
            },
            checkDelete(template) {
                this.showDeleteModal = true;
                this.templateToDelete = template;
            },
            confirmDelete() {
                if (this.isLoadingDelete) {
                    return this.$errorToast('It\'s only possible to delete one template at a time.');
                }
                this.$inertia.delete(
                    this.$route('admin.cms.templates.destroy', this.templateToDelete.id),
                    {
                        only: [
                            'flash',
                            'templates'
                        ]
                    }
                );
                this.templateToDelete = null;
                this.showDeleteModal = false;
            },
            getTemplateTypeLabel(type_slug) {
                try {
                     return this.templateTypes.hasOwnProperty(type_slug) ? this.templateTypes[type_slug] : type_slug;
                } catch (e) {
                    return type_slug;
                }
            },
            onSearchOptionsUpdate: _.debounce(function () {
                if (!this.isInitialised) {
                    this.isInitialised = true;

                    // If there are already search results, don't attempt search
                    if (this.templatesData) {
                        return;
                    }
                }

                Inertia.get(
                    this.$route('admin.cms.templates.index'),
                    this.editableSearchOptions,
                    {
                        only: ['templates'],
                        preserveState: true,
                    }
                );
            }, 500),
            setSearchOptions(new_options = {}) {
                let options = {
                    per_page        : 15,
                    template_name   : '',
                    template_slug   : '',
                    template_type   : '',
                }

                try {
                    // Overwrite the defaults with any new options
                    _.forEach(new_options, (option, key) => {
                        options[key] = option;
                    })
                } catch (e) {
                    console.log(e);
                }

                this.editableSearchOptions = _.cloneDeep(options);
            }
        },
        watch: {
            editableSearchOptions: {
                deep: true,
                handler: 'onSearchOptionsUpdate'
            }
        }
    }
</script>
