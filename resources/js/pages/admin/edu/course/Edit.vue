<template>
    <form
        class="max-w-5xl mx-auto"
        autocomplete="off"
        @submit.prevent="submit"
    >
        <div
            v-if="userCan('courses.edit')"
            class="flex flex-row items-center mb-6"
        >
            <h1 class="font-medium mr-auto text-lg">
                Edit - {{ course.name }}
            </h1>

            <inertia-link
                v-if="userCan('courses.view')"
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
                    Save
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
                @input="onNameInput"
                v-model="formData.name"
            />

            <input-group
                class="mt-4"
                :error-message="getPageErrorMessage('slug')"
                input-autocomplete="course_slug"
                input-id="slug"
                input-name="slug"
                :input-required="true"
                input-type="text"
                label-text="Slug"
                @blur="onSlugBlur"
                @errorHidden="clearPageErrorMessage('slug')"
                @input="onSlugInput"
                v-model="formData.slug"
            />

            <input-group
                class="mt-4"
                :error-message="getPageErrorMessage('summary')"
                input-autocomplete="course_summary"
                input-id="summary"
                input-name="summary"
                :input-required="false"
                input-type="text"
                label-text="Summary"
                @errorHidden="clearPageErrorMessage('summary')"
                v-model="formData.summary"
            />

            <input-group
                class="mt-4"
                :error-message="getPageErrorMessage('description')"
                input-autocomplete="course_description"
                input-id="description"
                input-name="description"
                :input-required="false"
                input-type="text"
                label-text="Description"
                @errorHidden="clearPageErrorMessage('description')"
                v-model="formData.description"
            />

            <input-group
                class="mt-4"
                :error-message="getPageErrorMessage('content_length_video')"
                input-autocomplete="course_content_length_video"
                input-id="content_length_video"
                input-name="content_length_video"
                :input-required="false"
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
                :input-required="false"
                input-type="text"
                label-text="Creator ID"
                @errorHidden="clearPageErrorMessage('creator_id')"
                v-model="formData.creator_id"
            />

            <input-group
                class="mt-4"
                :error-message="getPageErrorMessage('banner')"
                input-autocomplete="banner"
                input-id="banner"
                input-name="banner"
                :input-required="false"
                input-type="text"
                label-text="Banner"
                @errorHidden="clearPageErrorMessage('banner')"
                v-model="formData.banner"
            />
        </div>
    </form>
</template>

<script>
    import slugify from "slugify";
    import InputGroup from "../../../../components/core/forms/InputGroup";
    import MenuItemsEditor from "../../../../components/admin/cms/menus/MenuItemsEditor";

    export default {
        name: "AdminEduCourseEdit",
        components: {
            InputGroup,
            MenuItemsEditor,
        },
        layout: 'admin-layout',
        props: {
            'course': {
                type: Object,
                required: true,
            }
        },
        data() {
            return {
                autoUpdateSlug: false,
                formData: {}
            }
        },
        created() {
            this.formData = {
                id:          this.course.id,
                name:        this.course.name,
                slug:        this.course.slug,
                summary:     this.course.summary,
                description: this.course.description,
                status:      this.course.status,
                content_length_video:      this.course.content_length_video,
                creator_id:      this.course.creator_id,
                banner:      this.course.banner,
            };
        },
        methods: {
            onNameInput() {
                if (!this.autoUpdateSlug) {
                    return;
                }

                this.formData.slug = this.slugify(this.formData.name);
                this.computedUrl = this.formData.slug;
            },
            onSlugBlur() {
                this.formData.slug = this.slugify(this.formData.slug)
            },
            onSlugInput() {
                this.autoUpdateSlug = false;
                this.computedUrl = this.formData.slug;
            },
            slugify(value) {
                if (!value || !value.length) {
                    return '';
                }

                return slugify(
                    value, {
                        lower: true,
                    }
                );
            },
            submit() {
              this.$inertia.put(
                    this.$route('admin.edu.courses.update', this.course.id),
                    this.formData
                );
            }
        }
    }
</script>
