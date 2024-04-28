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
                <div class="w-full md:w-1/6">
                    <select-group
                        :label-hidden="true"
                        label-text="Status"
                        :input-any-option-enabled="true"
                        input-any-option-label="Status (All)"
                        input-class="form-control form-control-short"
                        input-id="status"
                        input-name="status"
                        input-option-label-key="name"
                        input-option-value-key="id"
                        :input-options="statuses"
                        v-model="editableSearchOptions.course_purchase_status"
                    />
                </div>

                <div class="w-full md:w-1/6">
                    <select-group
                        :label-hidden="true"
                        label-text="Type"
                        :input-any-option-enabled="true"
                        input-any-option-label="Types (All)"
                        input-class="form-control form-control-short"
                        input-id="type"
                        input-name="type"
                        input-option-label-key="name"
                        input-option-value-key="id"
                        :input-options="types"
                        v-model="editableSearchOptions.course_purchase_type"
                    />
                </div>

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
                        v-model="editableSearchOptions.course_purchase_email_address"
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
                            <th>Date</th>
                            <th>Course</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Type</th>
                            <th>Price Due</th>
                            <th>Price Paid</th>
                            <th>Refundable</th>
                            <th v-if="showActions"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr
                            v-for="(purchase) in purchaseData"
                            :key="`purchase-${purchase.id}`"
                        >
                            <td>
                                {{ purchase.created_at | humanFriendlyDateTime }}
                            </td>
                            <td>
                                {{ purchase.course.name }}
                            </td>
                            <td>
                                {{ purchase.email_address }}
                            </td>
                            <td>
                                {{
                                    statuses.hasOwnProperty(purchase.status) ?
                                        statuses[purchase.status] : purchase.status
                                }}
                            </td>
                            <td>
                                {{
                                    types.hasOwnProperty(purchase.type) ?
                                        types[purchase.type] : purchase.type
                                }}
                            </td>
                            <td>
                                {{ purchase.currency | currencySymbol }} {{ purchase.total_price_due | priceDecimal }}
                            </td>
                            <td>
                                {{ purchase.currency | currencySymbol }} {{ purchase.total_price_paid | priceDecimal }}
                            </td>
                            <td>
                                <component
                                    :is="purchase.is_refundable ? 'icon-check' : 'icon-close'"
                                    class="w-4"
                                />
                            </td>

                            <td v-if="showActions">
                                <div class="flex flex-row items-center justify-end -mx-1">
                                    <inertia-link
                                        v-if="userCan('edu_course_purchases.show')"
                                        class="
                                            flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                                            focus:outline-none focus:ring
                                            hover:bg-theme-info hover:text-theme-info-contrast
                                        "
                                        :href="$route('admin.edu.course-purchases.show', purchase.id)"
                                        title="View"
                                    >
                                        <icon-eye
                                            class="w-4"
                                        />
                                    </inertia-link>
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
        </div>
    </section>
</template>

<script>
    import _ from 'lodash';
    import { router } from '@inertiajs/vue2'
    import ConfirmationModal from "../../../../../components/core/modals/ConfirmationModal.vue";
    import SelectGroup from "../../../../../components/core/forms/SelectGroup.vue";
    import InputGroup from "../../../../../components/core/forms/InputGroup.vue";
    import IconSave from "../../../../../components/core/icons/IconSave.vue";
    import IconCheck from "../../../../../components/core/icons/IconCheck.vue";

    export default {
        name: "AdminEDUCoursePurchaseIndex",
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
                type: Object,
            },
            types: {
                required: true,
                type: Object,
            }
        },
        data() {
            return {
                editableSearchOptions: {
                    course_purchase_course_id: '',
                    course_purchase_email_address: '',
                    course_purchase_status: '',
                    course_purchase_type: '',
                    course_purchase_user_id: '',
                    per_page: 25,
                },
                isInitialised: false,
            }
        },
        mounted() {
            this.setSearchOptions(this.searchOptions);
        },
        computed: {
            showPagination() {
                try {
                    return this.purchases.pagination.last_page > 1;
                } catch (e) {
                    return false;
                }
            },
            showActions() {
                return this.userCan('edu_course_purchases.show');
            },
            purchaseData() {
                if (!this.purchases || !this.purchases.data || this.purchases.data.length < 1) {
                    return false;
                }

                return this.purchases.data;
            }
        },
        methods: {
            onSearchOptionsUpdate: _.debounce(function () {
                if (!this.isInitialised) {
                    this.isInitialised = true;

                    // If there are already search results, don't attempt search
                    if (this.purchaseData) {
                        return;
                    }
                }

                router.get(
                    this.$route('admin.edu.course-purchases.index'),
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
