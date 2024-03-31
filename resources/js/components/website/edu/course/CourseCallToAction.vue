<template>
    <section
        class="bg-gray-100 px-4 py-12"
    >
        <div class="container max-w-screen-lg mx-auto">
            <div class="max-w-screen-lg">
                <div class="flex flex-row justify-center">
                    <a
                        class="button button-primary flex flex-row justify-center mt-6 text-xl"
                        style="border-radius: 50px; width: 250px; animation: example 4.5s infinite;"
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
