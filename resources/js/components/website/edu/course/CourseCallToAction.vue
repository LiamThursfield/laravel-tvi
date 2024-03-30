<template>
    <section
        class="bg-gray-100 px-4 py-12"
        v-if="data.length > 0"
    >
        <div class="container max-w-screen-lg mx-auto">
            <div class="max-w-screen-lg">
                <div class="prose">
                    <p v-html="data" />
                </div>

                <div class="flex flex-row justify-center">
                    <a
                        class="button button-primary flex flex-row justify-center mt-6 text-xl"
                        href="#purchase"
                    >
                        {{ __('messages.sign-up') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        name: "CourseCallToAction",
        props: {
            data: {
                default: '',
                required: false,
                type: String
            },
        },
    }
</script>
