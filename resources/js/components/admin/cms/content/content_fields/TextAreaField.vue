<template>
    <div>
        <text-area-group
            :error-message="errorMessage"
            :input-autocomplete="inputName"
            :input-id="inputName"
            :input-max-length="inputMaxLength"
            :input-name="inputName"
            :input-required="templateField.is_required"
            :input-rows="inputRows"
            input-type="text"
            label-class=""
            label-text=""
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
