<template>
    <section
        v-if="sections"
        class="px-4 py-12"
    >
        <div class="container max-w-screen-lg mx-auto">
            <div class="max-w-screen-md">
                <p class="font-bold mb-4 text-lg">
                    {{ __('messages.course-content') }}:
                </p>

                <div
                    v-for="section in sections"
                    class="overflow-hidden cursor-pointer"
                    :key="`section-${section.id}`"
                >
                    <div
                        class="
                            flex flex-row justify-between relative rounded px-4 py-2 z-10
                            ease-in-out duration-300 transition-colors
                        "
                        :class="{
                            'hover:bg-theme-base-contrast hover:text-theme-base' : sectionHasChildren(section),
                            'bg-theme-base-contrast text-theme-base' : (sectionHasChildren(section) && toggledSections[section.index]),
                            'bg-theme-base text-theme-base-contrast' : !toggledSections[section.index],
                        }"
                        @click="toggleSection(section.index)"
                    >
                        <span class="font-semibold">
                            {{ parseInt(section.index) + 1 }}. {{ section.title }}
                        </span>
                        <span v-if="section.content_length">
                            {{ section.content_length + ' mins' }}
                        </span>
                    </div>
                    <transition
                        name="slide-down"
                    >
                        <ul
                            v-if="toggledSections[section.index] && sectionHasChildren(section)"
                            class="my-1"
                        >
                            <li
                                v-for="lecture in section.child_items"
                                :key="`section-${section.index}-lecture-${lecture.index}`"
                                class="
                                    bg-theme-base flex flex-row justify-between pl-8 pr-4 py-2 rounded text-sm text-theme-base-contrast z-0
                                    ease-in-out duration-300 transition-colors
                                    hover:bg-theme-base-subtle hover:text-theme-base-subtle-contrast
                                "
                            >
                                <span>
                                    {{ parseInt(lecture.index) + 1 }}. {{ lecture.title }}
                                </span>
                                <span v-if="lecture.content_length">
                                    {{ lecture.content_length + ' mins' }}
                                </span>
                            </li>
                        </ul>
                    </transition>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import _ from "lodash";

    export default {
        name: "CourseContent",
        props: {
            course: {
                required: true,
                type: Object,
            }
        },
        data() {
            return {
                sectionToShow: false,
                toggledSections: {},
            }
        },
        computed: {
            sections() {
                try {
                    if (!this.course.sections.length) {
                        return false;
                    }

                    return _.cloneDeep(this.course.sections);
                } catch (e) {
                    return false;
                }
            }
        },
        mounted() {
            _.forEach(this.sections, (section) => {
                this.$set(this.toggledSections, section.index, false);
            });
        },
        methods: {
            toggleSection(sectionIndex) {
                this.$set(this.toggledSections, sectionIndex, !this.toggledSections[sectionIndex]);
            },
            sectionHasChildren(section) {
                try {
                    return section.child_items.length
                } catch (e) {
                    return false;
                }
            }
        }
    }
</script>
