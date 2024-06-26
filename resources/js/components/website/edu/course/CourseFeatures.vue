<template>
    <section
        v-if="activeFeatureList"
        class="bg-theme-accent text-theme-accent-contrast px-4 py-12"
    >
        <div class="container max-w-screen-lg mx-auto">
            <div class="max-w-screen-md">
                <p class="font-bold mb-4 text-xl">
                    {{__('messages.this-course-includes') }}:
                </p>

                <div
                    class="
                        gap-x-4 grid gap-y-3
                        md:grid-cols-2
                        lg:grid-cols-3
                    "
                >
                    <div class="flex flex-row">
                       <icon-alert-video class="mr-2 w-5"/>
                        <span>{{ totalCourseVideos }} {{ __('messages.videos') }}</span>
                    </div>
                    <div
                        v-for="(feature, key) in activeFeatureList"
                        :key="`feature-${key}`"
                        class="flex flex-row"
                    >
                        <component
                            :is="feature.icon"
                            class="mr-2 w-5"
                        />
                        <span>{{ __(feature.label) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import _ from "lodash";

    export default {
        name: "CourseFeatures",
        props: {
            course: {
                required: true,
                type: Object,
            }
        },
        data() {
            return {
                featureList: [
                    {
                        feature_name: 'has_pdfs',
                        icon: 'icon-book-download',
                        label: 'messages.resources-pdfs'
                    },
                    {
                        feature_name: 'has_webinars',
                        icon: 'icon-camera-check',
                        label: 'messages.weekly-webinars'
                    },
                    {
                        force_active: true,
                        icon: 'icon-device-mobile',
                        label: 'messages.access-on-mobile'
                    },
                    {
                        feature_name: 'has_money_back_guarantee',
                        icon: 'icon-moneybag',
                        label: 'messages.money-back-gurantee'
                    },
                    {
                        feature_name: 'has_captions',
                        icon: 'icon-badge-cc',
                        label: 'messages.captions'
                    },
                    {
                        feature_name: 'has_lifetime_access',
                        icon: 'icon-check',
                        label: 'messages.lifetime-access'
                    },
                    {
                        feature_name: 'has_student_discount',
                        icon: 'icon-discount',
                        label: 'messages.student-discount'
                    },
                    {
                        feature_name: 'has_certificate',
                        icon: 'icon-certificate',
                        label: 'messages.certificate'
                    },
                    {
                        feature_name: 'has_seo',
                        icon: 'icon-speaker-phone',
                        label: 'messages.seo-exposure'
                    }
                ]
            }
        },
        computed: {
            activeFeatureList() {
                try {
                    return _.filter(this.featureList, (feature) => {
                        return this.isFeatureActive(feature);
                    });
                } catch (e) {
                    console.log(e);
                    return false;
                }
            },
            totalCourseVideos() {
                return 34;
            }
        },
        methods: {
            isFeatureActive(feature) {
                try {
                    return feature.force_active || (this.course[feature.feature_name] === true)
                } catch (e) {
                    console.log(e);
                    return false;
                }
            }
        },
    }
</script>
