import _ from 'lodash';

export const formFieldSettingsMixin = {
    model: {
        prop: 'fieldSettings'
    },
    props: {
        defaultSettings: {
            required: true,
            type: Array | Object,
        },
        fieldSettings: {
            required: true,
            type: Array | Object,
        },
        formField: {
            required: true,
            type: Object,
        }
    },
    data() {
        return {
            editableFieldSettings: {},
        }
    },
    computed: {
        isDefaultSettings() {
            try {
                if (!this.defaultSettings || Array.isArray(this.defaultSettings)) {
                    return false;
                }

                return Object.keys(this.defaultSettings).length;
            } catch (e) {
                return false;
            }
        }
    },
    mounted() {
        this.editableFieldSettings = _.cloneDeep(this.fieldSettings);
        this.initialiseSettings();
    },
    methods: {
        initialiseSettings() {
            // If the field settings are an array - convert to an object
            if (!this.editableFieldSettings || Array.isArray(this.editableFieldSettings)) {
                this.editableFieldSettings = {};
            }

            // Ensure all the default settings are added to the field settings, if not already preset.
            if (this.isDefaultSettings) {
                _.forEach(this.defaultSettings, (value, key) => {
                    if (!this.editableFieldSettings.hasOwnProperty(key)) {
                        this.editableFieldSettings[key] = value;
                    }
                });
            }

            // TODO: Should we delete any settings that are no longer relevant?
            //  i.e. any fields not in the default settings
        },
        onEditableSettingsChange() {
            this.$emit('input', this.editableFieldSettings);
        },
        onFieldSettingsChange() {
            this.editableFieldSettings = _.cloneDeep(this.fieldSettings)
        }
    },
    watch: {
        fieldSettings: {
            handler: "onFieldSettingsChange"
        }
    }
}
