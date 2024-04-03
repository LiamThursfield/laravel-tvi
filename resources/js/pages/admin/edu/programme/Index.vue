<template>
    <section>
        <div
            class="flex flex-row items-center mb-6"
        >
            <h1 class="font-medium mr-auto text-lg">
                Programme
            </h1>

            <inertia-link
                v-if="userCan('programmes.create')"
                class="
                    button button-default-responsive button-primary
                    flex flex-row items-center
                "
                :href="$route('admin.edu.programmes.create')"
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
                        input-autocomplete="programme_name_search"
                        input-class="form-control form-control-short"
                        input-id="programme_name"
                        input-name="programme_name"
                        input-placeholder="Programme Name"
                        input-type="text"
                        :label-hidden="true"
                        label-text="Programme Name"
                        v-model="editableSearchOptions.programme_name"
                    />
                </div>
            </div>

            <p
                v-if="!programmeData"
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
                            <th>Price</th>
                            <th>Status</th>
                            <th>Summary</th>
                            <th>Created By</th>
                            <th>Length</th>
                            <th>Total Courses</th>
                            <th>Total Participants</th>
                            <th>Total Sold</th>
                            <th v-if="showActions"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr
                            v-for="(item, index) in programmeData"
                            :key="`item-${item.id}`"
                        >
                            <td>
                                {{ item.name }}
                                <br>
                                <small>{{ item.slug}}</small>
                            </td>
                            <td>
                                {{ item.price + ' ' + item.currency }}
                            </td>
                            <td>
                                {{ item.status }}
                            </td>
                            <td>
                                {{ item.summary.length > 60 ? item.summary.substring(0,60) + ' ...':'' }}
                            </td>
                            <td>
                                {{ item.creator ? item.creator.first_name + ' ' + item.creator.last_name:'' }}
                            </td>
                            <td>
                                {{ item.content_length_video }}
                            </td>
                            <td>
                                {{ item.courses_count ?? 0 }}
                            </td>
                            <td>
                                {{ item.participants_count ?? 0 }}
                            </td>
                            <td>
                                {{ item.total_sold ?? 0 }}
                            </td>
                            <td v-if="showActions">
                                <div class="flex flex-row items-center justify-end -mx-1">
                                    <button
                                        v-if="userCan('programmes.publish')"
                                        class="
                                            flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                                            focus:outline-none focus:ring
                                            hover:bg-theme-success hover:text-theme-success-contrast
                                        "
                                        title="Publish"
                                        @click="checkPublishProgramme(item)"
                                    >
                                        <icon-check
                                            class="w-4"
                                        />
                                    </button>
                                    <inertia-link
                                        v-if="userCan('programmes.edit')"
                                        class="
                                            flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                                            focus:outline-none focus:ring
                                            hover:bg-theme-info hover:text-theme-info-contrast
                                        "
                                        :href="$route('admin.edu.programmes.edit', item.id)"
                                        title="Edit"
                                    >
                                        <icon-edit
                                            class="w-4"
                                        />
                                    </inertia-link>
                                    <inertia-link
                                        v-if="userCan('programmes.view')"
                                        class="
                                            flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                                            focus:outline-none focus:ring
                                            hover:bg-theme-info hover:text-theme-info-contrast
                                        "
                                        :href="$route('admin.edu.programmes.preview', item.id)"
                                        title="Preview"
                                    >
                                        <icon-eye
                                            class="w-4"
                                        />
                                    </inertia-link>
                                    <button
                                        v-if="userCan('programmes.delete')"
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
                    <pagination :pagination="programmes.pagination" />
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

    export default {
        name: "AdminEDUProgrammeIndex",
        components: {
            ConfirmationModal,
            InputGroup,
        },
        layout: 'admin-layout',
        props: {
            programmes: {
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
                    programme_name   : '',
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
                    return this.programmes.pagination.last_page > 1;
                } catch (e) {
                    return false;
                }
            },
            showActions() {
                return this.userCan('programmes.edit') || this.userCan('programmes.delete');
            },
            programmeData() {
                if (!this.programmes || !this.programmes.data || this.programmes.data.length < 1) {
                    return false;
                }

                return this.programmes.data;
            }
        },
        methods: {
            checkPublishCourse(item) {
                this.showConfirmPublishModal = true;
                this.itemToPublish = item;
            },
            confirmPublish() {
                if (this.isLoadingPublish) {
                    return this.$errorToast('It\'s only possible to publish one item at a time.');
                }
                this.$inertia.patch(
                    this.$route('admin.edu.programmes.publish', this.itemToPublish.id),
                    {
                        only: [
                            'flash',
                            'programmes'
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
                    this.$route('admin.edu.programmes.destroy', this.itemToDelete.id),
                    {
                        only: [
                            'flash',
                            'programmes'
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
                    if (this.programmeData) {
                        return;
                    }
                }

                router.get(
                    this.$route('admin.edu.programmes.index'),
                    this.editableSearchOptions,
                    {
                        only: ['programmes'],
                        preserveState: true,
                    }
                );
            }, 500),
            setSearchOptions(new_options = {}) {
                let options = {
                    programme_name   : '',
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
