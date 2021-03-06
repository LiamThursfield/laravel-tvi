<template>
    <section>
        <!-- Header -->
        <div
            class="flex flex-row items-center mb-6"
        >
            <h1 class="font-medium mr-auto text-lg">
                Forms
            </h1>

            <inertia-link
                v-if="userCan('crm_forms.create')"
                class="
                    button button-default-responsive button-primary
                    flex flex-row items-center
                "
                :href="$route('admin.crm.forms.create')"
            >
                <icon-plus class="w-5 md:mr-2"/>

                <span
                    class="hidden md:inline"
                >
                    Create Form
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
                <div class="w-full md:w-1/2">
                    <input-group
                        input-autocomplete="form_name_search"
                        input-class="form-control form-control-short"
                        input-id="form_name"
                        input-name="form_name"
                        input-placeholder="Form Name"
                        input-type="text"
                        :label-hidden="true"
                        label-text="Form Name"
                        v-model="editableSearchOptions.form_name"
                    />
                </div>

                <div class="w-full md:w-1/2">
                    <input-group
                        input-autocomplete="form_slug_search"
                        input-class="form-control form-control-short"
                        input-id="form_slug"
                        input-name="form_slug"
                        input-placeholder="Form Slug"
                        input-type="text"
                        :label-hidden="true"
                        label-text="Form Slug"
                        v-model="editableSearchOptions.form_slug"
                    />
                </div>
            </div>

            <p
                v-if="!formsData"
                class="bg-theme-base-subtle mt-8 mx-6 px-6 py-4 rounded text-center text-theme-base-subtle-contrast"
            >
                No forms
            </p>

            <template v-else>
                <!-- Search Results -->
                <div class="block mt-8 overflow-x-auto w-full">
                    <table class="table table-hover table-striped w-full">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th v-if="showFormActions"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr
                            v-for="form in formsData"
                            :key="`template-${form.id}`"
                        >
                            <td>
                                {{ form.name }}
                            </td>
                            <td>
                                {{ form.slug }}
                            </td>
                            <td v-if="showFormActions">
                                <div class="flex flex-row items-center justify-end -mx-1">
                                    <inertia-link
                                        v-if="userCan('crm_forms.edit')"
                                        class="
                                            flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                                            focus:outline-none focus:ring
                                            hover:bg-theme-info hover:text-theme-info-contrast
                                        "
                                        :href="$route('admin.crm.forms.edit', form.id)"
                                        title="Edit Form"
                                    >
                                        <icon-edit
                                            class="w-4"
                                        />
                                    </inertia-link>

                                    <button
                                        v-if="userCan('crm_forms.delete')"
                                        class="
                                            flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                                            focus:outline-none focus:ring
                                            hover:bg-theme-danger hover:text-theme-danger-contrast
                                        "
                                        title="Delete Template"
                                        @click="checkDelete(form)"
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
                    <pagination :pagination="forms.pagination" />
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
    import SelectGroup from "../../../../components/core/forms/SelectGroup";

    export default {
        name: "AdminCrmFormIndex",
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
            forms: {
                required: true,
                type: Object,
            },
        },
        data() {
            return {
                editableSearchOptions: {
                    per_page    : 15,
                    form_name   : '',
                    form_slug   : '',
                },
                isInitialised: false,
                isLoadingDelete: false,
                showDeleteModal: false,
                formToDelete: null,
            }
        },
        computed: {
            deleteModalText() {
                try {
                    return 'Do you really want to delete \'' + this.formToDelete.name + '\'?';
                } catch (e) {
                    return 'Do you really want to delete this form?'
                }
            },
            showPagination() {
                try {
                    return this.forms.pagination.last_page > 1;
                } catch (e) {
                    return false;
                }
            },
            showFormActions() {
                return this.userCan('crm_forms.edit') || this.userCan('crm_forms.delete');
            },
            formsData() {
                if (!this.forms || !this.forms.data || this.forms.data.length < 1) {
                    return false;
                }

                return this.forms.data;
            }
        },
        mounted() {
            this.setSearchOptions(this.searchOptions);
        },
        methods: {
            cancelDelete() {
                if (!this.isLoadingDelete) {
                    this.showDeleteModal = false;
                    this.formToDelete = null;
                }
            },
            checkDelete(form) {
                this.showDeleteModal = true;
                this.formToDelete = form;
            },
            confirmDelete() {
                if (this.isLoadingDelete) {
                    return this.$errorToast('It\'s only possible to delete one form at a time.');
                }
                this.$inertia.delete(
                    this.$route('admin.crm.forms.destroy', this.formToDelete.id),
                    {
                        only: [
                            'flash',
                            'forms'
                        ]
                    }
                );
                this.formToDelete = null;
                this.showDeleteModal = false;
            },
            onSearchOptionsUpdate: _.debounce(function () {
                if (!this.isInitialised) {
                    this.isInitialised = true;

                    // If there are already search results, don't attempt search
                    if (this.formsData) {
                        return;
                    }
                }

                Inertia.get(
                    this.$route('admin.crm.forms.index'),
                    this.editableSearchOptions,
                    {
                        only: ['forms'],
                        preserveState: true,
                    }
                );
            }, 500),
            setSearchOptions(new_options = {}) {
                let options = {
                    per_page        : 15,
                    form_name   : '',
                    form_slug   : '',
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
