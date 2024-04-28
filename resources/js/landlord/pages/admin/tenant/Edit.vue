` <template>
    <form
        class="max-w-5xl mx-auto"
        autocomplete="off"
        @submit.prevent="submit"
    >
        <div
            v-if="userCan('tenants.edit')"
            class="flex flex-row items-center mb-6"
        >
            <h1 class="font-medium mr-auto text-lg">
                Edit Tenant
                <span class="ml-2 opacity-75 text-sm">
                    {{ tenant.id }}
                </span>
            </h1>

            <inertia-link
                v-if="userCan('tenants.view')"
                class="
                    button button-default-responsive button-primary-subtle
                    flex flex-row items-center mr-2
                "
                :href="$route('landlord.admin.tenants.index')"
            >
                <icon-chevron-left
                    class="w-5 md:mr-2"
                />
                <span
                    class="hidden md:inline"
                >
                    Back
                </span>
            </inertia-link>

            <button
                class="
                    button button-default-responsive button-primary
                    flex flex-row items-center
                "
                type="submit"
            >
                <icon-save
                    class="
                        w-5
                        md:mr-2
                    "
                />
                <span
                    class="hidden md:inline"
                >
                    Save Changes
                </span>
            </button>
        </div>

        <div class="bg-white py-6 shadow-subtle rounded-lg">
            <div class="block px-6 w-full">
                <input-group
                    :error-message="getPageErrorMessage('id')"
                    input-autocomplete="off"
                    :input-autofocus="true"
                    input-id="id"
                    input-name="id"
                    :input-required="true"
                    input-type="text"
                    label-text="ID"
                    @errorHidden="clearPageErrorMessage('id')"
                    v-model="formData.id"
                />

                <input-group
                    class="mt-4"
                    input-autocomplete="off"
                    :input-disabled="true"
                    input-id="tenancy_db_name"
                    input-name="tenancy_db_name"
                    input-type="text"
                    label-text="DB Name"
                    v-model="tenant.tenancy_db_name"
                />

            </div>
        </div>

        <div class="bg-white mt-6 py-6 shadow-subtle rounded-lg">
            <div class="block px-6 w-full">
                <div class="flex flex-row items-center mb-4">
                    <span class="font-medium text-theme-base-contrast tracking-wider">
                        Domains
                    </span>

                    <button
                        class="button button-primary-subtle button-small ml-auto text-sm"
                        type="button"
                        @click="addDomain"
                    >
                        Add Domain
                    </button>
                </div>

                <p
                    v-if="!tenant.domains.length"
                    class="bg-theme-base-subtle mt-6 px-4 py-3 rounded text-center text-theme-base-subtle-contrast"
                >
                    No domains
                </p>

                <div
                    v-else
                    class="space-y-3"
                >
                    <div
                        v-for="(domain, index) in tenant.domains"
                        :key="`domain-${domain.domain}`"
                    >
                        <div
                            class="border-2 border-theme-base-subtle flex flex-row items-center py-1 rounded"
                        >
                            <span class="font-semibold ml-4 mr-auto">
                                {{ domain.domain}}
                            </span>

                            <!-- TODO:
                            <button
                                class="
                                    flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                                    focus:outline-none focus:ring
                                    hover:bg-theme-info hover:text-theme-info-contrast
                                "
                                title="Edit Menu Item"
                                type="button"
                                @click="editDomain(domain)"
                            >
                                <icon-edit
                                    class="w-4"
                                />
                            </button>
                            -->


                            <button
                                class="
                                    flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                                    focus:outline-none focus:ring
                                    hover:bg-theme-danger hover:text-theme-danger-contrast
                                "
                                title="Delete Menu Item"
                                type="button"
                                @click="checkDomainDelete(index)"
                            >
                                <icon-trash
                                    class="w-4"
                                />
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <generic-modal
            :show-modal="showAddDomainModal"
            @closeModal="closeAddDomainModal"
        >
            <form
                v-if="showAddDomainModal"
                class="mx-6 mb-6"
                autocomplete="off"
                @submit.prevent.stop="submitAddDomain"
            >
                <input-group
                    :error-message="getPageErrorMessage('domain')"
                    input-autocomplete="off"
                    :input-autofocus="true"
                    :input-disabled="isLoadingDomain"
                    input-id="domain"
                    input-name="domain"
                    :input-required="true"
                    input-type="text"
                    label-text="Domain"
                    @errorHidden="clearPageErrorMessage('domain')"
                    v-model="domainData.domain"
                />

               <div class="flex flex-row justify-end">
                   <button
                       class="
                            button button-default-responsive button-primary button-small mt-4
                            flex flex-row items-center
                        "
                       :disabled="isLoadingDomain"
                       type="submit"
                   >
                       Add Domain
                   </button>
               </div>
            </form>
        </generic-modal>

        <confirmation-modal
            confirm-text="Delete"
            confirm-type="danger"
            :show-modal="showDeleteDomainModal"
            :message-text="deleteDomainModalText"
            @cancelAction="cancelDomainDelete"
            @closeModal="cancelDomainDelete"
            @confirmAction="confirmDomainDelete"
        />
    </form>
</template>

<script>
    import InlineCheckboxGroup from "../../../../components/core/forms/InlineCheckboxGroup.vue";
    import InputGroup from "../../../../components/core/forms/InputGroup.vue";
    import ConfirmationModal from "../../../../components/core/modals/ConfirmationModal.vue";
    import GenericModal from "../../../../components/core/modals/GenericModal.vue";
    import {router} from "@inertiajs/vue2";

    export default {
        name: "AdminTenantEdit",
        components: {
            GenericModal,
            ConfirmationModal,
            InlineCheckboxGroup,
            InputGroup,
        },
        layout: 'admin-layout',
        props: {
            tenant: {
                required: true,
                type: Object,
            },
        },
        data() {
            return {
                domainData: null,
                domainIndexToDelete: null,
                formData: null,
                isLoadingDomain: false,
                showAddDomainModal: false,
                showDeleteDomainModal: false,
            }
        },
        computed: {
            deleteDomainModalText() {
                try {
                    return 'Do you really want to delete \'' + this.domainToDelete.domain + '\'?';
                } catch (e) {
                    return 'Do you really want to delete this domain?'
                }
            },
            domainToDelete() {
                try {
                    return this.tenant.domains[this.domainIndexToDelete];
                } catch (e) {
                    return null;
                }
            }
        },
        created() {
            this.formData = {
                id: this.tenant.id,
            };
        },
        methods: {
            addDomain() {
                this.domainData = {
                    domain: ''
                };

                this.showAddDomainModal = true;
            },
            cancelDomainDelete() {
                if (!this.isLoadingDomain) {
                    this.showDeleteDomainModal = false;
                    this.domainIndexToDelete = null;
                }
            },
            checkDomainDelete(index) {
                this.domainIndexToDelete = index;
                this.showDeleteDomainModal = true;
            },
            closeAddDomainModal() {
                if (!this.isLoadingDomain) {
                    this.showAddDomainModal = false;
                }
            },
            confirmDomainDelete() {
                if (this.isLoadingDomain) {
                    return this.$errorToast('It\'s only possible to delete one domain at a time.');
                }

                if (!this.domainToDelete) {
                    return this.$errorToast('Unable to identify domain to delete.');
                }

                axios.delete(
                    this.$route('landlord.admin.api.tenants.domains.destroy', {
                        tenant: this.tenant.id,
                        domain: this.domainToDelete.id
                    }),
                ).then(response => {
                    this.$successToast('Domain successfully deleted.');
                    this.showDeleteDomainModal = false;
                    this.tenant.domains.splice(this.domainIndexToDelete, 1);
                    this.domainIndexToDelete = null;
                }).catch(error => {
                    console.log(error);
                    this.$errorToast('Failed to delete domain.')
                }).finally(() => {
                    this.isLoadingDomain = false;
                });
            },
            submitAddDomain() {
                this.isLoadingDomain = true;

                axios.post(
                    this.$route('landlord.admin.api.tenants.domains.store', this.tenant.id),
                    this.domainData
                ).then(response => {
                    this.tenant.domains.push(response.data.data);
                    this.showAddDomainModal = false;
                    this.$successToast('Successfully added domain: ' + response.data.data.domain);
                }).catch(e => {
                    let message = 'Failed to create domain, please try again';
                    if (e?.response?.data?.message) {
                        message = e.response.data.message;
                    }

                    this.$errorToast(message);
                }).finally(() => {
                    this.isLoadingDomain = false;
                })
            },

            submit() {
                this.$inertia.put(
                    this.$route('landlord.admin.tenants`.update', this.user.id),
                    this.formData
                );
            }
        }
    }
</script>
