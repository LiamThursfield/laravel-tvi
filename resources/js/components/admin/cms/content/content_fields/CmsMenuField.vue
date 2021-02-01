<template>
    <div v-if="isLoadingMenuItems">
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
            input-any-option-label="Please select a menu"
            :input-autocomplete="inputName"
            :input-id="inputName"
            :input-name="inputName"
            input-option-label-key="name"
            input-option-value-key="id"
            :input-options="menuItems"
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
        name: "CmsMenuField",
        mixins: [
            contentFieldMixin,
        ],
        components: {
            SelectGroup,
        },
        data() {
            return {
                isLoadingMenuItems: false,
                menuItems: [],
            }
        },
        computed: {
            isMenuItems() {
                try {
                    return Array.isArray(this.menuItems) && this.menuItems.length;
                } catch (e) {
                    return false;
                }
            },
        },
        created() {
            this.editableContent = this.content;
            this.getMenuItems();
        },
        methods: {
            getMenuItems() {
                this.isLoadingMenuItems = true;

                axios.get(
                    this.$route('admin.api.cms.menus.index')
                ).then(response => {
                    this.menuItems = response.data.data;
                }).catch(e => {
                    this.$errorToast('Failed to load menu items');
                }).finally(() => {
                    this.isLoadingMenuItems = false;
                })
            }
        }
    }
</script>
