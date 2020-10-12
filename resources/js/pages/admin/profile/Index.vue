<template>
    <div class="bg-white max-w-5xl mx-auto py-6 shadow-subtle rounded-lg">
        <h1 class="font-semibold px-6 text-gray-850">
            My Profile
        </h1>

        <div class="block mt-4 px-6 w-full">
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
