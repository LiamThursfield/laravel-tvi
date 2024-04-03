<template>
    <section>
        <div
            class="flex flex-row items-center mb-6"
        >
            <h1 class="font-medium mr-auto text-lg">
                Webinars
            </h1>

            <inertia-link
                v-if="userCan('webinars.create')"
                class="
                    button button-default-responsive button-primary
                    flex flex-row items-center
                "
                :href="$route('admin.edu.webinars.create')"
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
                        input-autocomplete="webinar_name_search"
                        input-class="form-control form-control-short"
                        input-id="webinar_name"
                        input-name="webinar_name"
                        input-placeholder="Webinar Name"
                        input-type="text"
                        :label-hidden="true"
                        label-text="Webinar Name"
                        v-model="editableSearchOptions.webinar_name"
                    />
                </div>
            </div>

            <p
                v-if="!webinarsData"
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
                            <th>Name</th>
                            <th>Course</th>
                            <th>Status</th>
                            <th>Scheduled At</th>
                            <th>Created By</th>
                            <th v-if="showActions"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr
                            v-for="(item, index) in webinarsData"
                            :key="`item-${item.id}`"
                        >
                            <td>
                                {{ item.name }}
                            </td>
                            <td>
                                {{ item.course ? item.course.name:'' }}
                                <br>
                                <small v-if="item.section"><b>Section:</b> {{ item.section.title }}</small>
                            </td>
                            <td>
                                {{ item.status }}
                            </td>
                            <td>
                                {{ item.date_time_from }} / {{ item.date_time_to }}
                            </td>

                            <td>
                                {{ item.creator ? item.creator.first_name + ' ' + item.creator.last_name:'' }}
                            </td>
                            <td v-if="showActions">
                                <div class="flex flex-row items-center justify-end -mx-1">
                                    <button
                                        v-if="userCan('webinars.publish') && item.status !== 'PUBLISHED'"
                                        class="
                                            flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                                            focus:outline-none focus:ring
                                            hover:bg-theme-success hover:text-theme-success-contrast
                                        "
                                        title="Publish"
                                        @click="checkPublishWebinar(item)"
                                    >
                                        <icon-check
                                            class="w-4"
                                        />
                                    </button>
                                    <inertia-link
                                        v-if="userCan('webinars.edit')"
                                        class="
                                            flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                                            focus:outline-none focus:ring
                                            hover:bg-theme-info hover:text-theme-info-contrast
                                        "
                                        :href="$route('admin.edu.webinars.edit', item.id)"
                                        title="Edit"
                                    >
                                        <icon-edit
                                            class="w-4"
                                        />
                                    </inertia-link>
                                    <button
                                        v-if="userCan('webinars.delete')"
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
                    <pagination :pagination="webinars.pagination" />
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
        name: "AdminEDUWebinarIndex",
        components: {
            IconCheck,
            IconSave,
            ConfirmationModal,
            InputGroup,
        },
        layout: 'admin-layout',
        props: {
            webinars: {
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
                    webinar_name   : '',
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
                    return 'Do you really want to publish \'' + this.itemToPublish.name + '\'?';
                } catch (e) {
                    return 'Do you really want to perform this action?'
                }
            },
            deleteModalText() {
                try {
                    return 'Do you really want to delete \'' + this.itemToDelete.name + '\'?';
                } catch (e) {
                    return 'Do you really want to delete this?'
                }
            },
            showPagination() {
                try {
                    return this.webinars.pagination.last_page > 1;
                } catch (e) {
                    return false;
                }
            },
            showActions() {
                return this.userCan('webinars.edit') || this.userCan('webinars.delete');
            },
            webinarsData() {
                if (!this.webinars || !this.webinars.data || this.webinars.data.length < 1) {
                    return false;
                }

                return this.webinars.data;
            }
        },
        methods: {
            checkPublishWebinar(item) {
                this.showConfirmPublishModal = true;
                this.itemToPublish = item;
            },
            confirmPublish() {
                if (this.isLoadingPublish) {
                    return this.$errorToast('It\'s only possible to publish one item at a time.');
                }
                this.$inertia.patch(
                    this.$route('admin.edu.webinars.publish', this.itemToPublish.id),
                    {
                        only: [
                            'flash',
                            'webinars'
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
                    this.$route('admin.edu.webinars.destroy', this.itemToDelete.id),
                    {
                        only: [
                            'flash',
                            'webinars'
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
                    if (this.webinarsData) {
                        return;
                    }
                }

                router.get(
                    this.$route('admin.edu.webinars.index'),
                    this.editableSearchOptions,
                    {
                        only: ['webinars'],
                        preserveState: true,
                    }
                );
            }, 500),
            setSearchOptions(new_options = {}) {
                let options = {
                    webinar_name   : '',
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
