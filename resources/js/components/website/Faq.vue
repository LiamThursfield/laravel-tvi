<template>
    <section class="px-4 py-6 shadow-subtle">
        <div class="container max-w-screen-lg mx-auto">
            <div class="flex items-center space-x-4">
                <span class="text-2xl font-bold">{{ __('messages.faq') }}</span>
            </div>

            <div class="prose">
                <p v-html="data" />
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        name: "Faq",
        props: {
            data: {
                required: true,
                type: Object|null,
                default: '',
            }
        },
    }
</script>
