<template>
    <section>
        <div
            class="flex flex-row items-center mb-6"
        >
            <h1 class="font-medium mr-auto text-lg">
                Menu
            </h1>

            <inertia-link
                v-if="userCan('cms.create')"
                class="
                    button button-default-responsive button-primary
                    flex flex-row items-center
                "
                :href="$route('admin.cms.menus.create')"
            >
                <icon-plus class="w-5 md:mr-2"/>

                <span
                    class="hidden md:inline"
                >
                    Create Menu
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
                        input-autocomplete="menu_name_search"
                        input-class="form-control form-control-short"
                        input-id="menu_name"
                        input-name="menu_name"
                        input-placeholder="Menu Name"
                        input-type="text"
                        :label-hidden="true"
                        label-text="Menu Name"
                        v-model="editableSearchOptions.menu_name"
                    />
                </div>

                <div class="w-full md:w-1/3">
                    <input-group
                        input-autocomplete="menu_slug_search"
                        input-class="form-control form-control-short"
                        input-id="menu_slug"
                        input-name="menu_slug"
                        input-placeholder="Menu Slug"
                        input-type="text"
                        :label-hidden="true"
                        label-text="Menu Slug"
                        v-model="editableSearchOptions.menu_slug"
                    />
                </div>
            </div>

            <p
                v-if="!menusData"
                class="bg-theme-base-subtle mt-8 mx-6 px-6 py-4 rounded text-center text-theme-base-subtle-contrast"
            >
                No menus
            </p>

            <template v-else>

                <!-- Search Results -->
                <div class="block mt-8 overflow-x-auto w-full">
                    <table class="table table-hover table-striped w-full">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th v-if="showMenuActions"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr
                            v-for="(menu, index) in menusData"
                            :key="`menu-${menu.id}`"
                        >
                            <td>
                                {{ menu.name }}
                            </td>
                            <td>
                                {{ menu.slug }}
                            </td>
                            <td v-if="showMenuActions">
                                <div class="flex flex-row items-center justify-end -mx-1">
                                    <inertia-link
                                        v-if="userCan('cms.edit')"
                                        class="
                                            flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                                            focus:outline-none focus:ring
                                            hover:bg-theme-info hover:text-theme-info-contrast
                                        "
                                        :href="$route('admin.cms.menus.edit', menu.id)"
                                        title="Edit Menu"
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
                                        title="Delete Menu"
                                        @click="checkDelete(menu)"
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
                    <pagination :pagination="menus.pagination" />
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

    export default {
        name: "AdminCmsPageIndex",
        components: {
            ConfirmationModal,
            InputGroup,
        },
        layout: 'admin-layout',
        props: {
            menus: {
                required: true,
                type: Object,
            },
            searchOptions: {
                required: true,
                type: Object | Array,
            }
        },
        data() {
            return {
                editableSearchOptions: {
                    menu_name   : '',
                    menu_slug   : '',
                    per_page    : 15,
                },
                isInitialised: false,
                isLoadingDelete: false,
                showDeleteModal: false,
                menuToDelete: null,
            }
        },
        mounted() {
            this.setSearchOptions(this.searchOptions);
        },
        computed: {
            deleteModalText() {
                try {
                    return 'Do you really want to delete \'' + this.menuToDelete.name + '\'?';
                } catch (e) {
                    return 'Do you really want to delete this menu?'
                }
            },
            showPagination() {
                try {
                    return this.menus.pagination.last_page > 1;
                } catch (e) {
                    return false;
                }
            },
            showMenuActions() {
                return this.userCan('cms.edit') || this.userCan('cms.delete');
            },
            menusData() {
                if (!this.menus || !this.menus.data || this.menus.data.length < 1) {
                    return false;
                }

                return this.menus.data;
            }
        },
        methods: {
            cancelDelete() {
                if (!this.isLoadingDelete) {
                    this.showDeleteModal = false;
                    this.menuToDelete = null;
                }
            },
            checkDelete(menu) {
                this.showDeleteModal = true;
                this.menuToDelete = menu;
            },
            confirmDelete() {
                if (this.isLoadingDelete) {
                    return this.$errorToast('It\'s only possible to delete one menu at a time.');
                }
                this.$inertia.delete(
                    this.$route('admin.cms.menus.destroy', this.menuToDelete.id),
                    {
                        only: [
                            'flash',
                            'menus'
                        ]
                    }
                );
                this.menuToDelete = null;
                this.showDeleteModal = false;
            },
            onSearchOptionsUpdate: _.debounce(function () {
                if (!this.isInitialised) {
                    this.isInitialised = true;

                    // If there are already search results, don't attempt search
                    if (this.menusData) {
                        return;
                    }
                }

                Inertia.get(
                    this.$route('admin.cms.menus.index'),
                    this.editableSearchOptions,
                    {
                        only: ['menus'],
                        preserveState: true,
                    }
                );
            }, 500),
            setSearchOptions(new_options = {}) {
                let options = {
                    menu_name   : '',
                    menu_slug   : '',
                    per_page    : 15,
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
