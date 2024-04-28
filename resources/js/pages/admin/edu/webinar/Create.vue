<template>
    <form
        class="max-w-5xl mx-auto"
        autocomplete="off"
        @submit.prevent="submit"
    >
        <div
            v-if="userCan('webinars.create')"
            class="flex flex-row items-center mb-6"
        >
            <h1 class="font-medium mr-auto text-lg">
                Create
            </h1>

            <inertia-link
                v-if="userCan('webinar.view')"
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
                    Create
                </span>
            </button>
        </div>

        <div class="bg-white p-6 shadow-subtle rounded-lg">
            <h2>
                Course and Section
            </h2>
            <div class="grid grid-cols-2 gap-2">
                <select-group
                    class="mt-4 md:flex-1"
                    :label-hidden="true"
                    label-text="Course"
                    :input-any-option-enabled="true"
                    input-any-option-label="Course"
                    input-class="form-control form-control-short"
                    input-id="course"
                    input-name="course"
                    input-option-label-key="name"
                    input-option-value-key="id"
                    :input-options="courseOptions"
                    v-model="formData.course_id"
                    :input-required="true"
                />
                <select-group
                    class="mt-4 md:flex-1"
                    :label-hidden="true"
                    label-text="Section"
                    :input-any-option-enabled="true"
                    input-any-option-label="Section"
                    input-class="form-control form-control-short"
                    input-id="section"
                    input-name="section"
                    input-option-label-key="name"
                    input-option-value-key="id"
                    :input-options="sectionOptions"
                    v-model="formData.section_id"
                />
            </div>
        </div>

        <div class="bg-white p-6 shadow-subtle rounded-lg mt-4">
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
                v-model="formData.name"
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
    import InputGroup from "../../../../components/core/forms/InputGroup.vue";
    import TextAreaGroup from "../../../../components/core/forms/TextAreaGroup.vue";
    import CheckboxGroup from "../../../../components/core/forms/CheckboxGroup.vue";
    import SelectGroup from "../../../../components/core/forms/SelectGroup.vue";
    import DateTimePickerGroup from "../../../../components/core/forms/DateTimePickerGroup.vue";
    import SectionItemsEditor from "../../../../components/admin/edu/sections/SectionItemsEditor.vue";
    import WysiwygField from "../../../../components/admin/cms/content/content_fields/WysiwygField.vue";
    import _ from "lodash";

    export default {
        name: "AdminEDUWebinarCreate",
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
            courses: {
                required: true,
                type: Object|Array,
            },
        },
        data() {
            return {
                autoUpdateSlug: true,
                formData: {
                    name: '',
                    summary: '',
                    description: '',
                    creator_id: '',
                    course_id: '',
                    section_id: '',
                    status: '',
                    date_time_from: '',
                    date_time_to: '',
                    webinar_url: '',
                    can_users_reserve: '',
                    is_recorded: '',
                    recording_url: '',
                    templateField: { type: 'wysiwyg'}
                },
                sectionOptions: null,
            }
        },
        computed: {
            courseOptions() {
                if (!this.courses.length) {
                    return;
                }

                let courses = {};
                _.forEach(this.courses, course => {
                   courses[course.id] = course.name;
                });

                return courses;
            }
        },
        methods: {
            submit() {
              this.$inertia.post(
                    this.$route('admin.edu.webinars.store'),
                    this.formData
                );
            },
            getSectionOptions() {
                if (!this.courses.length) {
                    return;
                }

                let sections = {};
                _.forEach(this.courses, course => {
                    _.forEach(course.sections, section => {
                        if (section.course_id == this.formData.course_id) {
                            sections[section.id] = section.title;
                        }
                    })
                });

                this.sectionOptions = sections;
            },
        },
        watch: {
            ['formData.course_id'](value) {
                if (null !== value) {
                    this.getSectionOptions();
                }
            }
        },
        }
</script>
