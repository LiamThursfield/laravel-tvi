<template>
    <section>
        <!-- Header -->
        <div
            class="flex flex-row items-center mb-6"
        >
            <h1 class="font-medium mr-auto text-lg">
                Contacts
            </h1>

            <inertia-link
                v-if="userCan('crm_contacts.create')"
                class="
                        button button-default-responsive button-primary
                        flex flex-row items-center
                    "
                :href="$route('admin.crm.contacts.create')"
            >
                <icon-plus class="w-5 md:mr-2"/>

                <span
                    class="hidden md:inline"
                >
                        Create Contact
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
                    <input-group
                        input-autocomplete="contact_first_name_search"
                        input-class="form-control form-control-short"
                        input-id="contact_first_name"
                        input-name="contact_first_name"
                        input-placeholder="First Name"
                        input-type="text"
                        :label-hidden="true"
                        label-text="First Name"
                        v-model="editableSearchOptions.contact_first_name"
                    />
                </div>

                <div class="w-full md:w-1/4">
                    <input-group
                        input-autocomplete="contact_last_name_search"
                        input-class="form-control form-control-short"
                        input-id="contact_last_name"
                        input-name="contact_last_name"
                        input-placeholder="Last Name"
                        input-type="text"
                        :label-hidden="true"
                        label-text="Last Name"
                        v-model="editableSearchOptions.contact_last_name"
                    />
                </div>

                <div class="w-full md:w-1/4">
                    <input-group
                        input-autocomplete="contact_email_search"
                        input-class="form-control form-control-short"
                        input-id="contact_email"
                        input-name="contact_email"
                        input-placeholder="Email"
                        input-type="text"
                        :label-hidden="true"
                        label-text="Email"
                        v-model="editableSearchOptions.contact_email"
                    />
                </div>

                <div class="w-full md:w-1/4">
                    <input-group
                        input-autocomplete="contact_telephone_search"
                        input-class="form-control form-control-short"
                        input-id="contact_telephone"
                        input-name="contact_telephone"
                        input-placeholder="Telephone"
                        input-type="text"
                        :label-hidden="true"
                        label-text="Telephone"
                        v-model="editableSearchOptions.contact_telephone"
                    />
                </div>
            </div>

            <!-- No Results -->
            <p
                v-if="!contactsData"
                class="bg-theme-base-subtle mt-6 mx-6 px-6 py-4 rounded text-center text-theme-base-subtle-contrast"
            >
                No contacts
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Telephone</th>
                                <th v-if="showContactsActions"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(contact, index) in contactsData"
                                :key="`contact-${contact.id}`"
                            >
                                <td>
                                    {{ contact.name_with_title }}
                                </td>
                                <td>
                                    {{ contact.email }}
                                </td>
                                <td>
                                    {{ contact.telephone }}
                                </td>
                                <td v-if="showContactsActions">
                                    <div class="flex flex-row items-center justify-end -mx-1">
                                        <inertia-link
                                            v-if="userCan('crm_contacts.edit')"
                                            class="
                                                    flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                                                    focus:outline-none focus:ring
                                                    hover:bg-theme-info hover:text-theme-info-contrast
                                                "
                                            :href="$route('admin.crm.contacts.edit', contact.id)"
                                            title="Edit User"
                                        >
                                            <icon-edit class="w-4" />
                                        </inertia-link>

                                        <button
                                            v-if="userCan('crm_contacts.delete')"
                                            class="
                                                    flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                                                    focus:outline-none focus:ring
                                                    hover:bg-theme-danger hover:text-theme-danger-contrast
                                                "
                                            title="Delete Contact"
                                            @click="checkDelete(contact)"
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
                <pagination :pagination="contacts.pagination" />
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
    import {Inertia} from "@inertiajs/inertia";
    import ConfirmationModal from "../../../../components/core/modals/ConfirmationModal";
    import InputGroup from "../../../../components/core/forms/InputGroup";

    export default {
        name: "AdminCrmContactIndex",
        components: {
            ConfirmationModal,
            InputGroup
        },
        layout: 'admin-layout',
        props: {
            searchOptions: {
                required: true,
                type: Array | Object,
            },
            contacts: {
                required: true,
                type: Object,
            },
        },
        data() {
            return {
                editableSearchOptions: {
                    contact_email       : '',
                    contact_first_name  : '',
                    contact_last_name   : '',
                    contact_telephone   : '',
                    per_page            : 15,
                },
                isInitialised: false,
                isLoadingDelete: false,
                showDeleteModal: false,
                contactToDelete: null,
            }
        },
        computed: {
            contactsData() {
                if (!this.contacts || !this.contacts.data || this.contacts.data.length < 1) {
                    return false;
                }

                return this.contacts.data;
            },
            deleteModalText() {
                try {
                    return 'Do you really want to delete \'' + this.contactToDelete.name_with_title + '\'?';
                } catch (e) {
                    return 'Do you really want to delete this contact?'
                }
            },
            showContactsActions() {
                return this.userCan('crm_contacts.edit') || this.userCan('crm_contacts.delete');
            },
            showPagination() {
                try {
                    return this.contacts.pagination.last_page > 1;
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
                    this.contactToDelete = null;
                }
            },
            checkDelete(contact) {
                this.showDeleteModal = true;
                this.contactToDelete = contact;
            },
            confirmDelete() {
                if (this.isLoadingDelete) {
                    return this.$errorToast('It\'s only possible to delete one contact at a time.');
                }
                this.$inertia.delete(
                    this.$route('admin.crm.contacts.destroy', this.contactToDelete.id),
                    {
                        only: [
                            'flash',
                            'contacts'
                        ]
                    }
                );

                this.contactToDelete = null
                this.showDeleteModal = false;
            },
            onSearchOptionsUpdate: _.debounce(function () {
                if (!this.isInitialised) {
                    this.isInitialised = true;

                    // If there are already search results, don't attempt search
                    if (this.contactsData) {
                        return;
                    }
                }

                Inertia.get(
                    this.$route('admin.crm.contacts.index'),
                    this.editableSearchOptions,
                    {
                        only: ['contacts'],
                        preserveState: true,
                    }
                );
            }, 500),
            setSearchOptions(new_options = {}) {
                let options = {
                    contact_email       : '',
                    contact_first_name  : '',
                    contact_last_name   : '',
                    contact_telephone   : '',
                    per_page            : 15,
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
