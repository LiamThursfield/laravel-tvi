<template>
    <section>
        <div
            class="flex flex-row items-center mb-6"
        >
            <h1 class="font-medium mr-auto text-lg">
                Announcements
            </h1>

            <inertia-link
                v-if="userCan('announcements.create')"
                class="
                    button button-default-responsive button-primary
                    flex flex-row items-center
                "
                :href="$route('admin.edu.announcements.create')"
            >
                <icon-plus class="w-5 md:mr-2"/>

                <span
                    class="hidden md:inline"
                >
                    Create
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
                        input-autocomplete="announcement_title_search"
                        input-class="form-control form-control-short"
                        input-id="announcement_title"
                        input-name="announcement_title"
                        input-placeholder="Announcement Title"
                        input-type="text"
                        :label-hidden="true"
                        label-text="Announcement Title"
                        v-model="editableSearchOptions.announcement_title"
                    />
                </div>
            </div>

            <p
                v-if="!announcementData"
                class="bg-theme-base-subtle mt-8 mx-6 px-6 py-4 rounded text-center text-theme-base-subtle-contrast"
            >
                No results
            </p>

            <template v-else>

                <!-- Search Results -->
                <div class="block mt-8 overflow-x-auto w-full">
                    <table class="table table-hover table-striped w-full">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Created By</th>
                            <th>Status</th>
                            <th>Platform</th>
                            <th>Email</th>
                            <th>SMS</th>
                            <th v-if="showActions"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr
                            v-for="(item, index) in announcementData"
                            :key="`item-${item.id}`"
                        >
                            <td>
                                {{ item.title }}
                            </td>
                            <td>
                                <span v-html="item.description"></span>
                            </td>
                            <td>
                                {{ item.creator ? item.creator.first_name + ' ' + item.creator.last_name:'' }}
                            </td>
                            <td>
                                {{ item.status }}
                            </td>
                            <td>
                                {{ item.platform ? 'Yes':'No' }}
                            </td>
                            <td>
                                {{ item.email ? 'Yes':'No' }}
                            </td>
                            <td>
                                {{ item.sms ? 'Yes':'No' }}
                            </td>
                            <td v-if="showActions">
                                <div class="flex flex-row items-center justify-end -mx-1">
                                    <button
                                        v-if="userCan('announcements.publish')"
                                        class="
                                            flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                                            focus:outline-none focus:ring
                                            hover:bg-theme-success hover:text-theme-success-contrast
                                        "
                                        title="Publish"
                                        @click="checkPublishAnnouncement(item)"
                                    >
                                        <icon-check
                                            class="w-4"
                                        />
                                    </button>
                                    <inertia-link
                                        v-if="userCan('announcements.edit')"
                                        class="
                                            flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                                            focus:outline-none focus:ring
                                            hover:bg-theme-info hover:text-theme-info-contrast
                                        "
                                        :href="$route('admin.edu.announcements.edit', item.id)"
                                        title="Edit"
                                    >
                                        <icon-edit
                                            class="w-4"
                                        />
                                    </inertia-link>

                                    <button
                                        v-if="userCan('announcements.delete')"
                                        class="
                                            flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                                            focus:outline-none focus:ring
                                            hover:bg-theme-danger hover:text-theme-danger-contrast
                                        "
                                        title="Delete"
                                        @click="checkDelete(item)"
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
                    <pagination :pagination="announcements.pagination" />
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

            <confirmation-modal
                confirm-text="Publish"
                confirm-type="success"
                :show-modal="showConfirmPublishModal"
                :message-text="publishModalText"
                @cancelAction="cancelPublish"
                @closeModal="cancelPublish"
                @confirmAction="confirmPublish"
            />
        </div>
    </section>
</template>

<script>
    import _ from 'lodash';
    import { router } from '@inertiajs/vue2'
    import ConfirmationModal from "../../../../components/core/modals/ConfirmationModal.vue";
    import InputGroup from "../../../../components/core/forms/InputGroup.vue";
    import IconSave from "../../../../components/core/icons/IconSave.vue";
    import IconCheck from "../../../../components/core/icons/IconCheck.vue";

    export default {
        name: "AdminEDUAnnouncementIndex",
        components: {
            IconCheck,
            IconSave,
            ConfirmationModal,
            InputGroup,
        },
        layout: 'admin-layout',
        props: {
            announcements: {
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
                    announcement_title   : '',
                    per_page    : 15,
                },
                isInitialised: false,
                isLoadingDelete: false,
                isLoadingPublish: false,
                showDeleteModal: false,
                itemToDelete: null,
                showConfirmPublishModal: null,
                itemToPublish: null,
            }
        },
        mounted() {
            this.setSearchOptions(this.searchOptions);
        },
        computed: {
            publishModalText() {
                try {
                    return 'Do you really want to publish \'' + this.itemToPublish.title + '\'?';
                } catch (e) {
                    return 'Do you really want to perform this action?'
                }
            },
            deleteModalText() {
                try {
                    return 'Do you really want to delete \'' + this.itemToDelete.title + '\'?';
                } catch (e) {
                    return 'Do you really want to delete this?'
                }
            },
            showPagination() {
                try {
                    return this.announcements.pagination.last_page > 1;
                } catch (e) {
                    return false;
                }
            },
            showActions() {
                return this.userCan('announcements.edit') || this.userCan('announcements.delete');
            },
            announcementData() {
                if (!this.announcements || !this.announcements.data || this.announcements.data.length < 1) {
                    return false;
                }

                return this.announcements.data;
            }
        },
        methods: {
            checkPublishAnnouncement(item) {
                this.showConfirmPublishModal = true;
                this.itemToPublish = item;
            },
            confirmPublish() {
                if (this.isLoadingPublish) {
                    return this.$errorToast('It\'s only possible to publish one item at a time.');
                }
                this.$inertia.patch(
                    this.$route('admin.edu.announcements.publish', this.itemToPublish.id),
                    {
                        only: [
                            'flash',
                            'announcements'
                        ]
                    }
                );
                this.itemToPublish = null;
                this.showConfirmPublishModal = false;
            },
            cancelPublish() {
                if (!this.isLoadingPublish) {
                    this.showConfirmPublishModal = false;
                    this.itemToPublish = null;
                }
            },
            cancelDelete() {
                if (!this.isLoadingDelete) {
                    this.showDeleteModal = false;
                    this.itemToDelete = null;
                }
            },
            checkDelete(item) {
                this.showDeleteModal = true;
                this.itemToDelete = item;
            },
            confirmDelete() {
                if (this.isLoadingDelete) {
                    return this.$errorToast('It\'s only possible to delete one item at a time.');
                }
                this.$inertia.delete(
                    this.$route('admin.edu.announcements.destroy', this.itemToDelete.id),
                    {
                        only: [
                            'flash',
                            'announcements'
                        ]
                    }
                );
                this.itemToDelete = null;
                this.showDeleteModal = false;
            },
            onSearchOptionsUpdate: _.debounce(function () {
                if (!this.isInitialised) {
                    this.isInitialised = true;

                    // If there are already search results, don't attempt search
                    if (this.announcementData) {
                        return;
                    }
                }

                router.get(
                    this.$route('admin.edu.announcements.index'),
                    this.editableSearchOptions,
                    {
                        only: ['announcements'],
                        preserveState: true,
                    }
                );
            }, 500),
            setSearchOptions(new_options = {}) {
                let options = {
                    announcement_title   : '',
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
