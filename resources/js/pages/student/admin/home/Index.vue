<template>
    <div>
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
            <div class="grid grid-cols-3 gap-3">
                <div
                    v-for="(item, index) in coursesData"
                    :key="'course-' + item.id + index"
                    class="bqg ab lx yr adg adt aez afu alo"
                >
                    <inertia-link
                        :href="$route('student.admin.view', item.id)"
                        title="View Course"
                    >
                        <div class="max-w-sm">
                            <img :src="item.primary_image" :alt="item.name" class="w-auto square-full"/>
                        </div>
                        <div class="bg-white p-4 shadow-subtle hover:bg-blue-50 text-center lg:text-left">
                            <h2 class="font-semibold text-black-850 pt-2 pb-2 text-lg">
                                {{ item.name.length > 40 ? item.name.substring(0,60) + ' ...':item.name }}
                            </h2>
                            <p class="font-light">
                                {{ item.summary.length > 100 ? item.summary.substring(0,100) + ' ...':item.summary }}
                            </p>
                        </div>
                    </inertia-link>
                </div>
            </div>
        </template>

    </div>
</template>

<script>

import { router } from '@inertiajs/vue2'

export default {
    name: "StudentAdminHomeIndex",
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
