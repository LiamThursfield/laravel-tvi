<template>
    <div>
        <div class="flex flex-row items-center">
            <span class="text-lg">Menu Items</span>

            <button
                class="button button-primary-subtle button-small ml-auto text-sm"
                type="button"
                @click="addMenuItem"
            >
                Add Menu Item
            </button>
        </div>

        <p
            v-if="!menuItems.length"
            class="bg-theme-base-subtle mt-6 px-4 py-3 rounded text-center text-theme-base-subtle-contrast"
        >
            No template fields
        </p>

        <div v-else>
            <menu-item-draggable
                class="mt-6"
                :menu-items="menuItems"
            />
        </div>

        <menu-item-modal
            :menu-item="newMenuItem"
            :show-modal="showCreateModal"
            @cancelAction="cancelCreate"
            @closeModal="cancelCreate"
            @confirmAction="confirmCreate"
        />
    </div>
</template>

<script>
    import _ from 'lodash';
    import MenuItemDraggable from "./MenuItemDraggable";
    import MenuItemModal from "./MenuItemModal";

    export default {
        name: 'MenuItemsEditor',
        components: {
            MenuItemDraggable,
            MenuItemModal,
        },
        model: {
            prop: 'menuItems'
        },
        props: {
            menuItems: {
                required: true,
                type: Array,
            }
        },
        data() {
            return {
                isDragging: false,
                newMenuItem: {},
                showCreateModal: false,
            }
        },
        methods: {
            addMenuItem() {
                this.showCreateModal = true;
            },
            cancelCreate() {
                this.showCreateModal = false;
            },
            confirmCreate(menuItem) {
                this.showCreateModal = false;
                this.menuItems.push(_.cloneDeep(menuItem));
                this.newMenuItem = {};
            },
        },
    }
</script>
