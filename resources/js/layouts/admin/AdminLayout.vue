<template>
    <main
        class="flex min-h-screen"
    >
        <side-menu/>

        <div class="flex flex-1 flex-col">
            <top-menu />

            <div class="bg-gray-200 flex-1 p-4">
                <slot/>
            </div>
        </div>
    </main>
</template>

<script>

    export default {
        name: "AdminLayout",
    }
</script>
