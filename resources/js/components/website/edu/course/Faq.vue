<template>
    <section
        v-if="isFaqs"
        class="px-4 py-12"
    >
        <div class="container max-w-screen-lg mx-auto">
            <div class="max-w-screen-lg">
                <p class="font-bold mb-2 text-lg">
                    {{ __('messages.faq') }}
                </p>

                <div
                    v-for="(faq, key) in faqs"
                    class="overflow-hidden cursor-pointer"
                    :key="`faq-${key}`"
                >
                    <div
                        class="
                            flex flex-row justify-between mt-2 relative rounded px-4 py-2 z-10
                            ease-in-out duration-300 transition-colors
                            hover:bg-theme-secondary hover:text-theme-secondary-contrast
                        "
                        :class="{
                            'bg-theme-secondary text-theme-secondary-contrast' : toggledFaqs[key],
                            'bg-theme-base text-theme-base-contrast' : !toggledFaqs[key],
                        }"
                        @click="toggleFaq(key)"
                    >
                        <span class="font-semibold">
                            {{ faq.question.data }}
                        </span>
                    </div>
                    <transition
                        name="slide-down"
                    >
                        <p
                            v-if="toggledFaqs[key]"
                            class="flex flex-row justify-between my-1 pl-4 pr-4 py-2 rounded text-theme-base-contrast z-0"
                        >
                            {{ faq.answer.data }}
                        </p>
                    </transition>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import _ from "lodash";

    export default {
        name: "Faq",
        props: {
            faqs: {
                required: true,
                type: Object|null,
                default: () => {},
            }
        },
        data() {
            return {
                toggledFaqs: {},
            }
        },
        computed: {
            isFaqs() {
                try {
                    return this.faqs.length
                } catch (e) {
                    return false;
                }
            }
        },
        mounted() {
            if (this.isFaqs) {
                _.forEach(this.faqs, (faq, index) => {
                    this.$set(this.toggledFaqs, index, false);
                });
            }
        },
        methods: {
            toggleFaq(faqIndex) {
                this.$set(this.toggledFaqs, faqIndex, !this.toggledFaqs[faqIndex]);
            },
        }
    }
</script>
