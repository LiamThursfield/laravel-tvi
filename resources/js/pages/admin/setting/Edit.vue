<template>
    <form
        class="max-w-5xl mx-auto"
        autocomplete="off"
        @submit.prevent="submit"
    >
        <div
            v-if="userCan('settings.edit')"
            class="flex flex-row items-center mb-6"
        >
            <h1 class="font-medium mr-auto text-lg">
                Edit {{ settingsName }} Settings
            </h1>

            <button
                class="
                    button button-default-responsive button-primary
                    flex flex-row items-center
                "
                type="submit"
            >
                <icon-save
                    class="
                        w-5
                        md:mr-2
                    "
                />
                <span
                    class="hidden md:inline"
                >
                    Save Changes
                </span>
            </button>
        </div>

        <div class="bg-white py-6 shadow-subtle rounded-lg">
            <div class="block -mt-4 px-6 w-full">
                <input-group
                    v-for="(setting, key) in settings"
                    :key="key"
                    class="mt-4"
                    :error-message="getPageErrorMessage(key)"
                    input-autocomplete="off"
                    :input-id="key"
                    :input-name="key"
                    :input-type="setting.type"
                    :label-text="setting.label"
                    @errorHidden="clearPageErrorMessage(key)"
                    v-model="formData[key]"
                />
            </div>
        </div>
    </form>
</template>

<script>
    import _ from 'lodash';
    import InputGroup from "../../../components/core/forms/InputGroup.vue";

    export default {
        name: "AdminSettingEdit",
        components: {InputGroup},
        layout: 'admin-layout',
        props: {
            settings: {
                required: true,
                type: Object,
            },
            settingsGroup: {
                required: true,
                type: String,
            },
            settingsName: {
                required: true,
                type: String,
            }
        },
        data() {
            return {
                formData: {},
            }
        },
        created() {
            _.forEach(this.settings, (setting, key) => {
                let value = setting.value === null ? '' : setting.value;
                this.$set(this.formData, key, value);
            });
        },
        methods: {
            submit() {
                let formattedSettings = {};
                _.forEach(this.formData, (value, key) => {
                    if (value.trim === "") {
                        value = null;
                    }

                    formattedSettings[key] = value;
                });

                this.$inertia.put(
                    this.$route('admin.settings.update', this.settingsGroup),
                    formattedSettings
                );
            }
        },
    }
</script>