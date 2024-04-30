<template>
    <section class="overflow-hidden relative">
        <div class="bg-white flex flex-row justify-between relative z-10">
            <h2 class="font-medium mb-2 text-theme-base-contrast tracking-wider">
                {{ title }}
                <span
                    class="
                        cursor-pointer text-sm text-theme-primary
                        ease-in-out duration-300 transition-colors
                        hover:text-theme-primary-hover
                    "
                    @click="checkResetDefaults"
                >
                    (Reset)
                </span>
            </h2>

            <div
                class="
                    cursor-pointer
                    ease-in-out duration-300 transition-colors
                    hover:text-primary
                "
                @click="toggleColors"
            >
                <component
                    :is="showColors ? 'icon-minus' : 'icon-plus'"
                    class="w-3"
                />
            </div>
        </div>

        <transition name="slide-down">
            <div
                v-if="showColors"
                class="
                    gap-3 grid grid-cols-2
                    md:grid-cols-3
                    lg:grid-cols-4
                "
            >
                <div
                    v-for="(colorLabel, colorKey) in colors"
                    :key="colorKey"
                >
                    <input-group
                        class="mt-2"
                        :key="colorKey"
                        input-autocomplete="off"
                        input-class="input-group-input h-10"
                        :input-id="`color-${colorKey}`"
                        :input-name="`color-${colorKey}`"
                        input-type="color"
                        :label-text="colorLabel"
                        v-model="formattedSettingValue[colorKey]"
                    />
                </div>
            </div>
        </transition>

        <confirmation-modal
            :confirm-text="__('messages.confirm')"
            :cancel-text="__('messages.cancel')"
            :message-title="__('messages.are-you-sure') + '?'"
            :show-modal="showResetDefaultsModal"
            :message-text="__('messages.color-reset-confirm')"
            @cancelAction="cancelResetDefaults"
            @closeModal="cancelResetDefaults"
            @confirmAction="confirmResetDefaults"
        />
    </section>
</template>

<script>
    import _ from 'lodash';
    import IconPlus from "../../core/icons/IconPlus.vue";
    import InputGroup from "../../core/forms/InputGroup.vue";
    import ConfirmationModal from "../../core/modals/ConfirmationModal.vue";
    export default {
        name: "ColorsSetting",
        components: {ConfirmationModal, InputGroup, IconPlus},
        model: {
            prop: 'settingValue'
        },
        props: {
            colors: {
                required: true,
                type: Object
            },
            defaultColors: {
                required: true,
                type: Object
            },
            settingValue: {
                default: {},
                type: String | Object
            },
            title: {
                default: 'Colours',
                type: String
            },
        },
        data() {
            return {
                formattedSettingValue: {},
                showColors: true,
                showResetDefaultsModal: false,
            }
        },
        mounted() {
            this.initialise();
        },
        methods: {
            cancelResetDefaults() {
                this.showResetDefaultsModal = false;
            },
            checkResetDefaults() {
                this.showResetDefaultsModal = true;
            },
            confirmResetDefaults() {
                this.setDefaults();
                this.showResetDefaultsModal = false;
            },
            initialise() {
                try {
                    // Set the initial colors to the default colors, and overlay any existing colors
                    this.setDefaults();

                    // Load any existing colors
                    let existingColors = {};
                    if (typeof this.settingValue === 'string') {
                        existingColors = JSON.parse(this.settingValue);
                    } else {
                        existingColors = _.cloneDeep(this.settingValue);
                    }

                    // Set any existing colors -- note, any colors no longer in this.colors, will be removed on save
                    _.forEach(this.formattedSettingValue, (colorLabel, colorKey) => {
                        if (existingColors.hasOwnProperty(colorKey)) {
                            this.$set(this.formattedSettingValue, colorKey, existingColors[colorKey]);
                        }
                    });
                } catch (e) {
                    // Do nothing
                }

                this.onUpdate();
            },
            setDefaults() {
                _.forEach(this.defaultColors, (colorValue, colorKey) => {
                    this.$set(this.formattedSettingValue, colorKey, colorValue);
                });
            },
            onUpdate() {
                this.$emit('input', this.formattedSettingValue);
            },
            toggleColors() {
                this.showColors = !this.showColors;
            }
        }
    }
</script>
