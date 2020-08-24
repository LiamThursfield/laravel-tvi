<template>
    <main
        id="admin-layout"
        class="flex min-h-screen"
    >
        <side-menu
            :url="url()"
        />

        <div class="flex flex-1 flex-col max-w-full">
            <top-menu />

            <div class="bg-theme-base flex-1 p-4">
                <slot/>
            </div>
        </div>
    </main>
</template>

<script>

    export default {
        name: "AdminLayout",
        methods: {
            url() {
                return location.pathname.substr(1)
            },
        }
    }
</script>
