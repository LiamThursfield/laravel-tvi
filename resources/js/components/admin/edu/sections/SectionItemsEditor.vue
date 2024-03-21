<template>
    <div>
        <div class="flex flex-row items-center">
            <span class="text-lg">Sections</span>

            <button
                class="button button-primary-subtle button-small ml-auto text-sm"
                type="button"
                @click="addSectionItem"
            >
                Add Section
            </button>
        </div>

        <p
            v-if="!sectionItems.length"
            class="bg-theme-base-subtle mt-6 px-4 py-3 rounded text-center text-theme-base-subtle-contrast"
        >
            Nothing found
        </p>

        <div v-else>
            <section-item-draggable
                class="mt-6"
                :section-items="sectionItems"
            />
        </div>

        <section-item-modal
            :section-item="newSectionItem"
            :show-modal="showCreateModal"
            @cancelAction="cancelCreate"
            @closeModal="cancelCreate"
            @confirmAction="confirmCreate"
        />
    </div>
</template>

<script>
    import _ from 'lodash';
    import SectionItemDraggable from "./SectionItemDraggable.vue";
    import SectionItemModal from "./SectionItemModal.vue";

    export default {
        name: 'SectionItemsEditor',
        components: {
            SectionItemDraggable,
            SectionItemModal
        },
        model: {
            prop: 'sectionItems'
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
                newSectionItem: {},
                newLectureItem: {},
                showCreateModal: false,
            }
        },
        methods: {
            addSectionItem() {
                this.showCreateModal = true;
            },
            cancelCreate() {
                this.showCreateModal = false;
            },
            confirmCreate(sectionItem) {
                this.showCreateModal = false;
                this.sectionItems.push(_.cloneDeep(sectionItem));
                this.newSectionItem = {};
                this.newLectureItem = {};
            },
        },
    }
</script>
