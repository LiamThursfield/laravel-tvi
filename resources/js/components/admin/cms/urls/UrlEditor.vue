<template>
    <div>
        <input-group
            :error-message="getPageErrorMessage('url.url_main')"
            input-id="url_input"
            input-name="url_input"
            :input-required="true"
            input-type="text"
            label-text="Url"
            @input="onUrlInputInput"
            v-model="urlInput"
        />

        <input-group
            class="mt-4"
            :error-message="getPageErrorMessage('url.url_full')"
            :input-disabled="true"
            input-id="url_full"
            input-name="url_full"
            input-type="text"
            label-text="Formatted URL"
            v-model="urlFull"
        />

        <div class="bg-theme-base-subtle h-px my-6"></div>

        <inline-checkbox-group
            class="mt-4"
            :error-message="getPageErrorMessage('url.is_enabled')"
            input-id="url_is_enabled"
            input-name="url_is_enabled"
            label-text="Enabled?"
            v-model="editableUrlData.is_enabled"
        />

        <div
            class="flex flex-col md:flex-row md:mt-2 md:space-x-4"
        >
            <date-time-picker-group
                class="mt-4 md:flex-1"
                :error-message="getPageErrorMessage('url.published_at')"
                input-id="url_published_at"
                input-name="url_published_at"
                label-text="Publish Date"
                v-model="editableUrlData.published_at"
            />

            <date-time-picker-group
                class="mt-4 md:flex-1"
                :error-message="getPageErrorMessage('url.expired_at')"
                input-id="url_expired_at"
                input-name="url_expired_at"
                label-text="Expiry Date"
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
            computedUrl: {
                default: '',
                type: String
            },
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
                autoUpdateUrl: true,
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

                if (this.urlInput && this.urlInput !== '') {
                    this.autoUpdateUrl = false;
                }
            } catch (e) {
                return;
            }
        },
        methods: {
            onComputedUrlUpdate() {
                if (!this.autoUpdateUrl) {
                    return;
                }

                this.updateUrl(this.computedUrl);
            },
            onEditableUrlUpdate: _.debounce(function () {
                this.$emit('input', this.editableUrlData);
            }, 100),
            onUrlInputInput() {
                this.autoUpdateUrl = false;
            },
            onUrlInputUpdate: _.debounce(function () {
                if (!this.urlInput.length) {
                    return;
                }

                this.updateUrl(this.urlInput);
            }, 100),
            updateUrl(url) {
                let formatted = url;
                let startsWithSlash = formatted.charAt(0) === '/';

                formatted = slugify(formatted);
                if (startsWithSlash) {
                    formatted = '/' + formatted;
                }

                if (this.urlInput !== formatted) {
                    this.urlInput = formatted;
                }

                this.$set(this.editableUrlData, 'url_main', formatted);
            },
        },
        watch: {
            computedUrl: {
                handler: 'onComputedUrlUpdate'
            },
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
