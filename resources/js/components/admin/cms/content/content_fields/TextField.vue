<template>
    <div>
        <input-group
            :errorMessage="errorMessage"
            :inputAutocomplete="inputName"
            :inputId="inputName"
            :inputMaxLength="inputMaxLength"
            :inputName="inputName"
            :inputRequired="templateField.is_required"
            inputType="text"
            labelText=""
            v-model="editableContent"
        >
            <slot/>
        </input-group>
    </div>
</template>

<script>
    import { contentFieldMixin } from "../../../../../mixins/admin/cms/content-field";
    import InputGroup from "../../../../core/forms/InputGroup";

    export default {
        name: "TextField",
        mixins: [
            contentFieldMixin,
        ],
        components: {
            InputGroup,
        },
        computed: {
            inputMaxLength() {
                try {
                    return this.templateField.settings.max_length;
                } catch (e) {
                    return '';
                }
            }
        }
    }
</script>
