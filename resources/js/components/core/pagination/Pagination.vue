<template>
    <nav
        v-if="showPagination"
        class="pagination"
    >
         <div
             v-for="(link, key) in visibleLinks"
             :key="`pagination-link-${key}`"
             class="pagination-link-container"
             :class="{
                 'pagination-link-container-active': isActiveLink(link),
                 'pagination-link-container-first': isFirstLink(link),
                 'pagination-link-container-ellipsis': isEllipsisLink(link),
                 'pagination-link-container-last': isLastLink(link),
                 'pagination-link-container-numeric': isNumberLink(link),
             }"
        >
             <pagination-link
                 :link="link"
                 :link-class="getLinkClass(link)"
             >
                 <template v-if="getLinkIcon(link)">
                     <component
                         :is="getLinkIcon(link)"
                         class="h-5"
                     />
                 </template>
             </pagination-link>
        </div>
    </nav>
</template>

<script>
    import PaginationLink from "./PaginationLink";
    export default {
        name: "Pagination",
        components: {
            "pagination-link": PaginationLink
        },
        props: {
            customIconMap: {
                default: null,
                type: Object
            },
            pagination: {
                default: null,
                type: Object,
            },
            showFirstLastLinks: {
                default: false,
                type: Boolean
            },
            showIcons: {
                default: true,
                type: Boolean
            },
            showInactiveLinks: {
                default: true,
                type: Boolean
            },
            showNumberLinks: {
                default: true,
                type: Boolean
            },
            showPrevNextLinks: {
                default: true,
                type: Boolean
            },
            showSliders: {
                default: true,
                type: Boolean
            },
            showWhenNoPages: {
                default: false,
                type: Boolean
            }
        },
        data() {
            return {
                iconMap: {
                    'First'     : 'icon-chevrons-left',
                    'Last'      : 'icon-chevrons-right',
                    'Next'      : 'icon-chevron-right',
                    'Previous'  : 'icon-chevron-left',
                }
            }
        },
        computed: {
            allowedTextLinks() {
                // Determine which text links are allowed to be visible
                let allowedTextLinks = [];

                // Add the Previous and Next links if the setting is enabled
                if (this.showPrevNextLinks) {
                    allowedTextLinks.push('Previous', 'Next');
                }

                // Add First and Last Links if the setting is enabled
                if (this.showFirstLastLinks) {
                    allowedTextLinks.push('First', 'Last');
                }

                // Add Sliders if the setting is enabled
                if (this.showSliders) {
                    allowedTextLinks.push('...');
                }

                return allowedTextLinks;
            },
            isVisibleLinks() {
               return Array.isArray(this.visibleLinks) && this.visibleLinks.length > 0;
            },
            showPagination() {
                if (!this.isVisibleLinks) {
                    return false;
                }

                // If there are no results or is only one page, only show if the setting is enabled
                if (this.pagination.last_page < 2 && !this.showWhenNoPages) {
                    return false;
                }

                return true;
            },
            visibleLinks() {
                if (!this.pagination || !this.pagination.links) {
                    return false;
                }

                return this.pagination.links.filter(link => {
                    // Hide inactive links if they should not be shown
                    if (!this.showInactiveLinks && !link.url) {
                        return false;
                    }

                    // If the link is a numbered link (i.e. direct page link), only show it if the setting is enabled
                    if (this.isNumberLink(link)) {
                        return this.showNumberLinks;
                    }

                    // If the link is a text link, only show it if the setting is enabled
                    return this.allowedTextLinks.indexOf(link.label) >= 0;
                });
            }
        },
        mounted() {
            if (this.customIconMap) {
                this.iconMap = this.customIconMap;
            }
        },
        methods: {
            getLinkClass(link) {
                let linkClass = ['pagination-link'];

                if (link.label === '...') {
                    linkClass.push('pagination-link-slider');
                } else if (link.url === null) {
                    linkClass.push('pagination-link-disabled');
                } else {
                    linkClass.push('pagination-link-enabled');
                }

                if (link.active) {
                    linkClass.push('pagination-link-active');
                } else {
                    linkClass.push('pagination-link-inactive');
                }

                return linkClass;
            },
            getLinkIcon(link) {
                if (!this.showIcons) {
                    return false;
                }

                return this.iconMap.hasOwnProperty(link.label) ? this.iconMap[link.label] : false;
            },
            isActiveLink(link) {
                return link.active;
            },
            isEllipsisLink(link) {
                return link.label === '...';
            },
            isFirstLink(link) {
                return link.label === 1;
            },
            isLastLink(link) {
                return link.label === this.pagination.last_page;
            },
            isNumberLink(link) {
                return parseInt(link.label) > 0;
            }
        }
    }
</script>
