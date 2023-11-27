<template>
    <section>
        <div
            class="flex flex-row items-center mb-6"
        >
            <h1 class="font-medium mr-auto text-lg">
                Purchases ({{ purchases.data.length}})
            </h1>
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
                        input-autocomplete="email_address_search"
                        input-class="form-control form-control-short"
                        input-id="email_address"
                        input-name="email_address"
                        input-placeholder="Email Address"
                        input-type="text"
                        :label-hidden="true"
                        label-text="Email Address"
                        v-model="editableSearchOptions.email_address"
                    />
                </div>

                <div class="w-full md:w-1/6">
                    <select-group
                        :label-hidden="true"
                        label-text="All"
                        :input-any-option-enabled="true"
                        input-any-option-label="All"
                        input-class="form-control form-control-short"
                        input-id="status"
                        input-name="status"
                        input-option-label-key="name"
                        input-option-value-key="id"
                        :input-options="statuses"
                        v-model="editableSearchOptions.payment_status"
                    />
                </div>
            </div>

            <p
                v-if="!purchaseData"
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
                            <th>Status</th>
                            <th>Refundable</th>
                            <th>Email</th>
                            <th>Redeemed At</th>
                            <th>Payment Total</th>
                            <th>Gateway</th>
                            <th>Item Name</th>
                            <th>Item Price</th>
                            <th>Total Price</th>
                            <th v-if="showActions"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr
                            v-for="(item, index) in purchaseData"
                            :key="`item-${item.id}`"
                        >
                            <td>
                               {{ item.payment_status}}
                            </td>
                            <td>
                                {{ item.is_refundable }}
                            </td>
                            <td>
                                {{ item.email_address }}
                            </td>
                            <td>
                                {{ item.redeemed_at }}
                            </td>
                            <td>
                                {{ item.payment_total + ' ' + item.payment_currency }}
                            </td>
                            <td>
                                {{ item.payment_gateway }}
                            </td>
                            <td>
                                Item Name
                            </td>
                            <td>
                               Item Price
                            </td>
                            <td>
                                Item Total Price
                            </td>
                            <td v-if="showActions">
                                <div class="flex flex-row items-center justify-end -mx-1">
                                    <inertia-link
                                        v-if="userCan('purchases.edit')"
                                        class="
                                            flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                                            focus:outline-none focus:ring
                                            hover:bg-theme-info hover:text-theme-info-contrast
                                        "
                                        :href="$route('admin.edu.purchases.edit', item.id)"
                                        title="Edit"
                                    >
                                        <icon-eye
                                            class="w-4"
                                        />
                                    </inertia-link>
                                    <button
                                        v-if="userCan('purchases.delete')"
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
                    <pagination :pagination="purchases.pagination" />
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
    import ConfirmationModal from "../../../../components/core/modals/ConfirmationModal";
    import SelectGroup from "../../../../components/core/forms/SelectGroup";
    import InputGroup from "../../../../components/core/forms/InputGroup";
    import IconSave from "../../../../components/core/icons/IconSave";
    import IconCheck from "../../../../components/core/icons/IconCheck";

    export default {
        name: "AdminEDUCourseIndex",
        components: {
            IconCheck,
            IconSave,
            ConfirmationModal,
            InputGroup,
            SelectGroup,
        },
        layout: 'admin-layout',
        props: {
            purchases: {
                required: true,
                type: Object,
            },
            searchOptions: {
                required: true,
                type: Object | Array,
            },
            statuses: {
                required: true,
                type: Object | Array,
            }
        },
        data() {
            return {
                editableSearchOptions: {
                    email_address: '',
                    payment_status: null,
                    per_page: 25,
                },
                isInitialised: false,
                isLoadingDelete: false,
                showDeleteModal: false,
                itemToDelete: null,
            }
        },
        mounted() {
            this.setSearchOptions(this.searchOptions);
        },
        computed: {
            deleteModalText() {
                try {
                    return 'Do you really want to delete purchase invoice from \'' + this.itemToDelete.email_address + '\'?';
                } catch (e) {
                    return 'Do you really want to delete this?'
                }
            },
            showPagination() {
                try {
                    return this.purchases.pagination.last_page > 1;
                } catch (e) {
                    return false;
                }
            },
            showActions() {
                return this.userCan('purchases.edit') || this.userCan('purchases.delete');
            },
            purchaseData() {
                if (!this.purchases || !this.purchases.data || this.purchases.data.length < 1) {
                    return false;
                }

                return this.purchases.data;
            }
        },
        methods: {
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
                    this.$route('admin.edu.purchases.destroy', this.itemToDelete.id),
                    {
                        only: [
                            'flash',
                            'purchases'
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
                    if (this.purchaseData) {
                        return;
                    }
                }

                router.get(
                    this.$route('admin.edu.purchases.index'),
                    this.editableSearchOptions,
                    {
                        only: ['purchases'],
                        preserveState: true,
                    }
                );
            }, 500),
            setSearchOptions(new_options = {}) {
                let options = {
                    email_address   : '',
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
