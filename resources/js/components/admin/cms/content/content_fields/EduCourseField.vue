<template>
    <div v-if="isLoadingCourses">
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
            input-any-option-label="Please select a course"
            :input-autocomplete="inputName"
            :input-id="inputName"
            :input-name="inputName"
            :input-option-force-formatting="true"
            input-option-label-key="name"
            input-option-value-key="id"
            :input-options="courses"
            :input-required="templateField.is_required"
            label-class=""
            label-text=""
            v-model="editableContent"
        >
            <slot/>

            <template slot="option.label" slot-scope="{option}">
                {{ option.name }} | {{ option.status }}
            </template>
        </select-group>
    </div>
</template>

<script>
    import _ from "lodash";
    import { contentFieldMixin } from "../../../../../mixins/admin/cms/content-field";
    import SelectGroup from "../../../../core/forms/SelectGroup.vue";

    export default {
        name: "EduCourseField",
        mixins: [
            contentFieldMixin,
        ],
        components: {
            SelectGroup,
        },
        data() {
            return {
                isLoadingCourses: false,
                courses: [],
            }
        },
        computed: {
            isCourses() {
                try {
                    return Array.isArray(this.courses) && this.courses.length;
                } catch (e) {
                    return false;
                }
            },
        },
        created() {
            this.editableContent = this.content;
            this.getCourses();
        },
        methods: {
            getCourses() {
                this.isLoadingCourses = true;

                axios.get(
                    this.$route('admin.api.edu.courses.index')
                ).then(response => {
                    this.courses = response.data.data;
                }).catch(e => {
                    this.$errorToast('Failed to load courses');
                }).finally(() => {
                    this.isLoadingCourses = false;
                })
            }
        }
    }
</script>
