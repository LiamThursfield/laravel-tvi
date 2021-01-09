<template>
    <div>
        <input-group
            :errorMessage="errorMessage"
            :inputAutocomplete="inputName"
            :inputId="inputName"
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
    // TODO: Replace with an image select modal
    import { contentFieldMixin } from "../../../../../mixins/admin/cms/content-field";
    import InputGroup from "../../../../core/forms/InputGroup";

    export default {
        name: "ImageField",
        mixins: [
            contentFieldMixin,
        ],
        components: {
            InputGroup,
        },
    }
</script>
