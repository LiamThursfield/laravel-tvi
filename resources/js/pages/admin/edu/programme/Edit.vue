<template>
    <form
        class="max-w-5xl mx-auto"
        autocomplete="off"
        @submit.prevent="submit"
    >
        <div
            v-if="userCan('programmes.edit')"
            class="flex flex-row items-center mb-6"
        >
            <h1 class="font-medium mr-auto text-lg">
                Edit - <b>{{ programme.name }}</b>
            </h1>

            <inertia-link
                v-if="userCan('programmes.view')"
                class="
                    button button-default-responsive button-primary-subtle
                    flex flex-row items-center mr-2
                "
                :href="$route('admin.edu.programmes.index')"
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

            <inertia-link
                v-if="userCan('programme.view')"
                class="
                    button button-default-responsive button-primary-subtle
                    flex flex-row items-center mr-2
                "
                :href="$route('admin.edu.programmes.preview', programme.id)"
            >
                <icon-eye
                    class="w-5 md:mr-2"
                />
                <span
                    class="hidden md:inline"
                >
                    Preview
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
            <h2>General details</h2>
            <input-group
                class="mt-4"
                :error-message="getPageErrorMessage('name')"
                input-autocomplete="programme_name"
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
                input-autocomplete="programme_slug"
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
                input-autocomplete="programme_summary"
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
                input-autocomplete="programme_description"
                input-id="description"
                input-name="description"
                :input-required="false"
                input-type="text"
                label-text="Description"
                @errorHidden="clearPageErrorMessage('description')"
                v-model="formData.description"
            />
        </div>

        <div class="bg-white p-6 shadow-subtle rounded-lg mt-4">
            <h2>Availability details</h2>
            <div class="grid grid-cols-2 gap-2">
                <date-time-picker-group
                    class="mt-4 md:flex-1"
                    :error-message="getPageErrorMessage('available_from')"
                    input-id="available_from"
                    input-name="available_from"
                    label-text="Available From"
                    @errorHidden="clearPageErrorMessage('available_from')"
                    v-model="formData.available_from"
                />

                <date-time-picker-group
                    class="mt-4 md:flex-1"
                    :error-message="getPageErrorMessage('available_to')"
                    input-id="available_to"
                    input-name="available_to"
                    label-text="Available To"
                    @errorHidden="clearPageErrorMessage('available_to')"
                    v-model="formData.available_to"
                />
            </div>
        </div>

        <div class="bg-white p-6 shadow-subtle rounded-lg mt-4">
            <h2>Image & Video details</h2>
            <div class="grid grid-cols-2 gap-2">
                <input-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('content_length_video')"
                    input-autocomplete="programme_content_length_video"
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

                <input-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('primary_image')"
                    input-autocomplete="primary_image"
                    input-id="primary_image"
                    input-name="primary_image"
                    :input-required="false"
                    input-type="text"
                    label-text="Primary Image"
                    @errorHidden="clearPageErrorMessage('primary_image')"
                    v-model="formData.primary_image"
                />

                <input-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('video_preview')"
                    input-autocomplete="video_preview"
                    input-id="video_preview"
                    input-name="video_preview"
                    :input-required="false"
                    input-type="text"
                    label-text="Video Preview"
                    @errorHidden="clearPageErrorMessage('video_preview')"
                    v-model="formData.video_preview"
                />

                <input-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('languages')"
                    input-autocomplete="languages"
                    input-id="languages"
                    input-name="languages"
                    :input-required="false"
                    input-type="text"
                    label-text="The language/s of the content"
                    @errorHidden="clearPageErrorMessage('languages')"
                    v-model="formData.languages"
                />
            </div>
        </div>

        <div class="bg-white p-6 shadow-subtle rounded-lg mt-4">
            <h2>Price details</h2>
            <div class="grid grid-cols-3 gap-3">
                <input-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('price')"
                    input-autocomplete="price"
                    input-id="price"
                    input-name="price"
                    :input-required="false"
                    input-type="text"
                    label-text="Price"
                    @errorHidden="clearPageErrorMessage('price')"
                    v-model="formData.price"
                />

                <input-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('discount_price')"
                    input-autocomplete="discount_price"
                    input-id="discount_price"
                    input-name="discount_price"
                    :input-required="false"
                    input-type="text"
                    label-text="Discount Price"
                    @errorHidden="clearPageErrorMessage('discount_price')"
                    v-model="formData.discount_price"
                />

                <select-group
                    class="mt-4"
                    :label-hidden="true"
                    label-text="Currency"
                    :input-any-option-enabled="true"
                    input-any-option-label="Currency"
                    input-class="form-control form-control-short"
                    input-id="currency"
                    input-name="currency"
                    input-option-label-key="name"
                    input-option-value-key="id"
                    :input-options="currencies"
                    v-model="formData.currency"
                />
            </div>
        </div>

        <div class="bg-white p-6 shadow-subtle rounded-lg mt-4">
            <h2>Features Offered</h2>
            <div class="grid grid-cols-4 gap-4">
                <checkbox-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('has_webinars')"
                    :input-id="`has_webinars`"
                    :input-name="`has_webinars`"
                    label-text="Has Webinars?"
                    @errorHidden="clearPageErrorMessage('has_webinars')"
                    v-model="formData.has_webinars"
                />

                <checkbox-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('has_money_back_guarantee')"
                    :input-id="`has_money_back_guarantee`"
                    :input-name="`has_money_back_guarantee`"
                    label-text="Has Money Back Guarantee?"
                    @errorHidden="clearPageErrorMessage('has_money_back_guarantee')"
                    v-model="formData.has_money_back_guarantee"
                />

                <checkbox-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('has_certificate')"
                    :input-id="`has_certificate`"
                    :input-name="`has_certificate`"
                    label-text="Has Certificate?"
                    @errorHidden="clearPageErrorMessage('has_certificate')"
                    v-model="formData.has_certificate"
                />

                <checkbox-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('has_captions')"
                    :input-id="`has_captions`"
                    :input-name="`has_captions`"
                    label-text="Videos have captions?"
                    @errorHidden="clearPageErrorMessage('has_captions')"
                    v-model="formData.has_captions"
                />

                <checkbox-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('has_lifetime_access')"
                    :input-id="`has_lifetime_access`"
                    :input-name="`has_lifetime_access`"
                    label-text="Has Lifetime Access?"
                    @errorHidden="clearPageErrorMessage('has_lifetime_access')"
                    v-model="formData.has_lifetime_access"
                />

                <checkbox-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('has_student_discount')"
                    :input-id="`has_student_discount`"
                    :input-name="`has_student_discount`"
                    label-text="Has Student Discount?"
                    @errorHidden="clearPageErrorMessage('has_student_discount')"
                    v-model="formData.has_student_discount"
                />

                <checkbox-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('has_pdfs')"
                    :input-id="`has_pdfs`"
                    :input-name="`has_pdfs`"
                    label-text="Has PDFs?"
                    @errorHidden="clearPageErrorMessage('has_pdfs')"
                    v-model="formData.has_pdfs"
                />

                <checkbox-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('has_free_seo_exposure')"
                    :input-id="`has_free_seo_exposure`"
                    :input-name="`has_free_seo_exposure`"
                    label-text="Has Free SEO Exposure?"
                    @errorHidden="clearPageErrorMessage('has_free_seo_exposure')"
                    v-model="formData.has_free_seo_exposure"
                />
            </div>
        </div>

        <div class="bg-white p-6 shadow-subtle rounded-lg mt-4">
            <h2>Courses</h2>
            <div class="grid grid-cols-4 gap-4">
                <select-multiple-group
                    class="mt-4"
                    :label-hidden="true"
                    label-text="Courses"
                    :input-any-option-enabled="true"
                    input-any-option-label="Courses"
                    input-class="form-control form-control-short"
                    input-id="courses"
                    input-name="courses"
                    input-option-label-key="name"
                    input-option-value-key="id"
                    :input-options="courses"
                    v-model="formData.courses"
                />
            </div>
        </div>
    </form>
</template>

<script>
    import slugify from "slugify";
    import InputGroup from "../../../../components/core/forms/InputGroup.vue";
    import TextAreaGroup from "../../../../components/core/forms/TextAreaGroup.vue";
    import CheckboxGroup from "../../../../components/core/forms/CheckboxGroup.vue";
    import SelectGroup from "../../../../components/core/forms/SelectGroup.vue";
    import DateTimePickerGroup from "../../../../components/core/forms/DateTimePickerGroup.vue";
    import SectionItemsEditor from "../../../../components/admin/edu/sections/SectionItemsEditor.vue";
    import _ from "lodash";
    import SelectMultipleGroup from "../../../../components/core/forms/SelectMultipleGroup.vue";

    export default {
        name: "AdminEduProgrammeEdit",
        components: {
            SelectMultipleGroup,
            TextAreaGroup,
            SectionItemsEditor,
            InputGroup,
            CheckboxGroup,
            SelectGroup,
            DateTimePickerGroup,
        },
        layout: 'admin-layout',
        props: {
            'programme': {
                type: Object,
                required: true,
            },
            'currencies': {
                required: true,
                type: Object|Array,
            },
            'courses': {
                required: true,
                type: Object,
            },
        },
        data() {
            return {
                autoUpdateSlug: false,
                formData: {}
            }
        },
        created() {
            this.transformSections();
            this.formData = {
                id: this.programme.id,
                name: this.programme.name,
                slug: this.programme.slug,
                summary: this.programme.summary,
                description: this.programme.description,
                status: this.programme.status,
                available_from: this.programme.available_from,
                available_to: this.programme.available_to,
                content_length_video: this.programme.content_length_video,
                banner: this.programme.banner,
                primary_image: this.programme.primary_image,
                video_preview: this.programme.video_preview,
                price: this.programme.price,
                discount_price: this.programme.discount_price,
                currency: this.programme.currency,
                languages: this.programme.languages,
                has_webinars: this.programme.has_webinars,
                has_money_back_guarantee: this.programme.has_money_back_guarantee,
                has_certificate: this.programme.has_certificate,
                has_captions: this.programme.has_captions,
                has_lifetime_access: this.programme.has_lifetime_access,
                has_student_discount: this.programme.has_student_discount,
                has_pdfs: this.programme.has_pdfs,
                has_free_seo_exposure: this.programme.has_free_seo_exposure,
                courses: this.programme.courses,
            };
        },
        methods: {
            transformSections() {
                let courses = this.programme.courses;

                _.forEach(courses, (course, key) => {
                    _.forEach(course.child_items, (item, key) => {
                        item.child_items = [];
                    });
                });

                this.programme.courses = courses;
            },
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
                    this.$route('admin.edu.programmes.update', this.programme.id),
                    this.formData
                );
            }
        }
    }
</script>
