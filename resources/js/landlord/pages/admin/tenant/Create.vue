<template>
    <form
        class="max-w-5xl mx-auto"
        autocomplete="off"
        @submit.prevent="submit"
    >
        <div
            v-if="userCan('tenants.create')"
            class="flex flex-row items-center mb-6"
        >
            <h1 class="font-medium mr-auto text-lg">
                Create Tenant
            </h1>

            <inertia-link
                v-if="userCan('tenants.view')"
                class="
                    button button-default-responsive button-primary-subtle
                    flex flex-row items-center mr-2
                "
                :href="$route('landlord.admin.tenants.index')"
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
                :disabled="isLoading"
                type="submit"
            >
                <template v-if="!isLoading">
                    <icon-save class="w-5 md:mr-2" />

                    <span
                        class="hidden md:inline"
                    >
                        Create Tenant
                    </span>
                </template>

                <template v-else>
                    <icon-loader-circle class="animate-spin-slow w-5 md:mr-2" />

                    <span
                        class="hidden md:inline"
                    >
                        Loading... this may take a while
                    </span>
                </template>
            </button>
        </div>

        <div class="bg-white py-6 shadow-subtle rounded-lg">
            <div class="block px-6 w-full">
                <input-group
                    :error-message="getPageErrorMessage('id')"
                    input-autocomplete="id"
                    :input-autofocus="true"
                    input-id="id"
                    input-name="id"
                    :input-required="true"
                    input-type="text"
                    label-text="ID"
                    @errorHidden="clearPageErrorMessage('id')"
                    v-model="formData.id"
                />
            </div>
        </div>
    </form>
</template>

<script>
    import _ from "lodash";
    import InlineCheckboxGroup from "../../../../components/core/forms/InlineCheckboxGroup.vue";
    import InputGroup from "../../../../components/core/forms/InputGroup.vue";

    export default {
        name: "AdminTenantCreate",
        components: {
            InlineCheckboxGroup,
            InputGroup,
        },
        layout: 'admin-layout',
        data() {
            return {
                formData: {
                    id: '',
                },
                isLoading: false,
            }
        },
        methods: {
            submit() {
                if (this.isLoading) {
                    return;
                }

                this.isLoading = true;

                this.$inertia.post(
                    this.$route('landlord.admin.tenants.store'),
                    this.formData
                );
            }
        }
    }
</script>
