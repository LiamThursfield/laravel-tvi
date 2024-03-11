<template>
    <section
        v-if="isTestimonials"
        class="bg-theme-base-subtle px-4 py-12 text-theme-base-subtle-contrast"
    >
        <div class="container max-w-screen-lg mx-auto">
            <p class="font-bold mb-4 text-lg">
                {{ __('messages.testimonials') }}
            </p>

            <div
                class="
                    grid grid-cols-1 gap-4
                    sm:grid-cols-2
                    lg:grid-cols-3
                "
            >
                <section
                    v-for="(testimonial, index) in testimonials"
                    :key="'testimonial-' + index"
                    class="bg-theme-base mb-3 overflow-hidden px-6 py-12 relative rounded-lg shadow-lg text-theme-base-contrast"
                >
                    <div>
                        <figure>
                            <blockquote class="font-semibold text-center text-lg">
                                <p>“{{ testimonial.testimonial.data }}”</p>
                            </blockquote>
                            <figcaption class="mt-4">
                                <div class="flex items-center justify-center">
                                    {{ testimonial.name.data }}
                                </div>
                            </figcaption>
                        </figure>
                    </div>
                </section>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        name: "Testimonials",
        props: {
            testimonials: {
                type: Object|null,
                default: () => {}
            }
        },
        computed: {
            isTestimonials() {
                try {
                    return this.testimonials.length;
                } catch (e) {
                    return false;
                }
            }
        }
    }
</script>
