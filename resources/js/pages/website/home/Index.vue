<template>
    <div v-if="!isLoading"
        class="bg-gray-100 flex flex-col min-h-screen min-w-screen">
        <nav class="bg-white py-3">
            <div class="container flex flex-row justify-between mx-auto px-4">
                <inertia-link
                    class="font-semibold hover:text-theme-primary-hover"
                    href="/"
                >
                    Home
                </inertia-link>

                <ul class="flex flex-row space-x-4">
                    <template v-if="$page.props.auth.user">
                        <li v-if="userCan('admin.view')">
                            <inertia-link
                                class="hover:text-theme-primary-hover"
                                :href="$route('admin.index')"
                            >
                                Lecturer Admin
                            </inertia-link>
                        </li>
                        <li v-if="userCan('student_admin.view')">
                            <inertia-link
                                class="hover:text-theme-primary-hover"
                                :href="$route('student.admin.index')"
                            >
                                Student Admin
                            </inertia-link>
                        </li>
                    </template>
                    <template v-else>
                        <li v-if="$routeCheck('student.login')">
                            <inertia-link
                                class="hover:text-theme-primary-hover"
                                :href="$route('student.login')"
                            >
                                Student Login
                            </inertia-link>
                        </li>
                        <li v-if="$routeCheck('student.register')">
                            <inertia-link
                                class="hover:text-theme-primary-hover"
                                :href="$route('student.register')"
                            >
                                Student Register
                            </inertia-link>
                        </li>
                    </template>
                </ul>
            </div>
        </nav>

        <!-- Header Section -->
        <section class="container mt-4 mx-auto px-4">
            <h1 class="font-semibold text-xl">
                Welcome to {{ $page.props.tenant.id }}
            </h1>
        </section>

        <!-- Featured Courses Section -->
        <section
            v-if="courses && courses.length"
            class="container mt-4 mx-auto px-4"
        >
            <h1 class="font-semibold text-lg">
                Featured Courses
            </h1>

            <div
                class="
                    grid gap-4 mt-2
                    md:grid-cols-2
                    lg:grid-cols-3
                    xl:grid-cols-4
                "
            >
                <div v-for="course in courses">
                    <inertia-link
                        class="flex flex-1 flex-col group h-full relative"
                        :href="$route('website.edu.courses.show', course.slug)"
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
                                <div class="aspect-ratio-16-9 relative w-full ">
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

                            <section class="pb-3 px-6 mt-3">
                                <h3
                                    class="font-semibold text-sm group-hover:underline"
                                    :title="course.name"
                                >
                                    {{ course.name }}
                                </h3>
                            </section>
                        </article>
                    </inertia-link>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        name: "Index",
        layout: 'home-layout',
        props: {
            courses: {
                type: Array
            }
        },
        data() {
            return {
                isLoading: true
            }
        },
    }
</script>
