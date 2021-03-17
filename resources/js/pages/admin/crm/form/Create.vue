<template>
    <form
        class="max-w-5xl mx-auto"
        autocomplete="off"
        @submit.prevent="submit"
    >
        <!-- Header -->
        <div
            class="flex flex-row items-center mb-6"
        >
            <h1 class="font-medium mr-auto text-lg">
                Create Form
            </h1>

            <inertia-link
                v-if="userCan('crm_forms.view')"
                class="
                    button button-default-responsive button-primary-subtle
                    flex flex-row items-center mr-2
                "
                :href="$route('admin.crm.forms.index')"
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
                v-if="userCan('crm_forms.create')"
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
                    Create Form
                </span>
            </button>
        </div>

        <!-- Base Form Data -->
        <div class="bg-white py-6 shadow-subtle rounded-lg">
            <div class="block px-6 w-full">
                <input-group
                    :error-message="getPageErrorMessage('name')"
                    input-autocomplete="form_name"
                    input-id="name"
                    input-name="name"
                    :input-required="true"
                    input-type="text"
                    label-text="Form Name"
                    @errorHidden="clearPageErrorMessage('name')"
                    @input="onNameInput"
                    v-model="formData.name"
                />

                <input-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('slug')"
                    input-autocomplete="form_slug"
                    input-id="slug"
                    input-name="slug"
                    :input-required="true"
                    input-type="text"
                    label-text="Form Slug"
                    @blur="onSlugBlur"
                    @errorHidden="clearPageErrorMessage('slug')"
                    @input="onSlugInput"
                    v-model="formData.slug"
                />

                <text-area-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('success_message')"
                    input-id="success_message"
                    input-name="success_message"
                    input-rows="2"
                    input-type="text"
                    label-text="Success Message"
                    @errorHidden="clearPageErrorMessage('success_message')"
                    v-model="formData.success_message"
                />

                <input-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('redirect_url')"
                    input-id="redirect_url"
                    input-name="redirect_url"
                    input-type="text"
                    label-text="Redirect Url (Leave blank for no redirect)"
                    @errorHidden="clearPageErrorMessage('redirect_url')"
                    v-model="formData.redirect_url"
                />

                <array-group
                    class="mt-4"
                    :error-message="getPageErrorMessageFromArrayField('email_recipients')"
                    input-id="email_recipients"
                    input-name="email_recipients"
                    label-text="Email Recipients"
                    v-model="formData.email_recipients"
                />
            </div>
        </div>

        <!-- Marketing Preferences -->
        <div class="bg-white mt-6 py-6 shadow-subtle rounded-lg">
            <div class="block px-6 w-full">
                <p class="font-medium mb-4 text-theme-base-contrast tracking-wider">
                    Marketing Preference Fields
                </p>

                <div class="space-y-4">
                    <inline-checkbox-group
                        input-id="marketing-email"
                        input-name="marketing-email"
                        label-text="Email"
                        v-model="formData.marketing_email"
                    />

                    <inline-checkbox-group
                        input-id="marketing-sms"
                        input-name="marketing-sms"
                        label-text="SMS"
                        v-model="formData.marketing_sms"
                    />

                    <inline-checkbox-group
                        input-id="marketing-telephone"
                        input-name="marketing-telephone"
                        label-text="Telephone"
                        v-model="formData.marketing_telephone"
                    />
                </div>
            </div>
        </div>

        <!-- Form Fields -->
        <div class="bg-white mt-6 py-6 shadow-subtle rounded-lg">
            <div class="block px-6 w-full">
                <form-field-editor
                    :crm-form-field-types="crmFormFieldTypes"
                    :form-field-settings="formFieldSettings"
                    :standard-form-field-types="standardFormFieldTypes"
                    v-model="formData.form_fields"
                />
            </div>
        </div>

    </form>
</template>

<script>
    import slugify from 'slugify';
    import ArrayGroup from "../../../../components/core/forms/ArrayGroup.";
    import FormFieldEditor from "../../../../components/admin/crm/forms/FormFieldEditor";
    import InlineCheckboxGroup from "../../../../components/core/forms/InlineCheckboxGroup";
    import InputGroup from "../../../../components/core/forms/InputGroup";
    import TextAreaGroup from "../../../../components/core/forms/TextAreaGroup";

    export default {
        name: "AdminCrmFormCreate",
        components: {
            ArrayGroup,
            FormFieldEditor,
            InlineCheckboxGroup,
            InputGroup,
            TextAreaGroup,
        },
        layout: 'admin-layout',
        props: {
            crmFormFieldTypes: {
                type: Object,
                required: true
            },
            formFieldSettings: {
                type: Object,
                required: true
            },
            standardFormFieldTypes: {
                type: Object,
                required: true
            },
        },
        data() {
            return {
                autoUpdateSlug: true,
                formData: {
                    email_recipients: [],
                    form_fields: [],
                    marketing_email: false,
                    marketing_sms: false,
                    marketing_telephone: false,
                    name: '',
                    redirect_url: '',
                    slug: '',
                    success_message: '',
                },
            }
        },
        methods: {
            onNameInput() {
                if (!this.autoUpdateSlug) {
                    return;
                }

                this.formData.slug = this.slugify(this.formData.name);
            },
            onSlugBlur() {
                this.formData.slug = this.slugify(this.formData.slug)
            },
            onSlugInput() {
                this.autoUpdateSlug = false;
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
                this.$inertia.post(
                    this.$route('admin.crm.forms.store'),
                    this.formData
                );
            }
        }
    }
</script>
