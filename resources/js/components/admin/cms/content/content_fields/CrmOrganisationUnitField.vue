<template>
    <div v-if="isLoadingOrganisationUnits">
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
            input-any-option-label="Please select an organisation unit"
            :input-autocomplete="inputName"
            :input-id="inputName"
            :input-name="inputName"
            :input-option-force-formatting="true"
            input-option-label-key="name"
            input-option-value-key="id"
            :input-options="organisationUnits"
            :input-required="templateField.is_required"
            label-class=""
            label-text=""
            v-model="editableContent"
        >
            <slot/>

            <template slot="option.label" slot-scope="{option}">
                {{ option.name }} ({{ option.type }})
            </template>
        </select-group>
    </div>
</template>

<script>
    import _ from "lodash";
    import { contentFieldMixin } from "../../../../../mixins/admin/cms/content-field";
    import SelectGroup from "../../../../core/forms/SelectGroup.vue";

    export default {
        name: "CrmCourseField",
        mixins: [
            contentFieldMixin,
        ],
        components: {
            SelectGroup,
        },
        data() {
            return {
                isLoadingOrganisationUnits: false,
                organisationUnits: [],
            }
        },
        computed: {
            isOrganisationUnits() {
                try {
                    return Array.isArray(this.organisationUnits) && this.organisationUnits.length;
                } catch (e) {
                    return false;
                }
            },
        },
        created() {
            this.editableContent = this.content;
            this.getOrganisationUnits();
        },
        methods: {
            getOrganisationUnits() {
                this.isLoadingOrganisationUnits = true;

                axios.get(
                    this.$route('admin.api.crm.organisation-units.index')
                ).then(response => {
                    this.organisationUnits = response.data.data;
                }).catch(e => {
                    this.$errorToast('Failed to load organisation units');
                }).finally(() => {
                    this.isLoadingOrganisationUnits = false;
                })
            }
        }
    }
</script>
