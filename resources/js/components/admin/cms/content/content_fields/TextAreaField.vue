<template>
    <div>
        <text-area-group
            :errorMessage="errorMessage"
            :inputAutocomplete="inputName"
            :inputId="inputName"
            :inputMaxLength="inputMaxLength"
            :inputName="inputName"
            :inputRequired="templateField.is_required"
            :inputRows="inputRows"
            inputType="text"
            labelText=""
            v-model="editableContent"
        >
            <slot/>
        </text-area-group>
    </div>
</template>

<script>
    import { contentFieldMixin } from "../../../../../mixins/admin/cms/content-field";
    import TextAreaGroup from "../../../../core/forms/TextAreaGroup";

    export default {
        name: "TextAreaField",
        mixins: [
            contentFieldMixin,
        ],
        components: {
            TextAreaGroup,
        },
        computed: {
            inputMaxLength() {
                try {
                    return this.templateField.settings.max_length;
                } catch (e) {
                    return '';
                }
            },
            inputRows() {
                try {
                    return this.templateField.settings.rows;
                } catch (e) {
                    return '';
                }
            }
        }
    }
</script>
