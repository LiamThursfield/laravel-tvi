<template>
    <div v-if="isLoadingForms">
        <slot/>

        <span class="flex items-center">
            <icon-loader-circle class="animate-spin-slow mr-2 w-5"/>
            <span>Loading</span>
        </span>
    </div>
    <div v-else>
        <select-group
            :error-message="errorMessage"
            :input-any-option-enabled="true"
            input-any-option-label="Please select a form"
            :input-autocomplete="inputName"
            :input-id="inputName"
            :input-name="inputName"
            input-option-label-key="name"
            input-option-value-key="id"
            :input-options="forms"
            :input-required="templateField.is_required"
            label-class=""
            label-text=""
            v-model="editableContent"
        >
            <slot/>
        </select-group>
    </div>
</template>

<script>
    import _ from "lodash";
    import { contentFieldMixin } from "../../../../../mixins/admin/cms/content-field";
    import SelectGroup from "../../../../core/forms/SelectGroup";

    export default {
        name: "CmsFormField",
        mixins: [
            contentFieldMixin,
        ],
        components: {
            SelectGroup,
        },
        data() {
            return {
                isLoadingForms: false,
                forms: [],
            }
        },
        computed: {
            isForms() {
                try {
                    return Array.isArray(this.forms) && this.forms.length;
                } catch (e) {
                    return false;
                }
            },
        },
        created() {
            this.editableContent = this.content;
            this.getForms();
        },
        methods: {
            getForms() {
                this.isLoadingForms = true;

                axios.get(
                    this.$route('admin.api.crm.forms.index')
                ).then(response => {
                    this.forms = response.data.data;
                }).catch(e => {
                    this.$errorToast('Failed to load forms');
                }).finally(() => {
                    this.isLoadingForms = false;
                })
            }
        }
    }
</script>
