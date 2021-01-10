<template>
    <section class="max-w-5xl mx-auto">
        <div
            v-if="userCan('profile.edit')"
            class="flex flex-row items-center mb-6"
        >
            <h1 class="font-medium mr-auto text-lg">
                My Profile
            </h1>

            <inertia-link
                class="
                    button button-default-responsive button-primary-subtle
                    flex flex-row items-center
                "
                :href="$route('admin.profile.edit')"
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
                    Edit Profile
                </span>
            </inertia-link>
        </div>

        <div class="bg-white py-6 shadow-subtle rounded-lg">
            <div class="block px-6 w-full">
                <p>
                    <span class="block font-semibold text-theme-base-subtle-contrast text-xs">
                        First Name
                    </span>
                    {{ profile.first_name }}
                </p>
                <p class="mt-2">
                    <span class="block font-semibold text-theme-base-subtle-contrast text-xs">
                        Last Name
                    </span>
                    {{ profile.last_name }}
                </p>
                <p class="mt-2">
                    <span class="block font-semibold text-theme-base-subtle-contrast text-xs">
                        Email
                    </span>
                    {{ profile.email }}
                </p>
            </div>
        </div>
    </section>
</template>

<script>

    export default {
        name: "AdminProfileIndex",
        layout: 'admin-layout',
        props: {
            auth: Object,
            profile: Object,
        }
    }
</script>
