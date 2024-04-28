<template>
    <section>
        <div
            class="flex flex-row items-center mb-6"
        >
            <h1 class="font-medium mr-auto text-lg">
                 Redirects
            </h1>

            <inertia-link
                v-if="userCan('cms_advanced.create')"
                class="
                    button button-default-responsive button-primary
                    flex flex-row items-center
                "
                :href="$route('admin.cms.redirects.create')"
            >
                <icon-plus class="w-5 md:mr-2"/>

                <span
                    class="hidden md:inline"
                >
                    Create Redirect
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
                        input-autocomplete="redirect_url_from"
                        input-class="form-control form-control-short"
                        input-id="redirect_url_from"
                        input-name="redirect_url_from"
                        input-placeholder="Redirect From"
                        input-type="text"
                        :label-hidden="true"
                        label-text="Redirect From"
                        v-model="editableSearchOptions.redirect_url_from"
                    />
                </div>

                <div class="w-full md:w-1/3">
                    <input-group
                        input-autocomplete="redirect_url_to"
                        input-class="form-control form-control-short"
                        input-id="redirect_url_to"
                        input-name="redirect_url_to"
                        input-placeholder="Redirect To"
                        input-type="text"
                        :label-hidden="true"
                        label-text="Redirect To"
                        v-model="editableSearchOptions.redirect_url_to"
                    />
                </div>
            </div>

            <p
                v-if="!redirectsData"
                class="bg-theme-base-subtle mt-8 mx-6 px-6 py-4 rounded text-center text-theme-base-subtle-contrast"
            >
                No redirects
            </p>

            <template v-else>

                <!-- Search Results -->
                <div class="block mt-8 overflow-x-auto w-full">
                    <table class="table table-hover table-striped w-full">
                        <thead>
                        <tr>
                            <th class="indicator-column"></th>
                            <th>From</th>
                            <th>To</th>
                            <th>Enabled</th>
                            <th>Permanent</th>
                            <th>Publish Date</th>
                            <th>Expiry Date</th>
                            <th v-if="showRedirectActions"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr
                            v-for="(redirect, index) in redirectsData"
                            :key="`redirect-${redirect.id}`"
                        >
                            <td class="indicator-column">
                                <div
                                    class="h-3 rounded-full w-3"
                                    :class="{
                                        'bg-theme-success-contrast': redirect.is_active,
                                        'bg-theme-danger-contrast': !redirect.is_active,
                                    }"
                                />
                            </td>
                            <td>
                                {{ redirect.url_from }}
                            </td>
                            <td>
                                {{ redirect.url_to }}
                            </td>
                            <td>
                                {{ redirect.is_enabled ? 'Yes' : 'No' }}
                            </td>
                            <td>
                                {{ redirect.is_permanent ? 'Yes' : 'No' }}
                            </td>
                            <td>
                                <template v-if="redirect.published_at">
                                    {{ redirect.published_at | humanFriendlyDateTime }}
                                </template>
                                <template v-else>
                                    -
                                </template>
                            </td>
                            <td>
                                <template v-if="redirect.expired_at">
                                    {{ redirect.expired_at | humanFriendlyDateTime }}
                                </template>
                                <template v-else>
                                    -
                                </template>
                            </td>

                            <td v-if="showRedirectActions">
                                <div class="flex flex-row items-center justify-end -mx-1">
                                    <inertia-link
                                        v-if="userCan('cms_advanced.edit')"
                                        class="
                                            flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                                            focus:outline-none focus:ring
                                            hover:bg-theme-info hover:text-theme-info-contrast
                                        "
                                        :href="$route('admin.cms.redirects.edit', redirect.id)"
                                        title="Edit Redirect"
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
                                        title="Delete Redirect"
                                        @click="checkDelete(redirect)"
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
                    <pagination :pagination="redirects.pagination" />
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
    import { router } from '@inertiajs/vue2'
    import ConfirmationModal from "../../../../components/core/modals/ConfirmationModal.vue";
    import InputGroup from "../../../../components/core/forms/InputGroup.vue";
    import SelectGroup from "../../../../components/core/forms/SelectGroup.vue";

    export default {
        name: "AdminCmsRedirectsIndex",
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
            redirects: {
                required: true,
                type: Object,
            },
        },
        data() {
            return {
                editableSearchOptions: {
                    per_page            : 15,
                    redirects_url_from  : '',
                    redirects_url_to    : '',
                },
                isInitialised: false,
                isLoadingDelete: false,
                showDeleteModal: false,
                redirectsToDelete: null,
            }
        },
        computed: {
            deleteModalText() {
                try {
                    return 'Do you really want to delete \'' + this.redirectsToDelete.url_from + '\'?';
                } catch (e) {
                    return 'Do you really want to delete this redirects?'
                }
            },
            showPagination() {
                try {
                    return this.redirects.pagination.last_page > 1;
                } catch (e) {
                    return false;
                }
            },
            showRedirectActions() {
                return this.userCan('cms_advanced.edit') || this.userCan('cms_advanced.delete');
            },
            redirectsData() {
                if (!this.redirects || !this.redirects.data || this.redirects.data.length < 1) {
                    return false;
                }

                return this.redirects.data;
            }
        },
        mounted() {
            this.setSearchOptions(this.searchOptions);
        },
        methods: {
            cancelDelete() {
                if (!this.isLoadingDelete) {
                    this.showDeleteModal = false;
                    this.redirectsToDelete = null;
                }
            },
            checkDelete(redirects) {
                this.showDeleteModal = true;
                this.redirectsToDelete = redirects;
            },
            confirmDelete() {
                if (this.isLoadingDelete) {
                    return this.$errorToast('It\'s only possible to delete one redirects at a time.');
                }
                this.$inertia.delete(
                    this.$route('admin.cms.redirects.destroy', this.redirectsToDelete.id),
                    {
                        only: [
                            'flash',
                            'redirects'
                        ]
                    }
                );
                this.redirectsToDelete = null;
                this.showDeleteModal = false;
            },
            onSearchOptionsUpdate: _.debounce(function () {
                if (!this.isInitialised) {
                    this.isInitialised = true;

                    // If there are already search results, don't attempt search
                    if (this.redirectsData) {
                        return;
                    }
                }

                router.get(
                    this.$route('admin.cms.redirects.index'),
                    this.editableSearchOptions,
                    {
                        only: ['redirects'],
                        preserveState: true,
                    }
                );
            }, 500),
            setSearchOptions(new_options = {}) {
                let options = {
                    per_page            : 15,
                    redirects_url_from  : '',
                    redirects_url_to    : '',
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
