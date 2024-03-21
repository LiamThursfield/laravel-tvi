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
                :key="`section-item-${sectionItem.title}-${key}`"
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
                        <span v-if="sectionItem.lecture_count">
                            {{ sectionItem.child_items ? sectionItem.child_items.length + ' lectures | ':'' }}
                        </span>
                        {{ sectionItem.content_length ?  sectionItem.content_length + ' mins':'' }}
                    </small>

                    <button
                        v-if="sectionItem.hasOwnProperty('lecture_count') && !sectionItem.hasOwnProperty('section_id')"
                        class="
                            flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                            focus:outline-none focus:ring
                            hover:bg-theme-primary-subtle hover:text-theme-primary-subtle-contrast
                        "
                        title="Add"
                        type="button"
                        @click="addItem(key)"
                    >
                        <icon-plus
                            class="w-4"
                        />
                    </button>

                    <button
                        v-if="!sectionItem.hasOwnProperty('section_id')"
                        class="
                            flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                            focus:outline-none focus:ring
                            hover:bg-theme-info hover:text-theme-info-contrast
                        "
                        title="Edit"
                        type="button"
                        @click="editItem(key, sectionItem)"
                    >
                        <icon-edit
                            class="w-4"
                        />
                    </button>

                    <a
                        v-if="sectionItem.hasOwnProperty('section_id') && sectionItem.id"
                        class="
                            flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                            focus:outline-none focus:ring
                            hover:bg-theme-info hover:text-theme-info-contrast
                        "
                        :href="$route('admin.edu.lectures.edit', sectionItem.id)"
                        target="_blank"
                    >
                        <icon-edit
                            class="w-4"
                        />
                    </a>

                    <button
                        v-if="sectionItem.hasOwnProperty('section_id') && !sectionItem.id"
                        class="
                            flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                            focus:outline-none focus:ring
                            hover:bg-theme-info hover:text-theme-info-contrast
                        "
                        title="Save Course before you can edit"
                        type="button"
                        disabled
                    >
                        <icon-edit
                            class="w-4"
                        /> DRAFT
                    </button>

                    <button
                        class="
                            flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                            focus:outline-none focus:ring
                            hover:bg-theme-danger hover:text-theme-danger-contrast
                        "
                        title="Delete"
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
            :is-create="!isEditingSectionItem"
            :section-item="sectionItemToEdit"
            :show-modal="showEditModal"
            @cancelAction="cancelEdit"
            @closeModal="cancelEdit"
            @confirmAction="confirmEdit"
        />

        <lecture-item-modal
            :lecture-item="sectionItemToEdit"
            :show-modal="showLectureModal"
            @cancelAction="cancelLectureEdit"
            @closeModal="cancelLectureEdit"
            @confirmAction="confirmEditLecture"
        />
    </div>
</template>

<script>
import _ from 'lodash';
import draggable from 'vuedraggable';
import ConfirmationModal from "../../../core/modals/ConfirmationModal.vue";
import SectionItemModal from "./SectionItemModal.vue";
import LectureItemModal from "./LectureItemModal.vue";

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
            isEditingSectionItem: false,
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
                return 'Do you really want to delete \'' + this.sectionItemToDelete.title + '\'? This action cannot be reversed!'
            } catch (e) {
                return 'Do you really want to delete this section item? This action cannot be reversed!';
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
                if (!this.isEditingSectionItem) {
                    return {};
                }
                return this.sectionItems[this.sectionItemIndexToEdit];
            } catch (e) {
                return {}
            }
        },
    },
    methods: {
        addItem(index) {
            this.isEditingSectionItem = false;
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
        cancelLectureEdit() {
            this.showLectureModal = false;
            this.sectionItemIndexToEdit = false;
        },
        checkDelete(index) {
            this.sectionItemIndexToDelete = index;
            this.showDeleteModal = true;
        },
        confirmEdit(sectionItem) {
            if (this.isEditingSectionItem) {
                // This is an existing item, update it
                this.$set(this.sectionItems, this.sectionItemIndexToEdit, _.cloneDeep(sectionItem));
            } else {
                // This is a new item, add it as a child
                this.sectionItems[this.sectionItemIndexToEdit].child_items.push(_.cloneDeep(sectionItem));
            }

            this.showEditModal = false;
            this.isEditingSectionItem = false;
            this.sectionItemIndexToEdit = false;
        },
        confirmEditLecture(sectionItem) {
            if (this.isEditingSectionItem) {
                // This is an existing item, update it
                this.$set(this.sectionItems, this.sectionItemIndexToEdit, _.cloneDeep(sectionItem));
            } else {
                // This is a new item, add it as a child
                this.sectionItems[this.sectionItemIndexToEdit].child_items.push(_.cloneDeep(sectionItem));
            }

            this.showLectureModal = false;
            this.isEditingSectionItem = false;
            this.sectionItemIndexToEdit = false;
        },
        confirmDelete() {
            try {
                let item = this.sectionItems[this.sectionItemIndexToDelete];
                this.$delete(this.sectionItems, this.sectionItemIndexToDelete)

                if (item.hasOwnProperty('course_id') && item.id) {
                    this.$inertia.delete(
                        this.$route('admin.edu.sections.destroy', item.id)
                    );
                }

                if (item.hasOwnProperty('section_id') && item.id) {
                    this.$inertia.delete(
                        this.$route('admin.edu.lectures.destroy', item.id)
                    );
                }
            } catch (e) {
                this.$errorToast('Failed to delete section item.');
                console.log(e);
            } finally {
                this.showDeleteModal = false;
                this.sectionItemIndexToDelete = null;
            }
        },
        editItem(index, sectionItem) {
            this.sectionItemIndexToEdit = index;
            this.isEditingSectionItem = true;

            if (sectionItem.hasOwnProperty('section_id')) {
                this.showLectureModal = true;
            } else {
                this.showEditModal = true;
            }
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
