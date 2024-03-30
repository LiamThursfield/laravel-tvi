<template>
    <section class="bg-gray-100 px-4 py-12">
        <div class="container max-w-screen-lg mx-auto">
            <div class="max-w-screen-lg">
                <div class="prose">
                    <p v-html="data" />
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
