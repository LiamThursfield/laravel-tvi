<template>
    <section>
        <div
            class="flex flex-row items-center mb-6"
        >
            <h1 class="font-medium mr-auto text-lg">
                 Page
            </h1>

            <inertia-link
                v-if="userCan('cms.create')"
                class="
                    button button-default-responsive button-primary
                    flex flex-row items-center
                "
                :href="$route('admin.cms.pages.create')"
            >
                <icon-plus class="w-5 md:mr-2"/>

                <span
                    class="hidden md:inline"
                >
                    Create Page
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
                    flex flex-row flex-wrap items-center -mx-4 -my-2 pt-4 px-6
                "
            >
                <div
                    class="
                        my-2 w-full
                        sm:w-1/2
                        lg:w-1/4
                    "
                >
                    <input-group
                        class="mx-4"
                        input-autocomplete="page_name_search"
                        input-class="form-control form-control-short"
                        input-id="page_name"
                        input-name="page_name"
                        input-placeholder="Page Name"
                        input-type="text"
                        :label-hidden="true"
                        label-text="Page Name"
                        v-model="editableSearchOptions.page_name"
                    />
                </div>

                <div
                    class="
                        my-2 w-full
                        sm:w-1/2
                        lg:w-1/4
                    "
                >
                    <input-group
                        class="mx-4"
                        input-autocomplete="page_slug_search"
                        input-class="form-control form-control-short"
                        input-id="page_slug"
                        input-name="page_slug"
                        input-placeholder="Page Slug"
                        input-type="text"
                        :label-hidden="true"
                        label-text="Page Slug"
                        v-model="editableSearchOptions.page_slug"
                    />
                </div>

                <div
                    v-if="isLayouts"
                    class="
                        my-2 w-full
                        sm:w-1/2
                        lg:w-1/4
                    "
                >
                    <select-group
                        class="mx-4"
                        :label-hidden="true"
                        label-text="Layout"
                        :input-any-option-enabled="true"
                        input-any-option-label="Layout"
                        input-class="form-control form-control-short"
                        input-id="template_id"
                        input-name="template_id"
                        input-option-label-key="name"
                        input-option-value-key="id"
                        :input-options="layouts"
                        v-model="editableSearchOptions.layout_id"
                    />
                </div>

                <div
                    v-if="isTemplates"
                    class="
                        my-2 w-full
                        sm:w-1/2
                        lg:w-1/4
                    "
                >
                    <select-group
                        class="mx-4"
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
                v-if="!pagesData"
                class="bg-theme-base-subtle mt-8 mx-6 px-6 py-4 rounded text-center text-theme-base-subtle-contrast"
            >
                No pages
            </p>

            <template v-else>

                <!-- Search Results -->
                <div class="block mt-8 overflow-x-auto w-full">
                    <table class="table table-hover table-striped w-full">
                        <thead>
                        <tr>
                            <th class="indicator-column"></th>
                            <th>Name</th>
                            <th>URL</th>
                            <th class="text-center">Enabled</th>
                            <th class="text-center">Publish / Expiry Date</th>
                            <th>Layout / Template</th>
                            <th v-if="showPageActions"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr
                            v-for="(page, index) in pagesData"
                            :key="`page-${page.id}`"
                        >
                            <td class="indicator-column">
                                <div
                                    class="h-3 rounded-full w-3"
                                    :class="{
                                        'bg-theme-success-contrast': page.url.is_live,
                                        'bg-theme-danger-contrast': !page.url.is_live,
                                    }"
                                />
                            </td>
                            <td>
                                {{ page.name }}
                                <br>
                                <span class="text-sm text-theme-base-subtle-contrast">
                                    {{ page.slug }}
                                </span>
                            </td>
                            <td class="text-sm">
                                {{ page.url.url_full }}
                            </td>
                            <td>
                                <div class="flex flex-row justify-center">
                                    <icon-check
                                        v-if="page.url.is_enabled"
                                        class="h-4 w-4"
                                    />
                                    <icon-x
                                        v-else
                                        class="h-4 w-4"
                                    />
                                </div>
                            </td>
                            <td class="text-sm">
                                <div class="flex flex-col opacity-75 space-y-1">
                                    <span
                                        class="text-center"
                                    >
                                        <template v-if="page.url.published_at">
                                            {{ page.url.published_at | humanFriendlyDateTime }}
                                        </template>
                                        <template v-else>
                                            -
                                        </template>
                                    </span>

                                    <span
                                        class="text-center"
                                    >
                                        <template v-if="page.url.expired_at">
                                            {{ page.url.expired_at | humanFriendlyDateTime }}
                                        </template>
                                        <template v-else>
                                            -
                                        </template>
                                    </span>
                                </div>
                            </td>
                            <td class="text-sm text-theme-base-subtle-contrast">
                                {{  page.layout.name }}
                                <br>
                                {{  page.template.name }}
                            </td>
                            <td v-if="showPageActions">
                                <div class="flex flex-row items-center justify-end -mx-1">
                                    <inertia-link
                                        v-if="userCan('cms.edit')"
                                        class="
                                            flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                                            focus:outline-none focus:ring
                                            hover:bg-theme-info hover:text-theme-info-contrast
                                        "
                                        :href="$route('admin.cms.pages.edit', page.id)"
                                        title="Edit Page"
                                    >
                                        <icon-edit
                                            class="w-4"
                                        />
                                    </inertia-link>

                                    <button
                                        v-if="userCan('cms.delete')"
                                        class="
                                            flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                                            focus:outline-none focus:ring
                                            hover:bg-theme-danger hover:text-theme-danger-contrast
                                        "
                                        title="Delete Page"
                                        @click="checkDelete(page)"
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
                    <pagination :pagination="pages.pagination" />
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
        name: "AdminCmsPageIndex",
        components: {
            ConfirmationModal,
            InputGroup,
            SelectGroup
        },
        layout: 'admin-layout',
        props: {
            layouts: {
                required: true,
                type: Object | Array,
            },
            pages: {
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
            },
        },
        data() {
            return {
                editableSearchOptions: {
                    layout_id   : '',
                    per_page    : 15,
                    page_name   : '',
                    page_slug   : '',
                    template_id : '',
                },
                isInitialised: false,
                isLoadingDelete: false,
                showDeleteModal: false,
                pageToDelete: null,
            }
        },
        mounted() {
            this.setSearchOptions(this.searchOptions);
        },
        computed: {
            deleteModalText() {
                try {
                    return 'Do you really want to delete \'' + this.pageToDelete.name + '\'?';
                } catch (e) {
                    return 'Do you really want to delete this page?'
                }
            },
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
            showPagination() {
                try {
                    return this.pages.pagination.last_page > 1;
                } catch (e) {
                    return false;
                }
            },
            showPageActions() {
                return this.userCan('cms.edit') || this.userCan('cms.delete');
            },
            pagesData() {
                if (!this.pages || !this.pages.data || this.pages.data.length < 1) {
                    return false;
                }

                return this.pages.data;
            }
        },
        methods: {
            cancelDelete() {
                if (!this.isLoadingDelete) {
                    this.showDeleteModal = false;
                    this.pageToDelete = null;
                }
            },
            checkDelete(page) {
                this.showDeleteModal = true;
                this.pageToDelete = page;
            },
            confirmDelete() {
                if (this.isLoadingDelete) {
                    return this.$errorToast('It\'s only possible to delete one page at a time.');
                }
                this.$inertia.delete(
                    this.$route('admin.cms.pages.destroy', this.pageToDelete.id),
                    {
                        only: [
                            'flash',
                            'pages'
                        ]
                    }
                );
                this.pageToDelete = null;
                this.showDeleteModal = false;
            },
            onSearchOptionsUpdate: _.debounce(function () {
                if (!this.isInitialised) {
                    this.isInitialised = true;

                    // If there are already search results, don't attempt search
                    if (this.pagesData) {
                        return;
                    }
                }

                Inertia.get(
                    this.$route('admin.cms.pages.index'),
                    this.editableSearchOptions,
                    {
                        only: ['pages'],
                        preserveState: true,
                    }
                );
            }, 500),
            setSearchOptions(new_options = {}) {
                let options = {
                    layout_id       : '',
                    per_page        : 15,
                    page_name       : '',
                    page_slug       : '',
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
