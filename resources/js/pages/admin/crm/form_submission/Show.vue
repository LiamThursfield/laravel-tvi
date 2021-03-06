<template>
    <section class="max-w-5xl mx-auto">
        <div class="flex flex-row items-center mb-6">
            <h1 class="font-medium mr-auto text-lg">
                Form Submission
            </h1>

            <inertia-link
                class="
                    button button-default-responsive button-primary-subtle
                    flex flex-row items-center
                "
                :href="$route('admin.crm.form-submissions.index')"
            >
                <icon-chevron-left
                    class="w-5 md:mr-2"
                />
                <span
                    class="hidden md:inline"
                >
                    All Submissions
                </span>
            </inertia-link>
        </div>

        <div class="bg-white py-6 shadow-subtle rounded-lg">
            <div class="block px-6 w-full">
                <h2 class="font-semibold">
                    Submission Details
                </h2>

                <p class="mt-2">
                    <span class="block font-semibold text-theme-base-subtle-contrast text-xs">
                        Form Name
                    </span>
                    {{ formSubmission.form.name }}
                </p>
                <p class="mt-2">
                    <span class="block font-semibold text-theme-base-subtle-contrast text-xs">
                        Submitted At
                    </span>
                    {{ formSubmission.submitted_at | humanFriendlyDateTime }}
                </p>
            </div>
        </div>

        <div
            v-if="formSubmission.contact"
            class="bg-white mt-6 py-6 shadow-subtle rounded-lg"
        >
            <div class="block px-6 w-full">
                <h2 class="font-semibold">
                    Contact Details

                    <!-- TODO: Replace with contact show when implemented -->
                    <inertia-link
                        v-if="userCan('crm_contacts.edit')"
                        class="text-sm text-theme-base-subtle-contrast"
                        :href="$route('admin.crm.contacts.edit', formSubmission.contact_id)"
                    >
                        (View Contact)
                    </inertia-link>
                </h2>

                <p class="mt-2">
                    <span class="block font-semibold text-theme-base-subtle-contrast text-xs">
                        Name
                    </span>
                    {{ formSubmission.contact.name_with_title ? formSubmission.contact.name_with_title : '-' }}
                </p>
                <p class="mt-2">
                    <span class="block font-semibold text-theme-base-subtle-contrast text-xs">
                        Email
                    </span>
                    {{ formSubmission.contact.email }}
                </p>
            </div>
        </div>

        <div class="bg-white mt-6 py-6 shadow-subtle rounded-lg">
            <div class="block px-6 w-full">
                <h2 class="font-semibold">
                    Form Submission Data
                </h2>

                <p
                    v-for="formField in formSubmission.form.form_fields"
                    :key="`form-field-${formField.slug}`"
                    class="mt-2"
                >
                    <span class="block font-semibold text-theme-base-subtle-contrast text-xs">
                        {{  formField.name }}
                    </span>
                    {{ getFormSubmissionDataField(formField.slug) }}
                </p>
            </div>
        </div>
    </section>
</template>

<script>

    export default {
        name: "AdminCrmFormSubmissionShow",
        layout: 'admin-layout',
        props: {
            formSubmission: {
                required: true,
                type: Object
            }
        },
        methods: {
            getFormSubmissionDataField(slug, defaultValue = '-') {
                try {
                    return this.formSubmission.data[slug];
                } catch (e) {
                    return defaultValue;
                }
            }
        }
    }
</script>
