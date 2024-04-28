<template>
    <section class="px-4 py-12">
        <div class="container max-w-screen-lg mx-auto">
            <div class="max-w-screen-lg">
                <p class="font-bold mb-4 text-lg">
                    {{ __('messages.about-author') }}
                </p>

                <p
                    v-if="name.length"
                    class="font-bold"
                >
                    {{ name }}
                </p>
                <p
                    v-if="bio.length"
                    class="text-justify"
                    :class="{
                        'mt-2': name.length
                    }"
                    v-html="bio"
                 />
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        name: "AboutAuthor",
        props: {
            bio: {
                default: '',
                required: false,
                type: String
            },
            name: {
                default: '',
                required: false,
                type: String
            }
        },
    }
</script>
