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
                v-if="userCan('labels.view')"
                class="
                    button button-default-responsive button-primary-subtle
                    flex flex-row items-center mr-2
                "
                :href="$route('admin.edu.labels.index')"
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
                v-if="userCan('labels.create')"
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
                    :error-message="getPageErrorMessage('label')"
                    input-autocomplete="label"
                    input-id="label"
                    input-name="label"
                    :input-required="true"
                    input-type="text"
                    label-text="Label"
                    @errorHidden="clearPageErrorMessage('label')"
                    @input="onNameInput"
                    v-model="formData.label"
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
        name: "AdminEduLabelCreate",
        components: {
            ArrayGroup,
            FormFieldEditor,
            InlineCheckboxGroup,
            InputGroup,
            TextAreaGroup,
        },
        layout: 'admin-layout',
        data() {
            return {
                autoUpdateSlug: true,
                formData: {
                    label: '',
                    slug: '',
                },
            }
        },
        methods: {
            onNameInput() {
                if (!this.autoUpdateSlug) {
                    return;
                }

                this.formData.slug = this.slugify(this.formData.label);
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
                    this.$route('admin.edu.labels.store'),
                    this.formData
                );
            }
        }
    }
</script>
