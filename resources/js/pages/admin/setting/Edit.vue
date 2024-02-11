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
                {{ __('settings.edit', {setting: settingsName}) }}
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
                    {{ __('form.buttons.save') }}
                </span>
            </button>
        </div>

        <div class="bg-white py-6 shadow-subtle rounded-lg">
            <div class="block -mt-4 px-6 w-full">
                <template
                    v-for="(setting, key) in settings"
                >
                    <select-group
                        v-if="setting.type === 'select'"
                        class="mt-4"
                        :key="key"
                        :error-message="getPageErrorMessage(key)"
                        input-autocomplete="off"
                        :input-id="key"
                        :input-name="key"
                        :input-type="setting.type"
                        :label-text="setting.label"
                        :input-options="setting.options"
                        @errorHidden="clearPageErrorMessage(key)"
                        v-model="formData[key]"
                    />

                    <input-group
                        v-else
                        class="mt-4"
                        :key="key"
                        :error-message="getPageErrorMessage(key)"
                        input-autocomplete="off"
                        :input-id="key"
                        :input-name="key"
                        :input-type="setting.type"
                        :label-text="setting.label"
                        @errorHidden="clearPageErrorMessage(key)"
                        v-model="formData[key]"
                    />
                </template>
            </div>
        </div>
    </form>
</template>

<script>
    import _ from 'lodash';
    import InputGroup from "../../../components/core/forms/InputGroup.vue";
    import SelectGroup from "../../../components/core/forms/SelectGroup.vue";

    export default {
        name: "AdminSettingEdit",
        components: {SelectGroup, InputGroup},
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
                    formattedSettings,
                    {
                        // Some settings may need a page reload to take effect
                        onSuccess: () => { window.location.reload() }
                    }
                )
            }
        },
    }
</script>
