<template>
    <form
        class="max-w-5xl mx-auto"
        autocomplete="off"
        @submit.prevent="submit"
    >
        <div
            v-if="userCan('labels.edit')"
            class="flex flex-row items-center mb-6"
        >
            <h1 class="font-medium mr-auto text-lg">
                Edit - <b>{{ label.name }}</b>
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
                input-autocomplete="name"
                input-id="name"
                input-name="name"
                :input-required="true"
                input-type="text"
                label-text="Label"
                @errorHidden="clearPageErrorMessage('name')"
                @input="onNameInput"
                v-model="formData.name"
            />
        </div>

    </form>
</template>

<script>
    import slugify from "slugify";
    import InputGroup from "../../../../components/core/forms/InputGroup.vue";

    export default {
        name: "AdminEduLabelUpdate",
        components: {
            InputGroup
        },
        layout: 'admin-layout',
        props: {
            'label': {
                type: Object,
                required: true,
            }
        },
        data() {
            return {
                autoUpdateSlug: true,
                formData: {}
            }
        },
        created() {
            this.formData = {
                id: this.label.id,
                name: this.label.name,
                slug: this.label.slug,
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
                    this.$route('admin.edu.labels.update', this.label.id),
                    this.formData
                );
            }
        }
    }
</script>
