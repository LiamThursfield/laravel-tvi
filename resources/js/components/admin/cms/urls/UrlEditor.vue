<template>
    <div>
        <input-group
            :error-message="getPageErrorMessage('url.url_main')"
            input-id="url_input"
            input-name="url_input"
            :input-required="true"
            input-type="text"
            label-text="URL"
            @errorHidden="clearPageErrorMessage('url.url_main')"
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
            @errorHidden="clearPageErrorMessage('url.url_full')"
            v-model="urlFull"
        >
            <span class="flex flex-row items-center">
                <span class="flex flex-row items-baseline">
                    Formatted URL
                    <sup class="text-theme-danger-contrast">*</sup>
                </span>

                <icon-loader-circle
                    v-if="isUrlCheckLoading"
                    class="animate-spin-slow h-4 ml-3 text-theme-base-subtle-contrast w-4"
                />

                <span
                    v-else-if="isUrlChecked && this.urlInput.length"
                    class="flex flex-row font-normal items-center ml-3"
                    :class="{
                        'text-theme-success-contrast': isUrlAvailable,
                        'text-theme-danger-contrast': !isUrlAvailable,
                    }"
                >
                    <template v-if="isUrlAvailable">
                        <icon-check class="h-4 mr-1 w-4" />
                        <span>URL is available</span>
                    </template>

                    <template v-else-if="!isUrlAvailable">
                        <icon-x class="h-4 mr-1 w-4" />
                        <span>URL is unavailable</span>
                    </template>
                </span>
            </span>
        </input-group>

        <div class="bg-theme-base-subtle h-px my-6"></div>

        <inline-checkbox-group
            class="mt-4"
            :error-message="getPageErrorMessage('url.is_enabled')"
            input-id="url_is_enabled"
            input-name="url_is_enabled"
            label-text="Enabled?"
            @errorHidden="clearPageErrorMessage('url.is_enabled')"
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
                @errorHidden="clearPageErrorMessage('url.published_at')"
                v-model="editableUrlData.published_at"
            />

            <date-time-picker-group
                class="mt-4 md:flex-1"
                :error-message="getPageErrorMessage('url.expired_at')"
                input-id="url_expired_at"
                input-name="url_expired_at"
                label-text="Expiry Date"
                @errorHidden="clearPageErrorMessage('url.expired_at')"
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

    let CancelToken = axios.CancelToken;
    let urlCheckCancelToken = CancelToken.source();

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
                isUrlChecked: false,
                isUrlCheckLoading: false,
                isUrlAvailable: false,
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
            cancelUrlCheck() {
                if (this.isUrlCheckLoading) {
                    urlCheckCancelToken.cancel('URL check cancelled');
                    urlCheckCancelToken = CancelToken.source();
                }
            },
            checkUrlIsAvailable: _.debounce(function () {
                this.isUrlChecked = false;
                this.cancelUrlCheck();

                this.isUrlChecked = false;
                this.isUrlAvailable = false;

                if (!this.urlInput.length) {
                    return;
                }

                this.isUrlCheckLoading = true;

                let params = {
                    url: this.urlFull,
                    url_id: this.urlData.id ? this.urlData.id : null,
                };

                axios.get(
                    this.$route('admin.api.cms.urls.available'),
                    {
                        params,
                        cancelToken: urlCheckCancelToken.token,
                    }
                ).then(response => {
                    this.isUrlCheckLoading = false;
                    this.isUrlChecked = true;
                    this.isUrlAvailable = response.data;
                }).catch(error => {
                    if (!axios.isCancel(error)) {
                        this.isUrlCheckLoading = false;
                        this.$errorToast('Failed to check URL availability')
                    }
                });
            }, 500),
            onComputedUrlUpdate() {
                if (!this.autoUpdateUrl) {
                    return;
                }

                this.updateUrl(this.computedUrl);
            },
            onEditableUrlUpdate: _.debounce(function () {
                this.$emit('input', this.editableUrlData);
            }, 100),
            onIsUrlAvailableUpdate() {
                this.$emit('isAvailable', this.isUrlAvailable);
            },
            onUrlInputInput() {
                this.autoUpdateUrl = false;
                this.isUrlChecked = false;
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
                    this.isUrlChecked = false;
                }

                this.$set(this.editableUrlData, 'url_main', formatted);
                this.checkUrlIsAvailable();
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
            isUrlAvailable: {
                handler: 'onIsUrlAvailableUpdate'
            },
            urlFull: {
                handler: 'checkUrlIsAvailable'
            },
            urlInput: {
                handler: 'onUrlInputUpdate'
            },
        }
    }
</script>
