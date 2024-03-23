<template>
    <form
        class="max-w-5xl mx-auto"
        autocomplete="off"
        @submit.prevent="submit"
    >
        <div
            v-if="userCan('cms_advanced.edit')"
            class="flex flex-row items-center mb-6"
        >
            <h1 class="font-medium mr-auto text-lg">
                Edit Redirect - {{ redirect.url_from }}
            </h1>

            <inertia-link
                v-if="userCan('cms_advanced.view')"
                class="
                    button button-default-responsive button-primary-subtle
                    flex flex-row items-center mr-2
                "
                :href="$route('admin.cms.redirects.index')"
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
                    Save Changes
                </span>
            </button>
        </div>

        <div class="bg-white py-6 shadow-subtle rounded-lg">
            <div class="block px-6 w-full">
                <input-group
                    :error-message="getPageErrorMessage('url_from')"
                    input-autocomplete="url_from"
                    input-id="url_from"
                    input-name="url_from"
                    :input-required="true"
                    input-type="text"
                    label-text="URL From"
                    v-model="formData.url_from"
                    @errorHidden="clearPageErrorMessage('url_from')"
                />

                <input-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('url_to')"
                    input-autocomplete="url_to"
                    input-id="url_to"
                    input-name="url_to"
                    :input-required="true"
                    input-type="text"
                    label-text="URL To"
                    v-model="formData.url_to"
                    @errorHidden="clearPageErrorMessage('url_to')"
                />

                <p class="mt-4 text-sm">Note: URL's should begin with '/'</p>
            </div>
        </div>

        <div class="bg-white mt-6 py-6 shadow-subtle rounded-lg">
            <div class="block px-6 w-full">
                <checkbox-group
                    :error-message="getPageErrorMessage('is_enabled')"
                    input-id="is_enabled"
                    input-name="is_enabled"
                    label-text="Enabled?"
                    v-model="formData.is_enabled"
                    @errorHidden="clearPageErrorMessage('is_enabled')"
                />

                <checkbox-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('is_permanent1')"
                    input-id="is_permanent"
                    input-name="is_permanent"
                    label-text="Permanent?"
                    v-model="formData.is_permanent"
                    @errorHidden="clearPageErrorMessage('is_permanent')"
                />

                <date-time-picker-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('published_at')"
                    input-id="published_at"
                    input-name="published_at"
                    label-text="Publish Date"
                    v-model="formData.published_at"
                    @errorHidden="clearPageErrorMessage('published_at')"
                />

                <date-time-picker-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('expired_at')"
                    input-id="expired_at"
                    input-name="expired_at"
                    label-text="Expiry Date"
                    v-model="formData.expired_at"
                    @errorHidden="clearPageErrorMessage('expired_at')"
                />
            </div>
        </div>
    </form>
</template>
<script>
    import CheckboxGroup from "../../../../components/core/forms/CheckboxGroup.vue";
    import DateTimePickerGroup from "../../../../components/core/forms/DateTimePickerGroup.vue";
    import InputGroup from "../../../../components/core/forms/InputGroup.vue";
    import _ from "lodash";

    export default {
        name: "AdminCmsRedirectEdit",
        components: {
            CheckboxGroup,
            DateTimePickerGroup,
            InputGroup
        },
        layout: 'admin-layout',
        props: {
            redirect : {
                type: Object,
                required: true,
            }
        },
        data() {
            return {
                formData: {}
            }
        },
        created() {
            this.formData = _.cloneDeep(this.redirect);
        },
        methods: {
            submit() {
                this.$inertia.put(
                    this.$route('admin.cms.redirects.update', this.redirect.id),
                    this.formData
                );
            }
        }
    }
</script>
