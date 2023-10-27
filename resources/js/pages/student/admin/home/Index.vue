<template>
    <div class="max-w-screen-2xl mx-auto">
        <div
            class="flex flex-row items-center mb-6"
        >
            <h1 class="font-semibold mr-auto text-3xl">
                My Courses
            </h1>
        </div>

        <p
            v-if="!coursesData"
            class="bg-theme-base-subtle mt-8 mx-6 px-6 py-4 rounded text-center text-theme-base-subtle-contrast"
        >
            No results
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

export default {
    name: "StudentAdminHomeIndex",
    components: {
        CourseCard
    },
    layout: 'student-admin-layout',
    props: {
        courses: {
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
