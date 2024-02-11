<template>
    <section class="max-w-5xl mx-auto">
        <div
            v-if="userCan('profile.edit')"
            class="flex flex-row items-center mb-6"
        >
            <h1 class="font-medium mr-auto text-lg">
                {{ __('messages.my-profile') }}
            </h1>

            <inertia-link
                class="
                    button button-default-responsive button-primary-subtle
                    flex flex-row items-center
                "
                :href="$route('student.admin.profile.edit')"
            >
                <icon-edit
                    class="
                        w-5
                        md:mr-2
                    "
                />
                <span
                    class="hidden md:inline"
                >
                   {{ __('messages.edit-profile') }}
                </span>
            </inertia-link>
        </div>

        <div class="bg-white py-6 shadow-subtle rounded-lg">
            <div class="block px-6 w-full">
                <p>
                    <span class="block font-semibold text-theme-base-subtle-contrast text-xs">
                        {{ __('messages.first-name') }}
                    </span>
                    {{ profile.first_name }}
                </p>
                <p class="mt-2">
                    <span class="block font-semibold text-theme-base-subtle-contrast text-xs">
                       {{ __('messages.last-name') }}
                    </span>
                    {{ profile.last_name }}
                </p>
                <p class="mt-2">
                    <span class="block font-semibold text-theme-base-subtle-contrast text-xs">
                        Email
                    </span>
                    {{ profile.email }}
                </p>

                <button
                    v-if="showRefundButton"
                    class="
                    mt-4
                    button button-default-responsive button-primary-subtle
                    flex flex-row items-center
                "
                    @click="requestRefund"
                >
                    <icon-receipt-refund
                        class="
                        w-5
                        md:mr-2
                    "
                    />
                    <span
                        class="hidden md:inline"
                    >
                    {{ __('messages.request-refund') }}
                </span>
                </button>
            </div>
        </div>
    </section>
</template>

<script>

    export default {
        name: "StudentAdminProfileIndex",
        layout: 'student-admin-layout',
        props: {
            auth: Object,
            profile: Object,
        },
        computed: {
            showRefundButton() {
                // TODO:: Logic to decide if this button should be displayed
                // Length since course purchase
                return true;
            }
        },
        methods: {
            requestRefund() {

            }
        }
    }
</script>
