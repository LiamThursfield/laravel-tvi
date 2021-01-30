<template>
    <div>
        <draggable
            animation="200"
            ghost-class="ghost"
            :group="{ name: 'menu-item-draggable'}"
            handle=".draggable-handle"
            :list="menuItems"
            @end="onDraggableEnd"
            @sort="onDraggableSort"
            @start="onDraggableStart"
        >
            <div
                v-for="(menuItem, key) in menuItems"
                :key="`menu-item-${key}`"
            >
                <div
                    class="border-2 border-theme-base-subtle flex flex-row items-center px-4 py-1 rounded"
                >
                    <div class="draggable-handle cursor-move">
                        <icon-grid-dots class="w-5" />
                    </div>

                    <span class="font-semibold ml-4 mr-auto">
                        {{ menuItem.label}}
                    </span>

                    <button
                        class="
                            flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                            focus:outline-none focus:ring
                            hover:bg-theme-primary-subtle hover:text-theme-primary-subtle-contrast
                        "
                        title="Add Child Menu Item"
                        type="button"
                        @click="addMenuItem(key)"
                    >
                        <icon-plus
                            class="w-4"
                        />
                    </button>

                    <button
                        class="
                            flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                            focus:outline-none focus:ring
                            hover:bg-theme-info hover:text-theme-info-contrast
                        "
                        title="Edit Menu Item"
                        type="button"
                        @click="editMenuItem(key)"
                    >
                        <icon-edit
                            class="w-4"
                        />
                    </button>

                    <button
                        class="
                            flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                            focus:outline-none focus:ring
                            hover:bg-theme-danger hover:text-theme-danger-contrast
                        "
                        title="Delete Menu Item"
                        type="button"
                        @click="checkDelete(key)"
                    >
                        <icon-trash
                            class="w-4"
                        />
                    </button>

                </div>

                <div>
                    <menu-item-draggable
                        class="inner-draggable pl-4"
                        :class="{'mt-4': menuItem.child_items.length}"
                        :menu-items="menuItem.child_items"
                    />
                </div>

            </div>
        </draggable>

        <confirmation-modal
            confirm-text="Delete"
            confirm-type="danger"
            :show-modal="showDeleteModal"
            :message-text="deleteModalText"
            @cancelAction="cancelDelete"
            @closeModal="cancelDelete"
            @confirmAction="confirmDelete"
        />

        <menu-item-modal
            :is-create="!isEditingMenuItem"
            :menu-item="menuItemToEdit"
            :show-modal="showEditModal"
            @cancelAction="cancelEdit"
            @closeModal="cancelEdit"
            @confirmAction="confirmEdit"
        />
    </div>
</template>

<script>
    import _ from 'lodash';
    import draggable from 'vuedraggable';
    import ConfirmationModal from "../../../core/modals/ConfirmationModal";
    import MenuItemModal from "./MenuItemModal";

    export default {
        name: 'MenuItemDraggable',
        components: {
            ConfirmationModal,
            draggable,
            MenuItemModal,
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
                isEditingMenuItem: false,
                menuItemIndexToDelete: null,
                menuItemIndexToEdit: null,
                showDeleteModal: false,
                showEditModal: false,
            }
        },
        computed: {
            deleteModalText() {
                try {
                    return 'Do you really want to delete the \'' + this.menuItemToDelete.label + '\' menu item?'
                } catch (e) {
                    return 'Do you really want to delete this menu item?';
                }
            },
            isMenuItems() {
                try {
                    return this.menuItems.length;
                } catch (e) {
                    return false;
                }
            },
            menuItemToDelete() {
                try {
                    return this.menuItems[this.menuItemIndexToDelete];
                } catch (e) {
                    return false;
                }
            },
            menuItemToEdit() {
                try {
                    if (!this.isEditingMenuItem) {
                        return {};
                    }
                    return this.menuItems[this.menuItemIndexToEdit];
                } catch (e) {
                    return {}
                }
            }
        },
        methods: {
            addMenuItem(index) {
                this.isEditingMenuItem = false;
                this.showEditModal = true;
                this.menuItemIndexToEdit = index;
            },
            cancelDelete() {
                this.showDeleteModal = false;
                this.menuItemIndexToDelete = null;
            },
            cancelEdit() {
                this.showEditModal = false;
                this.menuItemIndexToEdit = false;
            },
            checkDelete(index) {
                this.menuItemIndexToDelete = index;
                this.showDeleteModal = true;
            },
            confirmEdit(menuItem) {
                if (this.isEditingMenuItem) {
                    // This is an existing item, update it
                    this.$set(this.menuItems, this.menuItemIndexToEdit, _.cloneDeep(menuItem));
                } else {
                    // This is a new item, add it as a child
                    this.menuItems[this.menuItemIndexToEdit].child_items.push(_.cloneDeep(menuItem));
                }

                this.showEditModal = false;
                this.isEditingMenuItem = false;
                this.menuItemIndexToEdit = false;
            },
            confirmDelete() {
                try {
                    this.$delete(this.menuItems, this.menuItemIndexToDelete)
                } catch (e) {
                    this.$errorToast('Failed to delete menu item.');
                    console.log(e);
                } finally {
                    this.showDeleteModal = false;
                    this.menuItemIndexToDelete = null;
                }
            },
            editMenuItem(index) {
                this.menuItemIndexToEdit = index;
                this.isEditingMenuItem = true;
                this.showEditModal = true;
            },
            onDraggableEnd() {
                this.isDragging = false;
            },
            onDraggableSort() {
                // Clear page errors as indexes have changed
                this.$page.props.errors = {};
            },
            onDraggableStart() {
                this.isDragging = true;
            },
        },

    }
</script>

<style scoped>
    .ghost {
        opacity: 0.35;
    }

    .flip-field-move {
        transition: transform 0.5s;
    }

    .no-move {
        transition: transform 0s;
    }

    .inner-draggable {
        min-height: 18px;
    }
</style>
