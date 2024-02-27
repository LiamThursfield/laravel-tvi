<template>
    <section class="px-4 py-6 shadow-subtle">
        <div class="container max-w-screen-lg mx-auto">
            <div class="flex items-center space-x-4">
                <span class="text-lg font-bold">{{ __('messages.course-content') }}:</span>
            </div>
            <section class="divide-y divide-gray-300 max-w-full mt-6 mb-6 mx-auto px-4 border">
                <ul class="divide-y divide-gray-300 bg-gray-50 rounded-md px-4 py-2 mt-4">
                    <li
                        v-for="section in course.sections"
                        :key="'section-' + section.title"
                        class="py-2"
                    >
                        <button
                            type="button"
                            @click="hideShowSection(section.id)"
                        >
                            <div class="flex items-center space-x-4">
                                <strong>{{ section.title }}</strong>
                                <small class="mr-2 ml-auto">
                                    <span v-if="section.lecture_count">
                                        {{ section.child_items ? section.child_items.length + ' ' +__('messages.lectures') + ' | ':'' }}
                                    </span>
                                    {{ section.content_length ?  section.content_length + ' mins':'' }}
                                </small>
                            </div>
                        </button>

                        <ul
                            class="divide-y divide-gray-300 bg-gray-100 rounded-md px-4 py-2 mt-2"
                            :class="{'hidden ease-in-out duration-300 transition-colors': section.id === sectionToShow  }"
                        >
                            <li
                                v-for="(lecture, index) in section.child_items"
                                :key="'lecture-' + lecture.title"
                                class="p-2 ease-in-out duration-300 transition-colors
                                       focus:outline-none focus:ring focus:ring-primary
                                       hover:bg-theme-base-subtle"
                            >
                                <div class="grid grid-cols-2 space-x-4">
                                        <span class="text-sm font-medium">
                                             {{ index + ' ' + lecture.title }}
                                        </span>
                                    <span class="text-sm font-medium text-right">
                                            {{ lecture.content_length ?  lecture.content_length + ' mins':'' }}
                                        </span>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </section>
        </div>
    </section>
</template>

<script>
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
            }
        },
        methods: {
            hideShowSection(sectionId) {
                this.sectionToShow = sectionId;
            },
        }
    }
</script>
