<template>
    <section>
        <div
            class="flex flex-row items-center mb-6"
        >
            <h1 class="font-medium mr-auto text-lg">
                Tenants
            </h1>

            <inertia-link
                v-if="userCan('tenants.create')"
                class="
                    button button-default-responsive button-primary
                    flex flex-row items-center
                "
                :href="$route('landlord.admin.tenants.create')"
            >
                <icon-plus class="w-5 md:mr-2"/>

                <span
                    class="hidden md:inline"
                >
                    Create Tenant
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
                        input-autocomplete="tenant_id_search"
                        input-class="form-control form-control-short"
                        input-id="tenant_id"
                        input-name="tenant_id"
                        input-placeholder="Tenant ID"
                        input-type="text"
                        :label-hidden="true"
                        label-text="Tenant ID"
                        v-model="editableSearchOptions.tenant_id"
                    />
                </div>
            </div>

            <p
                v-if="!tenantsData"
                class="bg-theme-base-subtle mt-6 mx-6 px-6 py-4 rounded text-center text-theme-base-subtle-contrast"
            >
                No tenants
            </p>

            <template v-else>
                <!-- Search Results -->
                <div class="block mt-8 overflow-x-auto w-full">
                    <table
                        class="table table-hover table-striped w-full"
                    >
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th v-if="show_tenants_actions"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(tenant, index) in tenantsData"
                                :key="`tenant-${tenant.id}`"
                            >
                                <td>
                                    {{ tenant.id }}
                                </td>
                                <td v-if="show_tenants_actions">
                                    <div class="flex flex-row items-center justify-end -mx-1">
                                        <inertia-link
                                            v-if="userCan('tenants.edit')"
                                            class="
                                                flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                                                focus:outline-none focus:ring
                                                hover:bg-theme-info hover:text-theme-info-contrast
                                            "
                                            :href="$route('landlord.admin.tenants.edit', tenant.id)"
                                            title="Edit Tenant"
                                        >
                                            <icon-edit
                                                class="w-4"
                                            />
                                        </inertia-link>

                                        <button
                                            v-if="userCan('tenants.delete')"
                                            class="
                                                flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                                                focus:outline-none focus:ring
                                                hover:bg-theme-danger hover:text-theme-danger-contrast
                                            "
                                            title="Delete Tenant"
                                            @click="checkTenantDelete(tenant)"
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
            </template>

            <!-- Pagination -->
            <div
                v-if="showPagination"
                class="flex flex-row justify-center mt-12 px-6"
            >
                <pagination :pagination="tenants.pagination" />
            </div>

            <confirmation-modal
                confirm-text="Delete"
                confirm-type="danger"
                :show-modal="showDeleteModal"
                :message-text="deleteModalText"
                @cancelAction="cancelTenantDelete"
                @closeModal="cancelTenantDelete"
                @confirmAction="confirmTenantDelete"
            />
        </div>
    </section>
</template>

<script>

    import _ from "lodash";
    import { router } from '@inertiajs/vue2';
    import ConfirmationModal from "../../../../components/core/modals/ConfirmationModal.vue";
    import InputGroup from "../../../../components/core/forms/InputGroup.vue";

    export default {
        name: "AdminTenantIndex",
        components: {
            ConfirmationModal,
            InputGroup
        },
        layout: 'admin-layout',
        props: {
            searchOptions: Array | Object,
            tenants: Object,
        },
        data() {
            return {
                editableSearchOptions: {
                    per_page  : 15,
                    tenant_id : '',
                },
                isInitialised: false,
                isLoadingTenantDelete: false,
                showDeleteModal: false,
                tenantToDelete: null,
            }
        },
        computed: {
            deleteModalText() {
                try {
                    return 'Do you really want to delete \'' + this.tenantToDelete.id + '\'?';
                } catch (e) {
                    return 'Do you really want to delete this tenant?'
                }
            },
            show_tenants_actions() {
                return this.userCan('tenants.edit') || this.userCan('tenants.delete');
            },
            showPagination() {
                try {
                    return this.tenants.pagination.last_page > 1;
                } catch (e) {
                    return false;
                }
            },
            tenantsData() {
                if (!this.tenants || !this.tenants.data || this.tenants.data.length < 1) {
                    return false;
                }

                return this.tenants.data;
            }
        },
        mounted() {
            this.setSearchOptions(this.searchOptions);
        },
        methods: {
            cancelTenantDelete() {
                if (!this.isLoadingTenantDelete) {
                    this.showDeleteModal = false;
                    this.tenantToDelete = null;
                }
            },
            checkTenantDelete(tenant) {
                this.showDeleteModal = true;
                this.tenantToDelete = tenant;
            },
            confirmTenantDelete() {
                if (this.isLoadingTenantDelete) {
                    return this.$errorToast('It\'s only possible to delete one tenant at a time.');
                }
                this.$inertia.delete(
                    this.$route('landlord.admin.tenants.destroy', this.tenantToDelete.id),
                    {
                        only: [
                            'flash',
                            'tenants'
                        ]
                    }
                );

                this.tenantToDelete = null
                this.showDeleteModal = false;
            },
            onSearchOptionsUpdate: _.debounce(function () {
                if (!this.isInitialised) {
                    this.isInitialised = true;

                    // If there are already search results, don't attempt search
                    if (this.tenantsData) {
                        return;
                    }
                }

                router.get(
                    this.$route('landlord.admin.tenants.index'),
                    this.editableSearchOptions,
                    {
                        only: ['tenants'],
                        preserveState: true,
                    }
                );
            }, 500),
            setSearchOptions(new_options = {}) {
                let options = {
                    per_page  : 15,
                    tenant_id : '',
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
