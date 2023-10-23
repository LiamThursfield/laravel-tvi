<template>
    <div>
        <div class="mb-4">
            <h1 class="font-semibold mr-auto text-3xl">
                {{ course.name }}
            </h1>
            <small>By <b>{{ course.creator.name }}</b></small>
        </div>

        <div class="grid grid-rows-1 md:grid-rows-2 grid-flow-col gap-x-2">
            <div class="bg-white p-6 shadow-subtle rounded-lg row-span-2 ...">
                <h2 class="font-semibold">Course Content</h2>
                <hr
                    class="my-2 h-px border-t-0 bg-transparent bg-gradient-to-r from-black via-neutral-500 to-transparent opacity-25 dark:opacity-100"
                />

                <div
                    v-for="(menuSection, menuSectionKey) in course.sections"
                    :key="menuSectionKey"
                    class="menu-section"
                >
                    <button
                        class="menu-subheading font-semibold"
                    >
                        {{ menuSection.title }}
                        <small class="font-weight-light">
                            {{ menuSection.lecture_count + ' lectures' + ' | ' + menuSection.content_length + ' minutes'}}
                        </small>
                    </button>

                    <template class="root-menu" v-show="menuSection.child_items.length">
                        <collapse-transition dimension="height">
                            <ul
                                class="sub-menu"
                            >
                                <course-side-menu-item
                                    v-for="(child, key) in menuSection.child_items"
                                    :key="`${menuSectionKey}.${key}`"
                                    class="sub-menu-item"
                                    :menu-item="child"
                                    :menu-item-key="`${menuSectionKey}.${key}`"
                                    :selected-lecture="lecture"
                                    :menu-item-level="2"
                                    :toggled-items="toggledItems"
                                    @openItem="onMenuItemOpened"
                                    @toggleItem="onMenuItemToggled(child, key)"
                                />
                            </ul>
                        </collapse-transition>
                    </template>

                    <div
                        class="menu-separator"
                    ></div>
                </div>
            </div>

            <div class="col-span-3 ...">
                <div v-if="isLoadingLecture">
                    <icon-loader-circle class="animate-spin-slow w-5"/>
                </div>
                <div
                    v-if="lecture && !isLoadingLecture"
                    class="bg-white p-6 shadow-subtle rounded-lg row-span-2"
                >
                    <h2 class="font-semibold">{{ lecture.title }}</h2>
                    <hr
                        class="my-2 h-px border-t-0 bg-transparent bg-gradient-to-r from-black via-neutral-500 to-transparent opacity-25 dark:opacity-100"
                    />

                    <div class="container max-w-screen-lg mx-auto">
                        <div class="text-center">
                            <iframe :src="lecture.video_url" width="960" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        <hr
                            class="my-6 h-px border-t-0 bg-transparent bg-gradient-to-r from-black via-neutral-500 to-transparent opacity-25 dark:opacity-100"
                        />
                        <div class="mb-4 grid grid-cols-4 gap-4">
                            <button
                                class="
                                    button button-default-responsive button-primary
                                    flex flex-row items-center
                                "
                                title="Mark Lecture Complete"
                                @click="checkMarkComplete(lecture)"
                                :disabled="lecture.completed"
                            >
                                <icon-square-check-filled
                                    v-if="lecture.completed"
                                    class="w-5 md:mr-2"
                                />
                                <icon-square-check
                                    v-else
                                    class="w-5 md:mr-2"
                                />

                                <span class="hidden md:inline">
                                    {{ lecture.completed ? 'Completed':'Mark Complete' }}
                                </span>
                            </button>

                            <button
                                class="
                                    button button-default-responsive button-primary-subtle
                                    flex flex-row items-center
                                "
                                title="Download PDFs"
                                @click="downloadPDFs(lecture)"
                            >
                                <icon-book-download
                                    class="w-5 md:mr-2"
                                />
                                <span class="hidden md:inline">
                                    Download PDFs
                                </span>
                            </button>
                        </div>
                        <p
                            v-if="lecture.description"
                            class="font-weight-light"
                        >
                            {{ lecture.description }}
                        </p>
                        <p
                            v-else
                            class="font-weight-light"
                        >
                            {{ course.description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <confirmation-modal
            confirm-text="Mark Complete"
            confirm-type="success"
            :show-modal="showConfirmMarkCompleteModal"
            :message-text="markCompleteModalText"
            @cancelAction="cancelMarkComplete"
            @closeModal="cancelMarkComplete"
            @confirmAction="confirmMarkComplete"
        />
    </div>
</template>

<script>

import CourseSideMenuItem from "../../../../components/student/menus/CourseSideMenuItem";
import IconSquareCheck from "../../../../components/core/icons/IconSquareCheck";
import CollapseTransition from "@ivanv/vue-collapse-transition";
import ConfirmationModal from "../../../../components/core/modals/ConfirmationModal";
import IconSquareCheckFilled from "../../../../components/core/icons/IconSquareCheckFilled";
import IconBookDownload from "../../../../components/core/icons/IconBookDownload";


export default {
    name: "StudentAdminCourseShow",
    layout: 'student-admin-layout',
    components: {
        IconBookDownload,
        IconSquareCheckFilled,
        IconSquareCheck,
        CourseSideMenuItem,
        CollapseTransition,
        ConfirmationModal
    },
    props: {
        course: {
            required: true,
            type: Object | Array,
        },
    },
    data() {
        return {
            mountedItems: {},
            toggledItems: {},
            lecture: null,
            isLoadingLecture: false,
            isLoadingMarkComplete: false,
            showConfirmMarkCompleteModal: null,
            itemToMarkComplete: null,
        }
    },
    computed: {
        isToggled() {
            return !!this.toggledItems[this.menuItemKey];
        },
        markCompleteModalText() {
            try {
                if (this.itemToMarkComplete.index === '0') {
                    return 'Do you really want to mark as complete \'' + this.itemToMarkComplete.title + '\'?'
                        + ' A refund won\'t be available once you move to the next step';
                } else {
                    return 'Do you really want to mark as complete \'' + this.itemToMarkComplete.title + '\'?';
                }
            } catch (e) {
                return 'Do you really want to perform this action?'
            }
        },
    },
    mounted() {
        this.isLoadingLecture = true;
        this.lecture = this.course.sections[0].child_items[0];
        this.isLoadingLecture = false;
    },
    methods: {
        onMenuItemOpened(item, itemKey) {
            this.$set(this.toggledItems, itemKey, true);
        },
        onMenuItemToggled(item, itemKey) {
            this.isLoadingLecture = true;
            if (this.toggledItems[itemKey]) {
                this.$set(this.toggledItems, itemKey, false);
            } else {
                this.$set(this.toggledItems, itemKey, true);
            }
            this.lecture = item;
            this.isLoadingLecture = false;
        },
        checkMarkComplete(item) {
            this.showConfirmMarkCompleteModal = true;
            this.itemToMarkComplete = item;
        },
        confirmMarkComplete() {
            if (this.isLoadingMarkComplete) {
                return this.$errorToast('It\'s only possible to mark it complete once.');
            }
            this.$inertia.patch(
                this.$route('student.admin.lectures.complete', this.itemToMarkComplete.id),
                {
                    only: [
                        'flash',
                        'course'
                    ]
                }
            );
            this.lecture.completed = true;
            this.itemToMarkComplete = null;
            this.showConfirmMarkCompleteModal = false;
        },
        cancelMarkComplete() {
            if (!this.isLoadingPublish) {
                this.showConfirmPublishModal = false;
                this.itemToPublish = null;
            }
        },
        downloadPDFs(lecture) {

        }
    }
}
</script>
