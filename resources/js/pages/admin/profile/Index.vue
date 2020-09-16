<template>
    <div class="bg-white max-w-5xl mx-auto py-6 shadow-subtle rounded-lg">
        <h1 class="font-semibold px-6 text-gray-850">
            My Profile
        </h1>

        <div class="block mt-4 px-6 w-full">
            <p>
                <span class="block font-semibold text-gray-500 text-xs">
                    First Name
                </span>
                {{ user.first_name }}
            </p>
            <p class="mt-2">
                <span class="block font-semibold text-gray-500 text-xs">
                    Last Name
                </span>
                {{ user.last_name }}
            </p>
            <p class="mt-2">
                <span class="block font-semibold text-gray-500 text-xs">
                    Email
                </span>
                {{ user.email }}
            </p>
        </div>

    </div>
</template>

<script>

    export default {
        name: "AdminProfileIndex",
        layout: 'admin-layout',
        props: {
            auth: Object
        },
        computed: {
            user() {
                return this.auth.user;
            }
        }
    }
</script>
