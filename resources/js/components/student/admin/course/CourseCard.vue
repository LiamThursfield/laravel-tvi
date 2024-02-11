<template>
    <inertia-link
        class="flex flex-1 flex-col group relative"
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
                <div class="image-container relative w-full ">
                    <img
                        class="bg-gray-100 h-full object-cover w-full"
                        alt="Course preview image"
                        :src="course.primary_image"
                    />

                    <div class="
                            absolute flex h-full inset-0 items-center justify-center opacity-0 w-full
                            ease-in-out duration-300 transition-opacity
                            group-hover:opacity-100
                        "
                    >
                        <span class="absolute bg-black h-full inset-0 opacity-40 w-full" />
                        <icon-player-play-filled class="h-12 relative text-white w-12"/>
                    </div>
                </div>
            </div>

            <section class="px-6 mt-3">
                <h2
                    class="font-semibold group-hover:underline"
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
                    {{ progress }}% {{ __('messages.complete') }}
                </p>
            </section>

        </article>
    </inertia-link>
</template>

<script>
    import IconPlus from "../../../core/icons/IconPlus.vue";

    export default {
        name: "CourseCard",
        components: {IconPlus},
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
