<template>
    <section class="px-4 py-6 shadow-subtle">
        <div class="container max-w-screen-lg mx-auto">
            <div class="max-w-screen-md">
                <p class="font-bold mb-4 text-2xl">
                    {{ __('messages.about-author') }}
                </p>

                <div class="prose">
                    <p v-html="data" />
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        name: "AboutAuthor",
        props: {
            data: {
                required: true,
                type: Object|null,
                default: '',
            }
        },
    }
</script>
