<template>
    <div>
        <input-group
            inputId="url_input"
            inputName="url_input"
            :inputRequired="true"
            labelText="Url"
            inputType="text"
            v-model="urlInput"
        />

        <input-group
            class="mt-4"
            :inputDisabled="true"
            inputId="url_full"
            inputName="url_full"
            labelText="Formatted URL"
            inputType="text"
            v-model="urlFull"
        />

        <div class="bg-theme-base-subtle h-px my-6"></div>

        <inline-checkbox-group
            class="mt-4"
            checkboxId="url_is_enabled"
            checkboxName="url_is_enabled"
            labelText="Enabled?"
            v-model="editableUrlData.is_enabled"
        />

        <div
            class="flex flex-col md:flex-row md:mt-2 md:space-x-4"
        >
            <date-time-picker-group
                class="mt-4 md:flex-1"
                inputId="url_published_at"
                inputName="url_published_at"
                labelText="Publish Date"
                v-model="editableUrlData.published_at"
            />

            <date-time-picker-group
                class="mt-4 md:flex-1"
                inputId="url_expired_at"
                inputName="url_expired_at"
                labelText="Expiry Date"
                v-model="editableUrlData.expired_at"
            />
        </div>
    </div>
</template>

<script>
    import _ from 'lodash';
    import slugify from "slugify";

    import DateTimePickerGroup from '../../../core/forms/DateTimePickerGroup';
    import InlineCheckboxGroup from "../../../core/forms/InlineCheckboxGroup";
    import InputGroup from '../../../core/forms/InputGroup';

    export default {
        name: "UrlEditor",
        components: {
            DateTimePickerGroup,
            InlineCheckboxGroup,
            InputGroup,
        },
        model: {
            prop: 'urlData',
        },
        props: {
            parentUrl: {
                default: null,
                type: String | null,
            },
            urlData: {
                required: true,
                type: Object | null,
            }
        },
        data() {
            return {
                editableUrlData: {
                    expired_at: null,
                    is_enabled: false,
                    published_at: null,
                    url_main: '',
                },
                urlInput: '',
            }
        },
        computed: {
            urlFull() {
                let url = '';

                if (this.parentUrl && this.parentUrl.length) {
                    url += this.parentUrl;
                }

                url += this.urlInputSlugified;

                return url.split('//').join('/');
            },
            urlInputSlugified() {
                if (!this.urlInput) {
                    return '/';
                }

                let url = this.urlInput;
                url.trim();

                if (!url.length) {
                    return '/';
                }

                url = slugify(url, {lower: true});

                if (url.indexOf('/') !== 0) {
                    url = '/' + url;
                }

                return url;
            }
        },
        created() {
            try {
                if (this.urlData && Object.keys(this.urlData).length) {
                    this.editableUrlData = _.cloneDeep(this.urlData);
                    this.urlInput = this.editableUrlData.url_main ?? '';
                }
            } catch (e) {
                return;
            }
        },
        methods: {
            onEditableUrlUpdate: _.debounce(function () {
                this.$emit('input', this.editableUrlData);
            }, 100),
            onUrlInputUpdate: _.debounce(function () {
                if (!this.urlInput.length) {
                    return;
                }

                let formatted = this.urlInput;
                let startsWithSlash = this.urlInput.charAt(0) === '/';

                formatted = slugify(formatted);
                if (startsWithSlash) {
                    formatted = '/' + formatted;
                }

                if (this.urlInput !== formatted) {
                    this.urlInput = formatted;
                }

                this.$set(this.editableUrlData, 'url_main', formatted);
            }, 100),
        },
        watch: {
            editableUrlData: {
                deep: true,
                handler: 'onEditableUrlUpdate'
            },
            urlInput: {
                handler: 'onUrlInputUpdate'
            },
        }
    }
</script>
