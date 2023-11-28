<template>
    <form
        class="max-w-5xl mx-auto"
        autocomplete="off"
        @submit.prevent="submit"
    >
        <div
            v-if="userCan('webinars.edit')"
            class="flex flex-row items-center mb-6"
        >
            <h1 class="font-medium mr-auto text-lg">
                Edit - <b>{{ webinar.name }}</b>
            </h1>

            <inertia-link
                v-if="userCan('webinars.view')"
                class="
                    button button-default-responsive button-primary-subtle
                    flex flex-row items-center mr-2
                "
                :href="$route('admin.edu.webinars.index')"
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
            <h2>
                General details
            </h2>
            <input-group
                class="mt-4"
                :error-message="getPageErrorMessage('name')"
                input-autocomplete="webinar_name"
                input-id="name"
                input-name="name"
                :input-required="true"
                input-type="text"
                label-text="Name"
                @errorHidden="clearPageErrorMessage('name')"
                @input="onNameInput"
                v-model="formData.name"
            />

            <select-group
                class="mt-4"
                :label-hidden="true"
                label-text="Status"
                :input-any-option-enabled="true"
                input-any-option-label="Status"
                input-class="form-control form-control-short"
                input-id="status"
                input-name="status"
                input-option-label-key="name"
                input-option-value-key="id"
                :input-options="statuses"
                v-model="formData.status"
            />

            <input-group
                class="mt-4"
                :error-message="getPageErrorMessage('summary')"
                input-autocomplete="webinar_summary"
                input-id="summary"
                input-name="summary"
                :input-required="false"
                input-type="text"
                label-text="Summary"
                @errorHidden="clearPageErrorMessage('summary')"
                v-model="formData.summary"
            />

            <div class="mt-4">
                <label>Description</label>
                <wysiwyg-field
                    :input-autofocus="true"
                    v-model="formData.description"
                />
            </div>
        </div>

        <div class="bg-white p-6 shadow-subtle rounded-lg mt-4">
            <h2>Availability details</h2>
            <div class="grid grid-cols-2 gap-2">
                <date-time-picker-group
                    class="mt-4 md:flex-1"
                    :error-message="getPageErrorMessage('date_time_from')"
                    input-id="date_time_from"
                    input-name="date_time_from"
                    label-text="Available From"
                    @errorHidden="clearPageErrorMessage('date_time_from')"
                    v-model="formData.date_time_from"
                />

                <date-time-picker-group
                    class="mt-4 md:flex-1"
                    :error-message="getPageErrorMessage('date_time_to')"
                    input-id="date_time_to"
                    input-name="date_time_to"
                    label-text="Available To"
                    @errorHidden="clearPageErrorMessage('date_time_to')"
                    v-model="formData.date_time_to"
                />
            </div>
        </div>

        <div class="bg-white p-6 shadow-subtle rounded-lg mt-4">
            <h2>More Details</h2>
            <div class="grid grid-cols-2 gap-2">
                <input-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('webinar_url')"
                    input-autocomplete="webinar_url"
                    input-id="webinar_url"
                    input-name="webinar_url"
                    :input-required="false"
                    input-type="text"
                    label-text="Webinar URL"
                    @errorHidden="clearPageErrorMessage('webinar_url')"
                    v-model="formData.webinar_url"
                />

                <input-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('recording_url')"
                    input-autocomplete="recording_url"
                    input-id="recording_url"
                    input-name="recording_url"
                    :input-required="false"
                    input-type="text"
                    label-text="Recording URL"
                    @errorHidden="clearPageErrorMessage('recording_url')"
                    v-model="formData.recording_url"
                />
            </div>
        </div>

        <div class="bg-white p-6 shadow-subtle rounded-lg mt-4">
            <h2>Features</h2>
            <div class="grid grid-cols-4 gap-4">
                <checkbox-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('is_recorded')"
                    :input-id="`is_recorded`"
                    :input-name="`is_recorded`"
                    label-text="Is Recorded?"
                    @errorHidden="clearPageErrorMessage('is_recorded')"
                    v-model="formData.is_recorded"
                />

                <checkbox-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('can_users_reserve')"
                    :input-id="`can_users_reserve`"
                    :input-name="`can_users_reserve`"
                    label-text="Can users reserve access in advance?"
                    @errorHidden="clearPageErrorMessage('can_users_reserve')"
                    v-model="formData.can_users_reserve"
                />
            </div>
        </div>
    </form>
</template>

<script>
    import slugify from "slugify";
    import InputGroup from "../../../../components/core/forms/InputGroup";
    import TextAreaGroup from "../../../../components/core/forms/TextAreaGroup";
    import CheckboxGroup from "../../../../components/core/forms/CheckboxGroup";
    import SelectGroup from "../../../../components/core/forms/SelectGroup";
    import DateTimePickerGroup from "../../../../components/core/forms/DateTimePickerGroup";
    import SectionItemsEditor from "../../../../components/admin/edu/sections/SectionItemsEditor";
    import _ from "lodash";
    import WysiwygField from "../../../../components/admin/cms/content/content_fields/WysiwygField";

    export default {
        name: "AdminEduWebinarEdit",
        components: {
            WysiwygField,
            TextAreaGroup,
            SectionItemsEditor,
            InputGroup,
            CheckboxGroup,
            SelectGroup,
            DateTimePickerGroup,
        },
        layout: 'admin-layout',
        props: {
            'webinar': {
                type: Object,
                required: true,
            },
            'currencies': {
                required: true,
                type: Object|Array,
            },
            'statuses': {
                required: true,
                type: Object|Array,
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
                id: this.webinar.id,
                name: this.webinar.name,
                slug: this.webinar.slug,
                summary: this.webinar.summary,
                description: this.webinar.description,
                status: this.webinar.status,
                available_from: this.webinar.available_from,
                available_to: this.webinar.available_to,
                content_length_video: this.webinar.content_length_video,
                banner: this.webinar.banner,
                primary_image: this.webinar.primary_image,
                video_preview: this.webinar.video_preview,
                price: this.webinar.price,
                discount_price: this.webinar.discount_price,
                currency: this.webinar.currency,
                languages: this.webinar.languages,
                has_webinars: this.webinar.has_webinars,
                has_money_back_guarantee: this.webinar.has_money_back_guarantee,
                has_certificate: this.webinar.has_certificate,
                has_captions: this.webinar.has_captions,
                has_lifetime_access: this.webinar.has_lifetime_access,
                has_student_discount: this.webinar.has_student_discount,
                has_pdfs: this.webinar.has_pdfs,
                has_free_seo_exposure: this.webinar.has_free_seo_exposure,
                sections: this.webinar.sections,
                templateField: { type: 'wysiwyg'}
            };
        },
        methods: {
            transformSections() {
                let sections = this.webinar.sections;

                _.forEach(sections, (section, key) => {
                    _.forEach(section.child_items, (item, key) => {
                        item.child_items = [];
                    });
                });

                this.webinar.sections = sections;
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
                    this.$route('admin.edu.webinars.update', this.webinar.id),
                    this.formData
                );
            }
        }
    }
</script>
