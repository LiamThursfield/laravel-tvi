<template>
    <div class="max-w-screen-2xl mx-auto">
        <div
            v-if="announcements.length">
        <div
            v-for="(announcement, index) in announcements"
            :key="'announcement-' + index + '-' + announcement.slug"
            class="bg-white border-t-4 border-light-500 rounded-b text-teal-900 px-4 py-3 mb-5 shadow-md"
            role="alert"
        >
            <div class="flex">
                <div class="py-1">
                    <svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg>
                </div>
                <div>
                    <p class="font-bold">{{ announcement.title }}</p>
                    <p class="text-sm" v-html="announcement.description"></p>
                </div>
            </div>
        </div>
        </div>

        <div
            class="flex flex-row items-center mb-6"
        >
            <h1 class="font-semibold mr-auto text-3xl">
                {{ __('messages.my-courses') }}
            </h1>
        </div>

        <p
            v-if="!coursesData"
            class="bg-theme-base-subtle mt-8 mx-6 px-6 py-4 rounded text-center text-theme-base-subtle-contrast"
        >
            {{ __('messages.no-results') }}
        </p>

        <template v-else>
            <div class="
                    grid grid-cols-1 gap-3
                    md:grid-cols-2
                    lg:grid-cols-3
                    xl:grid-cols-4
                "
            >
                <course-card
                    v-for="(course, index) in coursesData"
                    :key="index + course.slug"
                    :course="course"
                />
            </div>
        </template>

    </div>
</template>

<script>

import CourseCard from "../../../../components/student/admin/course/CourseCard.vue";
import WysiwygField from "../../../../components/admin/cms/content/content_fields/WysiwygField.vue";

export default {
    name: "StudentAdminHomeIndex",
    components: {
        CourseCard,
        WysiwygField
    },
    layout: 'student-admin-layout',
    props: {
        courses: {
            required: true,
            type: Object | Array,
        },
        announcements: {
            required: true,
            type: Object | Array,
        },
    },
    computed: {
        coursesData() {
            if (!this.courses) {
                return false;
            }

            return this.courses;
        }
    },
}
</script>
