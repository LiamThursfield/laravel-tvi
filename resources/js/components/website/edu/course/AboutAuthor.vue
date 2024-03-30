<template>
    <section class="px-4" style="padding-top: 3rem; padding-bottom: 3rem;">
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
                    :class="{
                        'mt-2': name.length
                    }"
                    v-html="bio"
                    style="text-align: justify;"
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
