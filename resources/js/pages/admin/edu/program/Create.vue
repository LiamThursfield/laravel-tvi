<template>
    <form
        class="max-w-5xl mx-auto"
        autocomplete="off"
        @submit.prevent="submit"
    >
        <div
            v-if="userCan('course.create')"
            class="flex flex-row items-center mb-6"
        >
            <h1 class="font-medium mr-auto text-lg">
                Create
            </h1>

            <inertia-link
                v-if="userCan('course.view')"
                class="
                    button button-default-responsive button-primary-subtle
                    flex flex-row items-center mr-2
                "
                :href="$route('admin.edu.course.index')"
            >
                <icon-chevron-left
                    class="w-5 md:mr-2"
                />
                <span
                    class="hidden md:inline"
                >
                    Back
                </span>
            </inertia-link>

            <button
                class="
                    button button-default-responsive button-primary
                    flex flex-row items-center
                "
                type="submit"
            >
                <icon-save class="w-5 md:mr-2"/>

                <span
                    class="hidden md:inline"
                >
                    Create
                </span>
            </button>
        </div>


        <div class="bg-white p-6 shadow-subtle rounded-lg">
            <input-group
                class="mt-4"
                :error-message="getPageErrorMessage('name')"
                input-autocomplete="course_name"
                input-id="name"
                input-name="name"
                :input-required="true"
                input-type="text"
                label-text="Course Name"
                @errorHidden="clearPageErrorMessage('name')"
                v-model="formData.name"
            />
        </div>

    </form>
</template>

<script>
    import slugify from "slugify";
    import InputGroup from "../../../../components/core/forms/InputGroup";
    import MenuItemsEditor from "../../../../components/admin/cms/menus/MenuItemsEditor";

    export default {
        name: "AdminEDUCourseCreate",
        components: {
            MenuItemsEditor,
            InputGroup,
        },
        layout: 'admin-layout',
        data() {
            return {
                autoUpdateSlug: true,
                formData: {
                    name: '',
                    summary: '',
                    description: '',
                    creator_id: '',
                    status: '',
                    content_length_video: '',
                }
            }
        },
        methods: {
            submit() {
              this.$inertia.post(
                    this.$route('admin.edu.course.store'),
                    this.formData
                );
            }
        }
    }
</script>
