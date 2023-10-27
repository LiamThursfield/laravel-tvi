<template>
    <inertia-link
        class="flex flex-1 flex-col relative"
        :href="$route('student.admin.show', course.id)"
        :title="`View course: ${course.name}`"
    >
        <article
            class="
                flex flex-1 flex-col
                bg-white inset-0 overflow-hidden rounded-lg shadow-subtle
                ease-in-out duration-300 transition-colors
                hover:bg-gray-100
            "
        >
            <div>
                <div class="image-container w-full ">
                    <img
                        class="bg-gray-100 h-full object-cover w-full"
                        alt="Course preview image"
                        :src="course.primary_image"
                    />
                </div>
            </div>

            <section class="px-6 mt-3">
                <h2
                    class="font-semibold"
                    :title="course.name"
                >
                    {{ formattedCourseName }}
                </h2>
                <h3 class="opacity-40 text-sm">
                    {{ course.creator.name }}
                </h3>
            </section>

            <section class="flex flex-1 flex-col justify-end mt-4 pb-6 px-6">
                <div class="bg-theme-primary-subtle h-2 rounded-full">
                    <div class="bg-theme-primary h-full rounded-full" :style="`width: ${progress}%`" />
                </div>
                <p class="mt-1 text-xs">
                    {{ progress }}% Complete
                </p>
            </section>

        </article>
    </inertia-link>
</template>

<script>
    export default {
        name: "CourseCard",
        props: {
            course: {
                required: true,
                type: Object,
            }
        },
        computed: {
            formattedCourseName() {
                let maxLength = 40;
                if (this.course.name.length <= maxLength) {
                    return this.course.name;
                }

                return this.course.name.substring(0, maxLength - 3) + '...';
            },
            progress() {
                return Math.floor(Math.random() * 101);
            }
        }
    }
</script>


<style scoped>
    .image-container {
        aspect-ratio: 16/9;
    }
</style>