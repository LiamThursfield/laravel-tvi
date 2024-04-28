<template>
    <form
        class="max-w-5xl mx-auto"
        autocomplete="off"
        @submit.prevent="submit"
    >
        <!-- Header -->
        <div
            v-if="userCan('crm_orgamisation_units.create')"
            class="flex flex-row items-center mb-6"
        >
            <h1 class="font-medium mr-auto text-lg">
                Create Organisation Unit
            </h1>

            <inertia-link
                v-if="userCan('crm_orgamisation_units.view')"
                class="
                    button button-default-responsive button-primary-subtle
                    flex flex-row items-center mr-2
                "
                :href="$route('admin.crm.organisation-units.index')"
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
                    Create Organisation Unit
                </span>
            </button>
        </div>

        <!-- Type/Parent Details -->
        <div class="bg-white py-6 shadow-subtle rounded-lg">
            <div class="block px-6 w-full">
                <select-group
                    :error-message="getPageErrorMessage('type')"
                    :input-any-option-enabled="true"
                    input-any-option-label="Please select a type"
                    :input-autofocus="true"
                    input-id="type"
                    input-name="Type"
                    :input-options="types"
                    :input-required="true"
                    label-text="Type"
                    @errorHidden="clearPageErrorMessage('type')"
                    @input="onTypeInput"
                    v-model="formData.type"
                />

                <select-group
                    v-if="showCompanySelect"
                    class="mt-4"
                    :error-message="getPageErrorMessage('company_id')"
                    :input-any-option-enabled="true"
                    :input-any-option-label="isLoadingCompanies ? 'Loading...' : 'Please select a company'"
                    :input-any-option-value="null"
                    :input-disabled="isLoadingCompanies || !companies || !companies.length"
                    input-id="company_id"
                    input-name="company_id"
                    :input-option-force-formatting="true"
                    input-option-label-key="name"
                    input-option-value-key="id"
                    :input-options="companies"
                    :input-required="true"
                    label-text="Company"
                    @errorHidden="clearPageErrorMessage('company_id')"
                    @input="onCompanyInput"
                    v-model="formData.company_id"
                />

                <select-group
                    v-if="showLocationSelect"
                    class="mt-4"
                    :error-message="getPageErrorMessage('location_id')"
                    :input-any-option-enabled="true"
                    :input-any-option-label="isLoadingLocations ? 'Loading...' : 'Please select a location'"
                    :input-any-option-value="null"
                    :input-disabled="isLoadingLocations || !locations || !locations.length"
                    input-id="location_id"
                    input-name="location_id"
                    :input-option-force-formatting="true"
                    input-option-label-key="name"
                    input-option-value-key="id"
                    :input-options="locations"
                    :input-required="true"
                    label-text="Location"
                    @errorHidden="clearPageErrorMessage('location_id')"
                    @input="onLocationInput"
                    v-model="formData.location_id"
                />

            </div>
        </div>

        <!-- Contact Details -->
        <div class="bg-white mt-6 py-6 shadow-subtle rounded-lg">
            <div class="block px-6 w-full">
                <span class="text-lg">Contact Details</span>

                <input-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('name')"
                    input-autocomplete="name"
                    input-id="name"
                    input-name="name"
                    :input-required="true"
                    input-type="text"
                    label-text="Name"
                    @errorHidden="clearPageErrorMessage('name')"
                    @input="onNameInput"
                    v-model="formData.name"
                />

                <input-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('slug')"
                    input-autocomplete="slug"
                    input-id="slug"
                    input-name="slug"
                    :input-required="true"
                    input-type="text"
                    label-text="Slug"
                    @blur="onSlugBlur"
                    @errorHidden="clearPageErrorMessage('slug')"
                    @input="onSlugInput"
                    v-model="formData.slug"
                />

                <input-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('email')"
                    input-autocomplete="organisation_unit_email"
                    input-id="email"
                    input-name="email"
                    :input-required="true"
                    input-type="email"
                    label-text="Email"
                    @errorHidden="clearPageErrorMessage('email')"
                    v-model="formData.email"
                />

                <input-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('telephone')"
                    input-autocomplete="organisation_unit_telephone"
                    input-id="telephone"
                    input-name="telephone"
                    input-type="text"
                    label-text="Telephone"
                    @errorHidden="clearPageErrorMessage('telephone')"
                    v-model="formData.telephone"
                />
            </div>
        </div>

        <!-- Socials -->
        <div class="bg-white mt-6 py-6 shadow-subtle rounded-lg">
            <div class="block px-6 w-full">
                <span class="text-lg">Socials</span>

                <div class="flex flex-col md:flex-row md:space-x-4">
                    <input-group
                        class="mt-4 md:flex-1"
                        :error-message="getPageErrorMessage('socials.youtube')"
                        input-autocomplete="youtube_account"
                        input-id="youtube_account"
                        input-name="youtube_account"
                        :input-required="false"
                        input-type="text"
                        label-text="Youtube"
                        @errorHidden="clearPageErrorMessage('socials.youtube')"
                        v-model="formData.socials.youtube"
                    />
                </div>

                <div class="flex flex-col md:flex-row md:space-x-4">
                    <input-group
                        class="mt-4 md:flex-1"
                        :error-message="getPageErrorMessage('socials.facebook')"
                        input-autocomplete="facebook_account"
                        input-id="facebook_account"
                        input-name="facebook_account"
                        :input-required="false"
                        input-type="text"
                        label-text="Facebook"
                        @errorHidden="clearPageErrorMessage('socials.facebook')"
                        v-model="formData.socials.facebook"
                    />

                    <input-group
                        class="mt-4 md:flex-1"
                        :error-message="getPageErrorMessage('socials.instagram')"
                        input-autocomplete="instagram_account"
                        input-id="instagram_account"
                        input-name="instagram_account"
                        :input-required="false"
                        input-type="text"
                        label-text="Instagram"
                        @errorHidden="clearPageErrorMessage('socials.instagram')"
                        v-model="formData.socials.instagram"
                    />
                </div>

                <div class="flex flex-col md:flex-row md:space-x-4">
                    <input-group
                        class="mt-4 md:flex-1"
                        :error-message="getPageErrorMessage('socials.linkedin')"
                        input-autocomplete="linkedin_account"
                        input-id="linkedin_account"
                        input-name="linkedin_account"
                        :input-required="false"
                        input-type="text"
                        label-text="Linkedin"
                        @errorHidden="clearPageErrorMessage('socials.linkedin')"
                        v-model="formData.socials.linkedin"
                    />

                    <input-group
                        class="mt-4 md:flex-1"
                        :error-message="getPageErrorMessage('socials.snapchat')"
                        input-autocomplete="snapchat_account"
                        input-id="snapchat_account"
                        input-name="snapchat_account"
                        :input-required="false"
                        input-type="text"
                        label-text="Snapchat"
                        @errorHidden="clearPageErrorMessage('socials.snapchat')"
                        v-model="formData.socials.snapchat"
                    />
                </div>

                <div class="flex flex-col md:flex-row md:space-x-4">
                    <input-group
                        class="mt-4 md:flex-1"
                        :error-message="getPageErrorMessage('socials.tiktok')"
                        input-autocomplete="tiktok_account"
                        input-id="tiktok_account"
                        input-name="tiktok_account"
                        :input-required="false"
                        input-type="text"
                        label-text="TikTok"
                        @errorHidden="clearPageErrorMessage('socials.tiktok')"
                        v-model="formData.socials.tiktok"
                    />

                    <input-group
                        class="mt-4 md:flex-1"
                        :error-message="getPageErrorMessage('socials.twitter')"
                        input-autocomplete="twitter_account"
                        input-id="twitter_account"
                        input-name="twitter_account"
                        :input-required="false"
                        input-type="text"
                        label-text="Twitter/X"
                        @errorHidden="clearPageErrorMessage('socials.twitter')"
                        v-model="formData.socials.twitter"
                    />
                </div>
            </div>
        </div>

        <!-- Notifications -->
        <!-- TODO: -->

        <!-- Address -->
        <!-- TODO: -->
    </form>
</template>

<script>
    import slugify from "slugify";
    import InputGroup from "../../../../components/core/forms/InputGroup.vue";
    import SelectGroup from "../../../../components/core/forms/SelectGroup.vue";

    let CancelToken = axios.CancelToken;
    let companiesCancelToken = CancelToken.source();
    let locationsCancelToken = CancelToken.source();

    export default {
        name: "AdminCrmOrganisationUnitCreate",
        components: {
            InputGroup,
            SelectGroup,
        },
        layout: 'admin-layout',
        props: {
            types: {
                type: Object,
                required: true,
            }
        },
        data() {
            return {
                autoUpdateSlug: true,
                companies: [],
                formData: {
                    company_id: '',
                    email: '',
                    location_id: '',
                    name: '',
                    notification_emails: [],
                    parent_id: null,
                    slug: '',
                    socials: {
                        facebook: '',
                        instagram: '',
                        linkedin: '',
                        snapchat: '',
                        tiktok: '',
                        twitter: '',
                        youtube: '',
                    },
                    telephone: '',
                    type: '',
                },
                isLoadingCompanies: false,
                isLoadingLocations: false,
                locations: [],
                selected_company_id: null,
                selected_location_id: null,
            }
        },
        computed: {
            showCompanySelect() {
                let allowed_types = [
                    'location',
                    'department',
                ]

                return allowed_types.indexOf(this.formData.type) > -1;
            },

            showLocationSelect() {
                return this.formData.type === 'department';
            },
        },
        methods: {
            loadCompanies() {
                if (this.isLoadingCompanies) {
                    companiesCancelToken.cancel('Companies load cancelled');
                    companiesCancelToken = CancelToken.source();
                }

                this.isLoadingCompanies = true;

                axios.get(
                    this.$route('admin.api.crm.organisation-units.index'),
                    {
                        params: {
                            organisation_unit_type: 'company',
                        }
                    }
                ).then(response => {
                    this.companies = response.data.data
                }).catch(e => {
                    if (!axios.isCancel(e)) {
                        this.$errorToast('Failed to load companies');
                    }
                }).finally(() => {
                    this.isLoadingCompanies = false;
                });
            },
            loadLocations() {
                if (this.isLoadingLocations) {
                    locationsCancelToken.cancel('Locations load cancelled');
                    locationsCancelToken = CancelToken.source();
                }

                this.isLoadingLocations = true;

                axios.get(
                    this.$route('admin.api.crm.organisation-units.index'),
                    {
                        params: {
                            organisation_unit_type: 'location',
                            organisation_unit_company_id: this.formData.company_id,
                        }
                    }
                ).then(response => {
                    this.locations = response.data.data
                }).catch(e => {
                    if (!axios.isCancel(e)) {
                        this.$errorToast('Failed to load locations');
                    }
                }).finally(() => {
                    this.isLoadingLocations = false;
                });
            },
            onCompanyInput() {
                console.log('onCompanyInput', this.formData.company_id);
                this.locations = [];
                this.formData.location_id = null;

                if (this.showLocationSelect) {
                    this.formData.parent_id = null;
                    this.loadLocations();
                } else if (this.formData.company_id) {
                    this.formData.parent_id = this.formData.company_id;
                }
            },
            onLocationInput() {
                if (this.formData.location_id) {
                    this.formData.parent_id = this.formData.location_id;
                } else {
                    this.formData.parent_id = null;
                }
            },
            onNameInput() {
                if (!this.autoUpdateSlug) {
                    return;
                }

                this.formData.slug = this.slugify(this.formData.name);
            },
            onSlugBlur() {
                this.formData.slug = this.slugify(this.formData.slug)
            },
            onSlugInput() {
                this.autoUpdateSlug = false;
            },
            onTypeInput() {
                this.companies = [];
                this.locations = [];

                this.formData.company_id = null;
                this.formData.location_id = null;
                this.formData.parent_id = null;

                if (this.showCompanySelect) {
                    this.loadCompanies();
                }
            },
            slugify(value) {
                if (!value || !value.length) {
                    return '';
                }

                return slugify(
                    value, {
                        lower: true,
                    }
                );
            },
            submit() {
                this.$inertia.post(
                    this.$route('admin.crm.organisation-units.store'),
                    this.formData
                );
            }
        }
    }
</script>
