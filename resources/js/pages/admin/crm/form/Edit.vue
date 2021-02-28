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
                Edit Form - {{ form.name }}
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
                v-if="userCan('crm_forms.edit')"
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
                    Save Changes
                </span>
            </button>
        </div>

        <!-- Base Form Data -->
        <div class="bg-white py-6 shadow-subtle rounded-lg">
            <div class="block px-6 w-full">
                <input-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('name')"
                    input-autocomplete="form_name"
                    input-id="name"
                    input-name="name"
                    :input-required="true"
                    input-type="text"
                    label-text="Form Name"
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
                    v-model="formData.slug"
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

        <div class="bg-white mt-6 py-6 shadow-subtle rounded-lg">
            <div class="block px-6 w-full">
                <form-field-editor
                    :crm-form-field-types="crmFormFieldTypes"
                    :form-field-settings="formFieldSettings"
                    :is-editing="true"
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
    import InputGroup from "../../../../components/core/forms/InputGroup";
    import FormFieldEditor from "../../../../components/admin/crm/forms/FormFieldEditor";

    export default {
        name: "AdminCrmFormCreate",
        components: {
            ArrayGroup,
            InputGroup,
            FormFieldEditor,
        },
        layout: 'admin-layout',
        props: {
            crmFormFieldTypes: {
                type: Object,
                required: true
            },
            form: {
                type: Object,
                required: true,
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
                formData: {},
            }
        },
        created() {
            this.formData = _.cloneDeep(this.form);
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
                    this.$route('admin.crm.forms.update', this.form.id),
                    this.formData
                );
            }
        }
    }
</script>
