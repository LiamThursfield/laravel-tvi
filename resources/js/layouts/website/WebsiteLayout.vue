<template>
    <main
        id="website-layout"
    >
        <slot />
    </main>
</template>

<script>
    export default {
        name: "WebsiteLayout",
        metaInfo() {
            return {
                title: 'Laravel TVI',
                meta: [
                    {
                        name: 'description',
                        content: 'Laravel TVI - A CMS powered by Laravel, Tailwind, Vue, and Inertia',
                    }
                ]
            }
        },
    }
</script>
