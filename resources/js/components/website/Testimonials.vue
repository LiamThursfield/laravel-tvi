<template>
    <section class="px-4 py-6 shadow-subtle">
        <div class="container max-w-screen-lg mx-auto">
            <div class="flex items-center space-x-4">
                <span class="text-2xl font-bold">{{ __('messages.testimonials') }}</span>
            </div>

            <section
                v-for="(item, index) in data"
                :key="'testimonial-' + index"
                class="relative isolate overflow-hidden bg-white px-6 py-14 sm:py-32 lg:py-8 lg:px-8 shadow-lg mb-3"
            >
                <div class="mx-auto max-w-2xl lg:max-w-4xl">
                    <figure class="mt-10">
                        <blockquote class="text-center text-xl font-semibold leading-8 text-gray-900 sm:text-xl sm:leading-9">
                            <p>“{{ item.review }}”</p>
                        </blockquote>
                        <figcaption class="mt-10">
                            <div class="mt-4 flex items-center justify-center space-x-3 text-base">
                                <div class="font-semibold text-gray-900">{{ item.name }}</div>
                            </div>
                        </figcaption>
                    </figure>
                </div>
            </section>
        </div>
    </section>
</template>

<script>
    export default {
        name: "Testimonials",
        data() {
            return {
                data: [
                    {
                        'review': 'Este super! Aurel te ajuta pas cu pas sa treci de atacurile de panica.',
                        'name': 'Doru',
                    },
                    {
                        'review': 'Aurel te ajuta pas cu pas sa treci de atacurile de panica.',
                        'name': 'Axel',
                    },
                ],
            }
        }
    }
</script>
