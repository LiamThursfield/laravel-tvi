<template>
    <div>
        <div class="mb-4">
            <h1 class="font-semibold mr-auto text-3xl">
                {{ course.name }}
            </h1>
            <small>By <b>{{ course.creator.name }}</b></small>
        </div>

        <div class="flex flex-row space-x-4">
            <div class="max-w-sm w-full ">
                <div class="bg-white rounded-xl shadow-subtle">
                    <h2 class="border-b font-semibold px-6 py-3">
                        Course Content
                    </h2>

                    <div
                        v-for="(section, sectionIndex) in course.sections"
                        :key="`section-${sectionIndex}`"
                    >
                        <div
                            class="
                                cursor-pointer px-6 py-3
                                hover:bg-theme-primary-subtle-hover
                            "
                            :class="{
                                'bg-theme-primary-subtle-hover': sectionIndex === activeSection
                            }"
                            @click="toggleSection(sectionIndex)"
                        >
                            <div class="flex flex-1 flex-row items-center justify-between">
                                <h3 class="font-bold">
                                    {{ sectionIndex + 1 }}. {{ section.title }}
                                </h3>

                                <component
                                    :is="(toggledSections[sectionIndex]) ? 'icon-minus' : 'icon-plus'"
                                    class="w-5"
                                />
                            </div>

                            <p class="text-sm">
                                0/{{ section.child_items.length }}| {{ section.content_length }} min
                            </p>
                        </div>


                        <transition name="slide-left">
                            <div
                                v-if="toggledSections[sectionIndex]"
                            >
                                <div
                                    v-for="(lecture, lectureIndex) in section.child_items"
                                    :key="`lecture-${lectureIndex}`"
                                    class="
                                        cursor-pointer flex flex-row px-6 py-1 space-x-1
                                        hover:bg-theme-primary-subtle-hover
                                    "
                                    :class="{
                                        'bg-theme-primary-subtle-hover': isLectureActive(sectionIndex, lectureIndex)
                                    }"
                                >
                                    <button
                                        type="button"
                                        @click="checkMarkComplete(lecture)"
                                    >
                                        <component
                                            :is="lecture.completed ? 'icon-square-check-filled' : 'icon-square-check'"
                                            class="w-5"
                                            :class="{
                                                'text-theme-success-contrast' : lecture.completed
                                            }"
                                        />
                                    </button>

                                    <div
                                        @click="setActiveLecture(sectionIndex, lectureIndex, lecture)"
                                    >
                                        <p class="text-sm">{{ (lectureIndex + 1) }}. {{ lecture.title }}</p>
                                        <p class="text-xs">{{ lecture.content_length}} min</p>
                                    </div>
                                </div>
                            </div>
                        </transition>
                    </div>
                </div>
            </div>

            <transition name="slide-right">
                <div v-if="lecture && !isLoadingLecture" class="w-full">
                    <div class="bg-white overflow-hidden relative rounded-lg shadow-subtle">
                        <iframe
                            class="aspect-ratio-16-9 w-full"
                            :src="lecture.video_url"
                            allowfullscreen
                            allow="autoplay; fullscreen; picture-in-picture"
                            frameborder="0"
                        />
                    </div>

                    <div class="bg-white mt-4 p-6 overflow-hidden relative rounded-lg shadow-subtle ">
                        <div
                            class="flex items-center justify-content-between space-x-6"
                        >
                            <h2 class="flex-1 font-semibold">
                                {{ lecture.title }}
                            </h2>

                            <button
                                v-if="showPDFPanel || (lecture.files && lecture.files.length)"
                                class="button button-primary-subtle button-small flex flex-row items-center text-sm"
                                title="Download PDFs"
                                @click="downloadPDFs(lecture)"
                            >
                                <icon-book-download
                                    class="w-5 md:mr-2"
                                />
                                <span
                                    class="hidden md:inline"
                                >
                                    {{ (showPDFPanel) ? 'Cancel' : 'Download PDFs' }}
                                </span>
                            </button>
                        </div>
                        <transition-group
                            class="mt-4"
                            name="slide-left"
                            tag="div"
                        >
                            <div v-if="showPDFPanel"
                                key="downloads"
                            >
                                <h3 class="font-semibold">Files</h3>
                                <ul class="mt-2">
                                    <li
                                        v-for="(file, index) in lecture.files"
                                        class="mt-1"
                                        :key="`file-${index}`"
                                    >
                                        <a
                                            v-if="file.url"
                                            class="
                                                flex flex-row items-center space-x-2 text-theme-primary
                                                hover:text-theme-primary-hover
                                            "
                                            :href="file.url"
                                            rel="noreferrer noopener nofollow"
                                            target="_blank"
                                            @click.stop=""
                                        >
                                            <icon-external-link class="w-4" />
                                            <p class="text-sm font-semibold">{{ file.file_name }}</p>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div
                                v-else
                                key="description"
                            >
                                <p class="mt-2">{{ lecture.description }}</p>
                            </div>
                        </transition-group>
                    </div>
                </div>
            </transition>

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
import _ from 'lodash';

import CourseSideMenuItem from "../../../../components/student/menus/CourseSideMenuItem";
import IconSquareCheck from "../../../../components/core/icons/IconSquareCheck";
import CollapseTransition from "@ivanv/vue-collapse-transition";
import ConfirmationModal from "../../../../components/core/modals/ConfirmationModal";
import IconSquareCheckFilled from "../../../../components/core/icons/IconSquareCheckFilled";
import IconBookDownload from "../../../../components/core/icons/IconBookDownload";
import IconPlus from "../../../../components/core/icons/IconPlus";


export default {
    name: "StudentAdminCourseShow",
    layout: 'student-admin-layout',
    components: {
        IconPlus,
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
            activeSection: 0,
            activeSectionLecture: 0,
            toggledSections: {
                0: true
            },


            mountedItems: {},
            toggledItems: {},
            lecture: null,
            isLoadingLecture: false,
            isLoadingMarkComplete: false,
            showConfirmMarkCompleteModal: null,
            itemToMarkComplete: null,
            showPDFPanel: false,
            lectureToViewId: null,
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
        toggleSection(section) {
            this.$set(this.toggledSections, section, !this.toggledSections[section]);
        },
        isLectureActive(sectionIndex, lectureIndex) {
            return this.activeSection === sectionIndex && this.activeSectionLecture === lectureIndex
        },
        setActiveLecture(sectionIndex, lectureIndex, lecture) {
            this.activeSection = sectionIndex;
            this.activeSectionLecture = lectureIndex;
            this.lecture = _.cloneDeep(lecture);
            this.showPDFPanel = false;

            // Make it look as if it is loading, as (although counter-intuitive) it's a better UX
            // As it makes it more obvious that the active course has changed
            this.isLoadingLecture = true;
            setTimeout(() => {
                this.isLoadingLecture = false;
            }, 300);
        },

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
            if (item.completed) {
                return;
            }

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
            this.showConfirmMarkCompleteModal = false;
            this.itemToMarkComplete = null;
        },
        downloadPDFs(lecture) {
            this.lectureToViewId = lecture.id;
            this.showPDFPanel = !this.showPDFPanel;
        }
    }
}
</script>
