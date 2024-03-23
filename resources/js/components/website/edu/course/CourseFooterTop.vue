<template>
    <section class="bg-theme-secondary text-theme-secondary-contrast px-4 py-12">
        <div class="container max-w-screen-lg mx-auto">
            <div class="grid grid-cols-1 gap-3
                    md:grid-cols-2
                    lg:grid-cols-3
                    xl:grid-cols-2"
            >
                <div v-if="footerMenu">
                    <h1 class="font-bold mb-2">{{ footerMenuName }}</h1>

                    <ul>
                        <li
                            v-for="(item, index) in footerMenu.menu_items"
                            :key="`menu-item-` + index"
                            class="pt-2"
                        >
                            <a :href="item.href" style="text-transform: capitalize;">
                                {{ item.label }}
                            </a>
                        </li>
                    </ul>
                </div>

                <div v-if="socials">
                    <h1 class="font-bold mb-2">Socials</h1>
                    <ul style="
                        display: flex;
                        list-style-type:none;"
                    >
                        <li
                            v-for="(value, key, index) in socials"
                            :key="`social-` + index"
                            class="pt-2 pr-2"
                        >
                            <a
                                :href="value">
                                <component
                                    v-if="getIconComponent(key) !== 'false'"
                                    :is="getIconComponent(key)"
                                    class="w-8 md:mr-2"
                                />
                                <span v-else style="text-transform: capitalize;">
                                    {{ key }}
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</template>

<script>

export default {
    name: "CourseFooterTop",
    props: {
        company: {
            type: Object,
            required: false,
            default: () => [],
        },
        footerMenu: {
            type: Object,
            required: false,
            default: () => [],
        },
    },
    computed: {
        footerMenuName() {
            try {
                return this.footerMenu.name;
            } catch (e) {
                return '';
            }
        },
        socials() {
            try {
                return Object.fromEntries(
                    Object.entries(this.company.socials).filter(([key, value]) => value !== null)
                );
            } catch (e) {
                return [];
            }
        },
    },
    methods: {
        getIconComponent(key) {
            switch (key) {
                case 'instagram':
                    return 'icon-instagram';
                case 'facebook':
                    return 'icon-facebook';
                case 'twitter':
                    return 'icon-twitter';
                case 'linkedin':
                    return 'icon-linked-in';
                case 'youtube':
                    return 'icon-youtube';
                case 'tiktok':
                    return 'icon-tiktok';
                case 'snapchat':
                    return 'icon-snapchat';
                default:
                    return 'false';
            }
        },
    },
}
</script>
