<template>
    <section class="overflow-hidden relative">
        <hr class="mb-4 mt-4">

        <h2 class="font-medium mb-4 text-theme-base-contrast tracking-wider">
            {{ title }}
        </h2>

        <div class="flex flex-col space-y-2">
            <div
                v-for="(settingValue, settingKey) in formattedSettingValue"
                :key="`${formattedSettingValue.mailer}-${settingKey}`"
            >
                <select-group
                    v-if="settingKey === 'mailer'"
                    :input-any-option-enabled="true"
                    input-any-option-label="Please Select"
                    :input-options="mailers" label-text="Mailer" input-name="mailer" input-id="mailer"
                    v-model="formattedSettingValue[settingKey]"
                    @input="onUpdateMailer"
                />

                <input-group
                    v-else
                    :label-text="mailerSettingLabels[settingKey]"
                    :input-autocomplete="settingKey"
                    :input-name="settingKey"
                    :input-id="settingKey"
                    :input-type="getInputType(settingKey)"
                    v-model="formattedSettingValue[settingKey]"
                    @input="onUpdate"
                />
            </div>

            <div>
                <!-- TODO: Implement elegant solution to stop propagation on "enter" press to avoid form submission -->
                <input-group
                    class="mt-4"
                    label-text="Test Mail Recipient"
                    input-name="test_mail_recipient"
                    input-id="test_mail_recipient"
                    input-wrapper-class="flex flex-row items-center space-x-3"
                    v-model="testMailRecipient"
                >
                    <template v-slot:inputAppend>
                        <button
                            class="button button-primary button-outline"
                            type="button"
                            :disabled="!testMailRecipient.length"
                            @click.stop="toggleShowSendTestMailModal"
                        >
                            Test
                        </button>
                    </template>
                </input-group>
            </div>
        </div>

        <confirmation-modal
            confirm-text="Send"
            confirm-type="success"
            :show-modal="showSendTestMailModal"
            :message-text="`Please confirm that you want to send a test email to ${testMailRecipient} with the updated mail settings?`"
            @cancelAction="cancelSendTestMail"
            @closeModal="cancelSendTestMail"
            @confirmAction="sendTestMail"
        />
    </section>
</template>

<script>
    import _ from 'lodash';
    import IconPlus from "../../core/icons/IconPlus.vue";
    import InputGroup from "../../core/forms/InputGroup.vue";
    import SelectGroup from "../../core/forms/SelectGroup.vue";
    import ConfirmationModal from "../../core/modals/ConfirmationModal.vue";
    export default {
        name: "MailerSetting",
        components: {ConfirmationModal, SelectGroup, InputGroup, IconPlus},
        model: {
            prop: 'settingValue'
        },
        props: {
            mailers: {
                required: true,
                type: Object
            },
            mailerSettingKeys: {
                required: true,
                type: Object
            },
            mailerSettingLabels: {
                required: true,
                type: Object
            },
            mailerSettingTypes: {
                required: true,
                type: Object
            },
            settingValue: {
                default: {},
                type: String | Object
            },
            title: {
                default: 'Mailer',
                type: String
            },
        },
        data() {
            return {
                formattedSettingValue: {},
                initialised: false,
                isSendingTestMail: false,
                showSendTestMailModal: false,
                testMailRecipient: '',
            }
        },
        computed: {
            isSettingValueSet() {
                try {
                    return !!Object.keys(this.formattedSettingValue).length;
                } catch (e) {
                    return false;
                }
            },
        },
        mounted() {
            this.initialise();
        },
        methods: {
            cancelSendTestMail() {
                this.showSendTestMailModal = false;
            },
            formatSetting() {
                if (!this.isSettingValueSet || this.formattedSettingValue.mailer === '') {
                    this.formattedSettingValue = {};
                    this.$set(this.formattedSettingValue, 'mailer', '');

                    return;
                }

                let settings = {
                    mailer: this.formattedSettingValue.mailer
                };

                _.forEach(this.mailerSettingKeys[settings.mailer], (settingKey) => {
                    settings[settingKey] = this.formattedSettingValue[settingKey] ?? '';
                });

                this.formattedSettingValue = _.cloneDeep(settings);
            },
            getInputType(settingKey) {
                try {
                    if (this.mailerSettingTypes.hasOwnProperty(settingKey)) {
                        return this.mailerSettingTypes[settingKey];
                    }

                    return 'text';
                } catch (e) {
                    return 'text';
                }
            },
            initialise() {
                try {
                    this.formattedSettingValue = _.cloneDeep(this.settingValue);
                    this.formatSetting();
                    this.$emit('input', this.formattedSettingValue);

                    this.testMailRecipient = this.$page.props.auth.user.email;

                    this.initialised = true;
                } catch (e) {
                    // Do nothing
                }
            },
            onUpdate() {
                this.formatSetting();
                this.$emit('input', this.formattedSettingValue);
            },
            onUpdateMailer() {
                let settings = {
                    mailer: this.formattedSettingValue.mailer
                };

                if (this.mailerSettingKeys.hasOwnProperty(settings.mailer)) {
                    _.forEach(this.mailerSettingKeys[settings.mailer], key => {
                        this.$set(settings, key, '');
                    });
                }

                this.formattedSettingValue = _.cloneDeep(settings);
                this.$emit('input', this.formattedSettingValue);
            },
            sendTestMail() {
                this.isSendingTestMail = true;

                let params = _.cloneDeep(this.formattedSettingValue);
                params.recipient = this.testMailRecipient;

                axios.post(
                    this.$route('admin.api.settings.mailer-test'),
                    params
                ).then(response => {
                    this.$successToast('Test mail sent to ' + this.testMailRecipient);
                }).catch(e => {
                    let message = 'Failed to send test mail';
                    if (e && e.response && e.response.data && e.response.data.message) {
                        message += ' - ' + e.response.data.message;
                    }

                    this.$errorToast(message);
                }).finally(() => {
                    this.isSendingTestMail = false;
                    this.showSendTestMailModal = false;
                });
            },
            toggleShowSendTestMailModal() {
                if (this.showSendTestMailModal) {
                    this.showSendTestMailModal = false;
                    return;
                }

                if (this.testMailRecipient && this.testMailRecipient.length) {
                    this.showSendTestMailModal = true;
                }
            }
        }
    }
</script>
