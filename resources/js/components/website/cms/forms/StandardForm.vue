<template>
    <section>
        <slot name="title">
            <h2 :class="titleClass">
                {{ titleOverride ? titleOverride : form.name }}
            </h2>
        </slot>

        <form
            v-if="!successMessage"
            :class="formClass"
            @submit.prevent="submit"
        >
            <div
                v-for="field in form.form_fields"
                :key="field.slug"
            >
                <input
                    v-if="getInputType(field) === 'hidden'"
                    :name="field.slug"
                    type="hidden"
                    v-model="formData[field.slug]"
                />

                <input-group
                    v-else-if="getInputType(field) === 'text' || getInputType(field) === 'email'"
                    :input-id="field.slug"
                    :input-name="field.slug"
                    :input-required="field.is_required"
                    :input-type="getInputType(field)"
                    :label-text="field.name"
                    v-model="formData[field.slug]"
                    @errorHidden="clearPageErrorMessage(field.slug)"
                />

                <text-area-group
                    v-else-if="getInputType(field) === 'textarea'"
                    :input-id="field.slug"
                    :input-max-length="field.settings?.max_length"
                    :input-name="field.slug"
                    :input-required="field.is_required"
                    :input-rows="field.settings?.rows"
                    :label-text="field.name"
                    v-model="formData[field.slug]"
                    @errorHidden="clearPageErrorMessage(field.slug)"
                />

                <!-- TODO: Implement remaining fields -->
            </div>

            <slot name="button">
                <div class="text-right">
                    <button
                        :class="buttonClass"
                        :disabled="isLoading"
                        type="submit"
                    >
                        {{ submitButtonText }}
                    </button>
                </div>
            </slot>

            <div
                v-if="error"
                class="text-theme-danger-contrast"
            >
                {{ error }}
            </div>
        </form>

        <div v-else>
            {{ successMessage }}
        </div>
    </section>
</template>

<script>
    import _ from 'lodash';
    import InputGroup from "../../../core/forms/InputGroup.vue";
    import TextAreaGroup from "../../../core/forms/TextAreaGroup.vue";

    export default {
        name: "StandardForm",
        components: {TextAreaGroup, InputGroup},
        props: {
            buttonClass: {
                default: 'button button-primary ml-auto',
                type: String,
            },
            form: {
                required: true,
                type: Object,
            },
            formClass: {
                default: 'gap-6 grid grid-cols-1',
                type: String,
            },
            formDataOverrides: {
                default: () => {return {}},
                type: Object,
            },
            titleClass: {
                default: 'font-bold text-lg',
                type: String
            },
            titleOverride: {
                default: null,
                type: String|null
            }
        },
        data() {
            return {
                error: false,
                formData: {},
                isLoading: false,
                successMessage: false,
            }
        },
        computed: {
            submitButtonText() {
                let text = this.form.submit_button_text ? this.form.submit_button_text : 'Submit'
                let translationKey = 'form.buttons.' + this.formatTransKey(text);

                return this.transWithFallback(translationKey, text);
            }
        },
        created() {
            _.forEach(this.form.form_fields, (form_field) => {
                this.$set(this.formData, form_field.slug, '');
            });

            _.forEach(this.formDataOverrides, (value, slug) => {
                this.$set(this.formData, slug, value);
            });
        },
        methods: {
            getInputType(field) {
                switch (field.type) {
                    case 'crm_first_name':
                    case 'crm_last_name':
                    case 'crm_title':
                    case 'crm_telephone':
                        return 'text';
                    case 'crm_email':
                        return 'email';
                    default:
                        return field.type;
                }
            },
            submit() {
                this.isLoading = true;
                this.error = false;

                axios.post(
                    this.$route('api.form-submission.store', this.form.id),
                    this.formData
                ).then(response => {
                    this.isLoading = false;
                    this.successMessage = response.data?.message;

                    if (response.data?.redirect_url) {
                        setTimeout(() => {
                            window.location.href = response.data?.redirect_url;
                        }, 1000)
                    }
                }).catch(e => {
                    this.isLoading = false;
                    this.error = this.transWithFallback('messages.form_submission_failed', 'Failed to submit form. Please try again.');
                });
            }
        }
    }
</script>
