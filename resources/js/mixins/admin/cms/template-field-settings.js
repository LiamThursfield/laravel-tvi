import _ from 'lodash';

export const templateFieldSettingsMixin = {
    model: {
        prop: 'field_settings'
    },
    props: {
        default_settings: {
            required: true,
            type: Array | Object,
        },
        field_settings: {
            required: true,
            type: Array | Object,
        },
        template_field: {
            required: true,
            type: Object,
        }
    },
    data() {
        return {
            editable_field_settings: {},
        }
    },
    computed: {
        is_default_settings() {
            try {
                if (!this.default_settings || Array.isArray(this.default_settings)) {
                    return false;
                }

                return Object.keys(this.default_settings).length;
            } catch (e) {
                return false;
            }
        }
    },
    mounted() {
        this.editable_field_settings = _.cloneDeep(this.field_settings);
        this.initialiseSettings();
    },
    methods: {
        initialiseSettings() {
            // If the field settings are an array - convert to an object
            if (!this.editable_field_settings || Array.isArray(this.editable_field_settings)) {
                this.editable_field_settings = {};
            }

            // Ensure all the default settings are added to the field settings, if not already preset.
            if (this.is_default_settings) {
                _.forEach(this.default_settings, (value, key) => {
                    if (!this.editable_field_settings.hasOwnProperty(key)) {
                        this.editable_field_settings[key] = value;
                    }
                });
            }

            // TODO: Should we delete any settings that are no longer relevant?
            //  i.e. any fields not in the default settings
        },
        onEditableSettingsChange() {
            this.$emit('input', this.editable_field_settings);
        },
        onFieldSettingsChange() {
            this.editable_field_settings = _.cloneDeep(this.field_settings)
        }
    },
    watch: {
        field_settings: {
            handler: "onFieldSettingsChange"
        }
    }
}
