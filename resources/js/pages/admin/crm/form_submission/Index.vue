<template>
    <section>
        <!-- Header -->
        <div
            class="flex flex-row items-center mb-6"
        >
            <h1 class="font-medium mr-auto text-lg">
                Form Submissions
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
                <div class="w-full md:w-1/2">
                    <select-group
                        :label-hidden="true"
                        label-text="Form"
                        :input-any-option-enabled="true"
                        input-any-option-label="Form"
                        input-class="form-control form-control-short"
                        input-id="form_id"
                        input-name="form_id"
                        input-option-label-key="name"
                        input-option-value-key="id"
                        :input-options="forms"
                        v-model="editableSearchOptions.form_id"
                    />
                </div>
            </div>

            <p
                v-if="!formSubmissionsData"
                class="bg-theme-base-subtle mt-8 mx-6 px-6 py-4 rounded text-center text-theme-base-subtle-contrast"
            >
                No form submissions
            </p>

            <template v-else>
                <!-- Search Results -->
                <div class="block mt-8 overflow-x-auto w-full">
                    <table class="table table-hover table-striped w-full">
                        <thead>
                        <tr>
                            <th>Contact</th>
                            <th>Form</th>
                            <th>Submitted At</th>
                            <th v-if="showActions"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr
                            v-for="submission in formSubmissionsData"
                            :key="`template-${submission.id}`"
                        >
                            <td>
                                <div v-if="!submission.contact_id">
                                    -
                                </div>
                                <div v-else-if="!submission.contact.name_with_title" >
                                    {{ submission.contact.email }}
                                </div>
                                <div v-else>
                                    <span>{{ submission.contact.name_with_title}}</span>
                                    <br>
                                    <span class="text-sm text-theme-base-subtle-contrast">
                                        {{ submission.contact.email }}
                                    </span>
                                </div>
                            </td>
                            <td>
                                {{ submission.form.name ? submission.form.name : submission.form_id }}
                            </td>
                            <td>
                                {{ submission.submitted_at | humanFriendlyDateTime }}
                            </td>
                            <td v-if="showActions">
                                <div class="flex flex-row items-center justify-end -mx-1">
                                    <inertia-link
                                        v-if="userCan('crm_form_submissions.view')"
                                        class="
                                            flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                                            focus:outline-none focus:ring
                                            hover:bg-theme-info hover:text-theme-info-contrast
                                        "
                                        :href="$route('admin.crm.form-submissions.show', submission.id)"
                                        title="View Submission"
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
                    <pagination :pagination="formSubmissions.pagination" />
                </div>
            </template>

        </div>
    </section>
</template>

<script>
    import _ from 'lodash';
    import {Inertia} from '@inertiajs/inertia'
    import InputGroup from "../../../../components/core/forms/InputGroup";
    import SelectGroup from "../../../../components/core/forms/SelectGroup";

    export default {
        name: "AdminCrmFormSubmissionIndex",
        components: {
            InputGroup,
            SelectGroup
        },
        layout: 'admin-layout',
        props: {
            searchOptions: {
                required: true,
                type: Object|Array,
            },
            formSubmissions: {
                required: true,
                type: Object,
            },
            forms: {
                required: true,
                type: Object|Array,
            },
        },
        data() {
            return {
                editableSearchOptions: {
                    per_page    : 15,
                    form_id     : '',
                },
                isInitialised: false,
            }
        },
        computed: {
            showPagination() {
                try {
                    return this.formSubmissions.pagination.last_page > 1;
                } catch (e) {
                    return false;
                }
            },
            showActions() {
                return this.userCan('cms_advanced.edit') || this.userCan('cms_advanced.delete');
            },
            formSubmissionsData() {
                if (!this.formSubmissions || !this.formSubmissions.data || this.formSubmissions.data.length < 1) {
                    return false;
                }

                return this.formSubmissions.data;
            }
        },
        mounted() {
            this.setSearchOptions(this.searchOptions);
        },
        methods: {
            onSearchOptionsUpdate: _.debounce(function () {
                if (!this.isInitialised) {
                    this.isInitialised = true;

                    // If there are already search results, don't attempt search
                    if (this.formSubmissionsData) {
                        return;
                    }
                }

                Inertia.get(
                    this.$route('admin.crm.form-submissions.index'),
                    this.editableSearchOptions,
                    {
                        only: ['formSubmissions'],
                        preserveState: true,
                    }
                );
            }, 500),
            setSearchOptions(new_options = {}) {
                let options = {
                    per_page    : 15,
                    form_id     : '',
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
