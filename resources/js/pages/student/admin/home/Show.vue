<template>
    <div>
        <div
            class="flex flex-row items-center mb-6"
        >
            <h1 class="font-semibold mr-auto text-3xl">
                {{ course.name }}
            </h1>
        </div>

        <p
            v-if="!course"
            class="bg-theme-base-subtle mt-8 mx-6 px-6 py-4 rounded text-center text-theme-base-subtle-contrast"
        >
            No results
        </p>

        <template v-else>
            <div class="grid grid-cols-3 gap-3">
                <div class="bqg ab lx yr adg adt aez afu alo">
                    <div class="max-w-sm">
                        <img :src="course.primary_image" :alt="course.name" class="w-auto square-full"/>
                    </div>
                    <div class="bg-white p-4 shadow-subtle hover:bg-blue-50 text-center lg:text-left">
                        <h2 class="font-semibold text-black-850 pt-2 pb-2 text-lg">
                            {{ course.name.length > 40 ? course.name.substring(0,60) + ' ...':course.name }}
                        </h2>
                        <p class="font-light">
                            {{ course.summary.length > 100 ? course.summary.substring(0,100) + ' ...':course.summary }}
                        </p>
                    </div>
                    <div v-for="section in course.sections">
                        {{ section.title }}
                    </div>
                </div>
            </div>
        </template>

    </div>
</template>

<script>

export default {
    name: "StudentAdminCourseShow",
    layout: 'student-admin-layout',
    props: {
        course: {
            required: true,
            type: Object | Array,
        },
    },
}
</script>
