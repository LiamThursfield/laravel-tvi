<template>
    <form
        class="max-w-5xl mx-auto"
        autocomplete="off"
        @submit.prevent="submit"
    >
        <div
            v-if="userCan('courses.create')"
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
                :href="$route('admin.edu.courses.index')"
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
                label-text="Name"
                @errorHidden="clearPageErrorMessage('name')"
                v-model="formData.name"
            />

            <input-group
                class="mt-4"
                :error-message="getPageErrorMessage('summary')"
                input-autocomplete="course_summary"
                input-id="summary"
                input-name="summary"
                :input-required="true"
                input-type="text"
                label-text="Summary"
                @errorHidden="clearPageErrorMessage('summary')"
                v-model="formData.summary"
            />

            <text-area-group
                class="mt-4"
                :error-message="getPageErrorMessage('description')"
                input-id="description"
                input-name="description"
                input-rows="2"
                input-type="text"
                label-text="Describe the course"
                @errorHidden="clearPageErrorMessage('description')"
                v-model="formData.description"
            />

            <input-group
                class="mt-4"
                :error-message="getPageErrorMessage('content_length_video')"
                input-autocomplete="course_content_length_video"
                input-id="content_length_video"
                input-name="content_length_video"
                :input-required="true"
                input-type="text"
                label-text="Total content length in hours"
                @errorHidden="clearPageErrorMessage('content_length_video')"
                v-model="formData.content_length_video"
            />

            <input-group
                class="mt-4"
                :error-message="getPageErrorMessage('creator_id')"
                input-autocomplete="course_creator_id"
                input-id="creator_id"
                input-name="creator_id"
                :input-required="true"
                input-type="text"
                label-text="Creator ID"
                @errorHidden="clearPageErrorMessage('creator_id')"
                v-model="formData.creator_id"
            />

            <input-group
                class="mt-4"
                :error-message="getPageErrorMessage('banner')"
                input-autocomplete="course_banner"
                input-id="banner"
                input-name="banner"
                :input-required="true"
                input-type="text"
                label-text="Banner"
                @errorHidden="clearPageErrorMessage('banner')"
                v-model="formData.banner"
            />

        </div>

    </form>
</template>

<script>
    import InputGroup from "../../../../components/core/forms/InputGroup";
    import MenuItemsEditor from "../../../../components/admin/cms/menus/MenuItemsEditor";
    import TextAreaGroup from "../../../../components/core/forms/TextAreaGroup";

    export default {
        name: "AdminEDUCourseCreate",
        components: {
            TextAreaGroup,
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
                    content_length_video: '',
                    banner: '',
                }
            }
        },
        methods: {
            submit() {
              this.$inertia.post(
                    this.$route('admin.edu.courses.store'),
                    this.formData
                );
            }
        }
    }
</script>
