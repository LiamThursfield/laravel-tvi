<template>
    <section>
        <div
            class="flex flex-row items-center mb-6"
        >
            <h1 class="mr-auto text-lg">
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
                        input_autocomplete="page_name_search"
                        input_class="form-control form-control-short"
                        input_id="page_name"
                        input_name="page_name"
                        input_placeholder="Page Name"
                        input_type="text"
                        :label_hidden="true"
                        label_text="Page Name"
                        v-model="editable_search_options.page_name"
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
                        input_autocomplete="page_slug_search"
                        input_class="form-control form-control-short"
                        input_id="page_slug"
                        input_name="page_slug"
                        input_placeholder="Page Slug"
                        input_type="text"
                        :label_hidden="true"
                        label_text="Page Slug"
                        v-model="editable_search_options.page_slug"
                    />
                </div>

                <div
                    class="
                        my-2 w-full
                        sm:w-1/2
                        lg:w-1/4
                    "
                >
                    <select-group
                        class="mx-4"
                        :label_hidden="true"
                        label_text="Layout"
                        :select_any_enabled="true"
                        select_any_label="Layout"
                        select_class="form-control form-control-short"
                        select_id="template_id"
                        select_name="layout_id"
                        select_option_label_key="name"
                        select_option_value_key="id"
                        :select_options="layouts"
                        v-model="editable_search_options.layout_id"
                    />
                </div>

                <div
                    class="
                        my-2 w-full
                        sm:w-1/2
                        lg:w-1/4
                    "
                >
                    <select-group
                        class="mx-4"
                        :label_hidden="true"
                        label_text="Template"
                        :select_any_enabled="true"
                        select_any_label="Template"
                        select_class="form-control form-control-short"
                        select_id="template_id"
                        select_name="template_id"
                        select_option_label_key="name"
                        select_option_value_key="id"
                        :select_options="templates"
                        v-model="editable_search_options.template_id"
                    />
                </div>

            </div>

            <p
                v-if="!pages_data"
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
                            <th v-if="show_page_actions"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr
                            v-for="(page, index) in pages_data"
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
                                        class="px-2 py-0 rounded text-center"
                                        :class="{
                                            'bg-theme-success text-theme-success-contrast': page.url.is_published,
                                            'bg-theme-danger text-theme-danger-contrast': !page.url.is_published,
                                        }"
                                    >
                                        <template v-if="page.url.published_at">
                                            {{ page.url.published_at | humanFriendlyDateTime }}
                                        </template>
                                        <template v-else>
                                            -
                                        </template>
                                    </span>

                                    <span
                                        class="px-2 py-0 rounded text-center"
                                        :class="{
                                            'bg-theme-success text-theme-success-contrast': !page.url.is_expired,
                                            'bg-theme-danger text-theme-danger-contrast': page.url.is_expired,
                                        }"
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
                            <td v-if="show_page_actions">
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
                    v-if="show_pagination"
                    class="flex flex-row justify-center mt-12 px-6"
                >
                    <pagination :pagination="pages.pagination" />
                </div>
            </template>

            <confirmation-modal
                confirmText="Delete"
                confirmType="danger"
                :showModal="show_delete_modal"
                :messageText="delete_modal_text"
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
    import IconCheck from "../../../../components/core/icons/IconCheck";

    export default {
        name: "AdminCmsPageIndex",
        components: {
            IconCheck,
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
            pages: {
                required: true,
                type: Object,
            },
            search_options: {
                required: true,
                type: Object | Array,
            },
            templates: {
                required: true,
                type: Object,
            },
        },
        data() {
            return {
                editable_search_options: {
                    layout_id   : '',
                    per_page    : 15,
                    page_name   : '',
                    page_slug   : '',
                    template_id : '',
                },
                is_initialised: false,
                is_loading_delete: false,
                show_delete_modal: false,
                page_to_delete: null,
            }
        },
        mounted() {
            this.setSearchOptions(this.search_options);
        },
        computed: {
            delete_modal_text() {
                try {
                    return 'Do you really want to delete \'' + this.page_to_delete.name + '\'?';
                } catch (e) {
                    return 'Do you really want to delete this page?'
                }
            },
            show_pagination() {
                try {
                    return this.pages.pagination.last_page > 1;
                } catch (e) {
                    return false;
                }
            },
            show_page_actions() {
                return this.userCan('cms.edit') || this.userCan('cms.delete');
            },
            pages_data() {
                if (!this.pages || !this.pages.data || this.pages.data.length < 1) {
                    return false;
                }

                return this.pages.data;
            }
        },
        methods: {
            cancelDelete() {
                if (!this.is_loading_delete) {
                    this.show_delete_modal = false;
                    this.page_to_delete = null;
                }
            },
            checkDelete(page) {
                this.show_delete_modal = true;
                this.page_to_delete = page;
            },
            confirmDelete() {
                if (this.is_loading_delete) {
                    return this.$errorToast('It\'s only possible to delete one page at a time.');
                }
                this.$inertia.delete(
                    this.$route('admin.cms.pages.destroy', this.page_to_delete.id),
                    {
                        only: [
                            'flash',
                            'pages'
                        ]
                    }
                );
                this.page_to_delete = null;
                this.show_delete_modal = false;
            },
            onSearchOptionsUpdate: _.debounce(function () {
                if (!this.is_initialised) {
                    this.is_initialised = true;

                    // If there are already search results, don't attempt search
                    if (this.pages_data) {
                        return;
                    }
                }

                Inertia.get(
                    this.$route('admin.cms.pages.index'),
                    this.editable_search_options,
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

                this.editable_search_options = _.cloneDeep(options);
            }
        },
        watch: {
            editable_search_options: {
                deep: true,
                handler: 'onSearchOptionsUpdate'
            }
        }
    }
</script>
