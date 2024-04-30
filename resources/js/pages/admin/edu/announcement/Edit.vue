<template>
    <form
        class="max-w-5xl mx-auto"
        autocomplete="off"
        @submit.prevent="submit"
    >
        <div
            v-if="userCan('announcements.edit')"
            class="flex flex-row items-center mb-6"
        >
            <h1 class="font-medium mr-auto text-lg">
                Edit - <b>{{ announcement.title }}</b>
            </h1>

            <inertia-link
                v-if="userCan('announcements.view')"
                class="
                    button button-default-responsive button-primary-subtle
                    flex flex-row items-center mr-2
                "
                :href="$route('admin.edu.announcements.index')"
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
            <h2>General details</h2>
            <input-group
                class="mt-4"
                :error-message="getPageErrorMessage('title')"
                input-autocomplete="title_name"
                input-id="title"
                input-name="title"
                :input-required="true"
                input-type="text"
                label-text="Title"
                @errorHidden="clearPageErrorMessage('title')"
                v-model="formData.title"
            />

            <div class="mt-4">
                <label>Description</label>
                <wysiwyg-field
                    :input-autofocus="true"
                    v-model="formData.description"
                />
            </div>

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
        </div>

        <div class="bg-white p-6 shadow-subtle rounded-lg mt-4">
            <h2>Communication Channels</h2>
            <div class="grid grid-cols-4 gap-4">
                <checkbox-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('platform')"
                    :input-id="`platform`"
                    :input-name="`platform`"
                    label-text="Show to user on the platform?"
                    @errorHidden="clearPageErrorMessage('platform')"
                    v-model="formData.platform"
                />

                <checkbox-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('email')"
                    :input-id="`email`"
                    :input-name="`email`"
                    label-text="Send to users via Email?"
                    @errorHidden="clearPageErrorMessage('email')"
                    v-model="formData.email"
                />

                <checkbox-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('sms')"
                    :input-id="`sms`"
                    :input-name="`sms`"
                    label-text="Send to users via SMS?"
                    @errorHidden="clearPageErrorMessage('sms')"
                    v-model="formData.sms"
                />
            </div>
        </div>
    </form>
</template>

<script>
    import InputGroup from "../../../../components/core/forms/InputGroup.vue";
    import TextAreaGroup from "../../../../components/core/forms/TextAreaGroup.vue";
    import CheckboxGroup from "../../../../components/core/forms/CheckboxGroup.vue";
    import WysiwygField from "../../../../components/admin/cms/content/content_fields/WysiwygField.vue";
    import SelectGroup from "../../../../components/core/forms/SelectGroup.vue";

    export default {
        name: "AdminEduAnnouncementEdit",
        components: {
            WysiwygField,
            TextAreaGroup,
            InputGroup,
            CheckboxGroup,
            SelectGroup
        },
        layout: 'admin-layout',
        props: {
            'announcement': {
                type: Object,
                required: true,
            },
            'statuses': {
                required: true,
                type: Object|Array,
            },
        },
        data() {
            return {
                formData: {}
            }
        },
        created() {
            this.formData = {
                title: this.announcement.title,
                description: this.announcement.description,
                platform: this.announcement.platform,
                email: this.announcement.email,
                sms: this.announcement.sms,
                status: this.announcement.status,
            };
        },
        methods: {
            submit() {
              this.$inertia.put(
                    this.$route('admin.edu.announcements.update', this.announcement.id),
                    this.formData
                );
            }
        }
    }
</script>
