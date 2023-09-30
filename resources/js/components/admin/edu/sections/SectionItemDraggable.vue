<template>
    <div>
        <draggable
            animation="200"
            ghost-class="ghost"
            :group="{ name: 'section-item-draggable'}"
            handle=".draggable-handle"
            :list="sectionItems"
            @end="onDraggableEnd"
            @sort="onDraggableSort"
            @start="onDraggableStart"
        >
            <div
                v-for="(sectionItem, key) in sectionItems"
                :key="`section-item-${key}`"
            >
                <div
                    class="border-2 border-theme-base-subtle flex flex-row items-center px-4 py-1 rounded"
                >
                    <div class="draggable-handle cursor-move">
                        <icon-grid-dots class="w-5" />
                    </div>

                    <span class="font-semibold ml-4 mr-auto">
                        {{ sectionItem.title}}
                    </span>

                    <small class="mr-2 ml-auto">
                        {{ sectionItem.lecture_count }} lectures | {{ sectionItem.content_length }} mins
                    </small>

                    <button
                        class="
                            flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                            focus:outline-none focus:ring
                            hover:bg-theme-primary-subtle hover:text-theme-primary-subtle-contrast
                        "
                        title="Add Child Section Item"
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
                        title="Edit Section Item"
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
                        title="Delete Section Item"
                        type="button"
                        @click="checkDelete(key)"
                    >
                        <icon-trash
                            class="w-4"
                        />
                    </button>

                </div>

                <div>
                    <section-item-draggable
                        class="inner-draggable pl-4"
                        :class="{'mt-4': sectionItem.child_items.length}"
                        :section-items="sectionItem.child_items"
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

        <section-item-modal
            :is-create="!isEditingMenuItem"
            :section-item="sectionItemToEdit"
            :show-modal="showEditModal"
            @cancelAction="cancelEdit"
            @closeModal="cancelEdit"
            @confirmAction="confirmEdit"
        />

        <lecture-item-modal
            :is-create="!isEditingMenuItem"
            :section-item="sectionItemToEdit"
            :show-modal="showLectureModal"
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
    import SectionItemModal from "./SectionItemModal";
    import LectureItemModal from "./LectureItemModal";

    export default {
        name: 'SectionItemDraggable',
        components: {
            ConfirmationModal,
            draggable,
            SectionItemModal,
            LectureItemModal
        },
        props: {
            sectionItems: {
                required: true,
                type: Array,
            }
        },
        data() {
            return {
                isDragging: false,
                isEditingMenuItem: false,
                sectionItemIndexToDelete: null,
                sectionItemIndexToEdit: null,
                showDeleteModal: false,
                showEditModal: false,
                showLectureModal: false,
            }
        },
        computed: {
            deleteModalText() {
                try {
                    return 'Do you really want to delete the \'' + this.sectionItemToDelete.title + '\' section item?'
                } catch (e) {
                    return 'Do you really want to delete this section item?';
                }
            },
            isMenuItems() {
                try {
                    return this.sectionItems.length;
                } catch (e) {
                    return false;
                }
            },
            sectionItemToDelete() {
                try {
                    return this.sectionItems[this.sectionItemIndexToDelete];
                } catch (e) {
                    return false;
                }
            },
            sectionItemToEdit() {
                try {
                    if (!this.isEditingMenuItem) {
                        return {};
                    }
                    return this.sectionItems[this.sectionItemIndexToEdit];
                } catch (e) {
                    return {}
                }
            }
        },
        methods: {
            addMenuItem(index) {
                this.isEditingMenuItem = false;
                this.showEditModal = false;
                this.showLectureModal = true;
                this.sectionItemIndexToEdit = index;
            },
            cancelDelete() {
                this.showDeleteModal = false;
                this.sectionItemIndexToDelete = null;
            },
            cancelEdit() {
                this.showEditModal = false;
                this.sectionItemIndexToEdit = false;
            },
            checkDelete(index) {
                this.sectionItemIndexToDelete = index;
                this.showDeleteModal = true;
            },
            confirmEdit(sectionItem) {
                if (this.isEditingMenuItem) {
                    // This is an existing item, update it
                    this.$set(this.sectionItems, this.sectionItemIndexToEdit, _.cloneDeep(sectionItem));
                } else {
                    // This is a new item, add it as a child
                    this.sectionItems[this.sectionItemIndexToEdit].child_items.push(_.cloneDeep(sectionItem));
                }

                this.showEditModal = false;
                this.isEditingMenuItem = false;
                this.sectionItemIndexToEdit = false;
            },
            confirmDelete() {
                try {
                    this.$delete(this.sectionItems, this.sectionItemIndexToDelete)
                } catch (e) {
                    this.$errorToast('Failed to delete section item.');
                    console.log(e);
                } finally {
                    this.showDeleteModal = false;
                    this.sectionItemIndexToDelete = null;
                }
            },
            editMenuItem(index) {
                this.sectionItemIndexToEdit = index;
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
