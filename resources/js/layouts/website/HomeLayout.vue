<template>
    <div>
        <main
            id="home-layout"
        >
            <slot />
        </main>
    </div>
</template>

<script>
export default {
    name: "HomeLayout",
    metaInfo() {
        return {
            title: 'SIGI',
            meta: [
                {
                    name: 'description',
                    content: 'SIGI - powered by Laravel, Tailwind, Vue, and Inertia',
                }
            ]
        }
    },
}
</script>
