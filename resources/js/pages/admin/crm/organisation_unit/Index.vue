<template>
    <section>
        <!-- Header -->
        <div
            class="flex flex-row items-center mb-6"
        >
            <h1 class="font-medium mr-auto text-lg">
                Organisation Units
            </h1>

            <inertia-link
                v-if="userCan('crm_organisation_units.create')"
                class="
                    button button-default-responsive button-primary
                    flex flex-row items-center
                "
                :href="$route('admin.crm.organisation-units.create')"
            >
                <icon-plus class="w-5 md:mr-2"/>

                <span
                    class="hidden md:inline"
                >
                        Create Organisation Unit
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

            <!-- Search Panel -->
            <div
                class="
                    flex flex-col items-center mt-4 px-6 space-y-4
                    md:flex-row md:space-y-0 md:space-x-8
                "
            >
                <div class="w-full md:w-1/4">
                    <select-group
                        class="mx-4"
                        :label-hidden="true"
                        label-text="Type"
                        :input-any-option-enabled="true"
                        input-any-option-label="Type"
                        input-class="form-control form-control-short"
                        input-id="organisation_unit_type"
                        input-name="organisation_unit_type"
                        :input-options="organisationUnitTypes"
                        v-model="editableSearchOptions.organisation_unit_type"
                    />
                </div>

                <div class="w-full md:w-1/4">
                    <input-group
                        input-autocomplete="organisation_unit_name_search"
                        input-class="form-control form-control-short"
                        input-id="organisation_unit_name"
                        input-name="organisation_unit_name"
                        input-placeholder="Name"
                        input-type="text"
                        :label-hidden="true"
                        label-text="Name"
                        v-model="editableSearchOptions.organisation_unit_name"
                    />
                </div>

                <div class="w-full md:w-1/4">
                    <input-group
                        input-autocomplete="organisation_unit_email"
                        input-class="form-control form-control-short"
                        input-id="organisation_unit_email"
                        input-name="organisation_unit_email"
                        input-placeholder="Email"
                        input-type="text"
                        :label-hidden="true"
                        label-text="Email"
                        v-model="editableSearchOptions.organisation_unit_email"
                    />
                </div>

                <div class="w-full md:w-1/4">
                    <input-group
                        input-autocomplete="organisation_unit_telephone_search"
                        input-class="form-control form-control-short"
                        input-id="organisation_unit_telephone"
                        input-name="organisation_unit_telephone"
                        input-placeholder="Telephone"
                        input-type="text"
                        :label-hidden="true"
                        label-text="Telephone"
                        v-model="editableSearchOptions.organisation_unit_telephone"
                    />
                </div>
            </div>

            <!-- No Results -->
            <p
                v-if="!organisationUnitsData"
                class="bg-theme-base-subtle mt-6 mx-6 px-6 py-4 rounded text-center text-theme-base-subtle-contrast"
            >
                No organisation units
            </p>

            <!-- Search Results -->
            <template v-else>
                <!-- Search Results -->
                <div class="block mt-8 overflow-x-auto w-full">
                    <table
                        class="table table-hover table-striped w-full"
                    >
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Telephone</th>
                                <th v-if="showOrganisationUnitActions"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(organisationUnit, index) in organisationUnitsData"
                                :key="`organisation-unit-${organisationUnit.slug}`"
                            >
                                <td>
                                    {{ organisationUnitTypes[organisationUnit.type] }}
                                </td>
                                <td>
                                    {{ organisationUnit.name }}
                                </td>
                                <td>
                                    {{ organisationUnit.email }}
                                </td>
                                <td>
                                    {{ organisationUnit.telephone }}
                                </td>
                                <td v-if="showOrganisationUnitActions">
                                    <div class="flex flex-row items-center justify-end -mx-1">
                                        <inertia-link
                                            v-if="userCan('crm_organisation_units.edit')"
                                            class="
                                                flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                                                focus:outline-none focus:ring
                                                hover:bg-theme-info hover:text-theme-info-contrast
                                            "
                                            :href="$route('admin.crm.organisation-units.edit', organisationUnit.id)"
                                            title="Edit Organisation Unit"
                                        >
                                            <icon-edit class="w-4" />
                                        </inertia-link>

                                        <button
                                            v-if="userCan('crm_organisation_units.delete')"
                                            class="
                                                flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                                                focus:outline-none focus:ring
                                                hover:bg-theme-danger hover:text-theme-danger-contrast
                                            "
                                            title="Delete Organisation Unit"
                                            @click="checkDelete(organisationUnit)"
                                        >
                                            <icon-trash class="w-4" />
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
                <pagination :pagination="organisationUnits.pagination" />
            </div>


            <!-- Modals -->
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
    import _ from "lodash";
    import { router } from '@inertiajs/vue2';
    import ConfirmationModal from "../../../../components/core/modals/ConfirmationModal.vue";
    import InputGroup from "../../../../components/core/forms/InputGroup.vue";
    import SelectGroup from "../../../../components/core/forms/SelectGroup.vue";

    export default {
        name: "AdminCrmOrganisationUnitIndex",
        components: {
            ConfirmationModal,
            InputGroup,
            SelectGroup,
        },
        layout: 'admin-layout',
        props: {
            searchOptions: {
                required: true,
                type: Array | Object,
            },
            organisationUnits: {
                required: true,
                type: Object,
            },
            organisationUnitTypes: {
                required: true,
                type: Object,
            },
        },
        data() {
            return {
                editableSearchOptions: {
                    organisation_unit_email     : '',
                    organisation_unit_name      : '',
                    organisation_unit_telephone : '',
                    organisation_unit_type      : '',
                    per_page                    : 15,
                },
                isInitialised: false,
                isLoadingDelete: false,
                showDeleteModal: false,
                organisationUnitToDelete: null,
            }
        },
        computed: {
            organisationUnitsData() {
                if (!this.organisationUnits || !this.organisationUnits.data || this.organisationUnits.data.length < 1) {
                    return false;
                }

                return this.organisationUnits.data;
            },
            deleteModalText() {
                try {
                    return 'Do you really want to delete \'' + this.organisationUnitToDelete.name + '\'?';
                } catch (e) {
                    return 'Do you really want to delete this organisation unit?'
                }
            },
            showOrganisationUnitActions() {
                return this.userCan('crm_organisation_units.edit') || this.userCan('crm_organisation_units.delete');
            },
            showPagination() {
                try {
                    return this.organisationUnits.pagination.last_page > 1;
                } catch (e) {
                    return false;
                }
            },
        },
        mounted() {
            this.setSearchOptions(this.searchOptions);
        },
        methods: {
            cancelDelete() {
                if (!this.isLoadingDelete) {
                    this.showDeleteModal = false;
                    this.organisationUnitToDelete = null;
                }
            },
            checkDelete(organisationUnit) {
                this.showDeleteModal = true;
                this.organisationUnitToDelete = organisationUnit;
            },
            confirmDelete() {
                if (this.isLoadingDelete) {
                    return this.$errorToast('It\'s only possible to delete one organisation unit at a time.');
                }
                this.$inertia.delete(
                    this.$route('admin.crm.organisation-units.destroy', this.organisationUnitToDelete.id),
                    {
                        only: [
                            'flash',
                            'organisationUnits'
                        ]
                    }
                );

                this.organisationUnitToDelete = null
                this.showDeleteModal = false;
            },
            onSearchOptionsUpdate: _.debounce(function () {
                if (!this.isInitialised) {
                    this.isInitialised = true;

                    // If there are already search results, don't attempt search
                    if (this.organisationUnitsData) {
                        return;
                    }
                }

                router.get(
                    this.$route('admin.crm.organisation-units.index'),
                    this.editableSearchOptions,
                    {
                        only: ['organisationUnits'],
                        preserveState: true,
                    }
                );
            }, 500),
            setSearchOptions(new_options = {}) {
                let options = {
                    organisation_unit_email     : '',
                    organisation_unit_name      : '',
                    organisation_unit_telephone : '',
                    organisation_unit_type      : '',
                    per_page                    : 15,
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
