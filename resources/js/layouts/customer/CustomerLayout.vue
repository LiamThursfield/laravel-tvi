<template>
    <div>
        <main
            id="customer-layout"
        >
            <slot />
        </main>
    </div>
</template>

<script>
    export default {
        name: "CustomerLayout",
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
