<template>
    <section>
        <div
            class="flex flex-row items-center mb-6"
        >
            <h1 class="font-medium mr-auto text-lg">
                 Layout
            </h1>

            <inertia-link
                v-if="userCan('cms_advanced.create')"
                class="
                    button button-default-responsive button-primary
                    flex flex-row items-center
                "
                :href="$route('admin.cms.layouts.create')"
            >
                <icon-plus class="w-5 md:mr-2"/>

                <span
                    class="hidden md:inline"
                >
                    Create Layout
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
                        input-autocomplete="layout_name_search"
                        input-class="form-control form-control-short"
                        input-id="layout_name"
                        input-name="layout_name"
                        input-placeholder="Layout Name"
                        input-type="text"
                        :label-hidden="true"
                        label-text="Layout Name"
                        v-model="editableSearchOptions.layout_name"
                    />
                </div>

                <div class="w-full md:w-1/3">
                    <input-group
                        input-autocomplete="layout_slug_search"
                        input-class="form-control form-control-short"
                        input-id="layout_slug"
                        input-name="layout_slug"
                        input-placeholder="Layout Slug"
                        input-type="text"
                        :label-hidden="true"
                        label-text="Layout Slug"
                        v-model="editableSearchOptions.layout_slug"
                    />
                </div>

                <div
                    v-if="isTemplates"
                    class="w-full md:w-1/3"
                >
                    <select-group
                        :label-hidden="true"
                        label-text="Template"
                        :input-any-option-enabled="true"
                        input-any-option-label="Template"
                        input-class="form-control form-control-short"
                        input-id="template_id"
                        input-name="template_id"
                        input-option-label-key="name"
                        input-option-value-key="id"
                        :input-options="templates"
                        v-model="editableSearchOptions.template_id"
                    />
                </div>
            </div>

            <p
                v-if="!layoutsData"
                class="bg-theme-base-subtle mt-8 mx-6 px-6 py-4 rounded text-center text-theme-base-subtle-contrast"
            >
                No layouts
            </p>

            <template v-else>

                <!-- Search Results -->
                <div class="block mt-8 overflow-x-auto w-full">
                    <table class="table table-hover table-striped w-full">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Template</th>
                            <th v-if="showLayoutActions"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr
                            v-for="(layout, index) in layoutsData"
                            :key="`layout-${layout.id}`"
                        >
                            <td>
                                {{ layout.name }}
                            </td>
                            <td>
                                {{ layout.slug }}
                            </td>
                            <td>
                                {{  layout.template.name }}
                            </td>
                            <td v-if="showLayoutActions">
                                <div class="flex flex-row items-center justify-end -mx-1">
                                    <inertia-link
                                        v-if="userCan('cms_advanced.edit')"
                                        class="
                                            flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                                            focus:outline-none focus:ring
                                            hover:bg-theme-info hover:text-theme-info-contrast
                                        "
                                        :href="$route('admin.cms.layouts.edit', layout.id)"
                                        title="Edit Layout"
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
                                        title="Delete Layout"
                                        @click="checkDelete(layout)"
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
                    <pagination :pagination="layouts.pagination" />
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
        name: "AdminCmsLayoutIndex",
        components: {
            ConfirmationModal,
            InputGroup,
            SelectGroup
        },
        layout: 'admin-layout',
        props: {
            layouts: {
                required: true,
                type: Object,
            },
            searchOptions: {
                required: true,
                type: Object | Array,
            },
            templates: {
                required: true,
                type: Object | Array,
            }
        },
        data() {
            return {
                editableSearchOptions: {
                    per_page        : 15,
                    layout_name   : '',
                    layout_slug   : '',
                    template_id   : '',
                },
                isInitialised: false,
                isLoadingDelete: false,
                showDeleteModal: false,
                layoutToDelete: null,
            }
        },
        mounted() {
            this.setSearchOptions(this.searchOptions);
        },
        computed: {
            deleteModalText() {
                try {
                    return 'Do you really want to delete \'' + this.layoutToDelete.name + '\'?';
                } catch (e) {
                    return 'Do you really want to delete this layout?'
                }
            },
            isTemplates() {
                try {
                    return Object.keys(this.templates).length;
                } catch (e) {
                    return false;
                }
            },
            showPagination() {
                try {
                    return this.layouts.pagination.last_page > 1;
                } catch (e) {
                    return false;
                }
            },
            showLayoutActions() {
                return this.userCan('cms_advanced.edit') || this.userCan('cms_advanced.delete');
            },
            layoutsData() {
                if (!this.layouts || !this.layouts.data || this.layouts.data.length < 1) {
                    return false;
                }

                return this.layouts.data;
            }
        },
        methods: {
            cancelDelete() {
                if (!this.isLoadingDelete) {
                    this.showDeleteModal = false;
                    this.layoutToDelete = null;
                }
            },
            checkDelete(layout) {
                this.showDeleteModal = true;
                this.layoutToDelete = layout;
            },
            confirmDelete() {
                if (this.isLoadingDelete) {
                    return this.$errorToast('It\'s only possible to delete one layouts at a time.');
                }
                this.$inertia.delete(
                    this.$route('admin.cms.layouts.destroy', this.layoutToDelete.id),
                    {
                        only: [
                            'flash',
                            'layouts'
                        ]
                    }
                );
                this.layoutToDelete = null;
                this.showDeleteModal = false;
            },
            onSearchOptionsUpdate: _.debounce(function () {
                if (!this.isInitialised) {
                    this.isInitialised = true;

                    // If there are already search results, don't attempt search
                    if (this.layoutsData) {
                        return;
                    }
                }

                Inertia.get(
                    this.$route('admin.cms.layouts.index'),
                    this.editableSearchOptions,
                    {
                        only: ['layouts'],
                        preserveState: true,
                    }
                );
            }, 500),
            setSearchOptions(new_options = {}) {
                let options = {
                    per_page      : 15,
                    layout_name   : '',
                    layout_slug   : '',
                    template_type : '',
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
