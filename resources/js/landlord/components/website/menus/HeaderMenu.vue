<template>
    <header>
        <div
            class="
                flex flex-row h-20 items-center max-w-screen-xl mx-auto px-5 relative z-40
                md:justify-between
            "
        >
            <!-- Logo -->
            <inertia-link
                class="
                    block text-black text-lg font-bold
                    md:text-xl
                    hover:text-theme-primary-hover
                    transition-colors
                "
                title="SIGI"
                href="/"
            >
                SIGI
            </inertia-link>

            <!-- Menu Items -->
            <nav
                class="
                    hidden flex-row items-center text-gray-600
                    md:flex
                "
            >
                <ul class="flex flex-row items-center -mx-4" >
                    <li
                        v-for="(menuItem, key) in headerMenu"
                        :key="`menu-item${key}`"
                        class="mx-4"
                    >
                        <inertia-link
                            class="focus:text-gray-900 hover:text-gray-900 hover:underline"
                            :title="menuItem.label"
                            :href="menuItem.href"
                        >
                            {{ menuItem.label }}
                        </inertia-link>
                    </li>
                </ul>
            </nav>

            <nav
                class="
                    hidden flex-row items-center text-theme-primary
                    md:flex
                "
            >
                <ul class="flex flex-row items-center -mx-4">
                    <li class="mx-4">
                        <inertia-link
                            class="
                                bg-theme-primary border-2 border-transparent px-4 py-2 ring-offset-2 ring-theme-primary-subtle-hover rounded text-center text-theme-primary-contrast transition
                                focus-visible:ring-2 hover:bg-theme-primary-hover hover:text-theme-primary-hover-contrast
                            "
                            title="Enquire"
                            href="/#"
                        >
                            Enquire
                        </inertia-link>
                    </li>
                </ul>
            </nav>

            <nav class="flex flex-row items-center ml-auto md:hidden">
                <hamburger-button
                    :show-close-icon="isMobileNavVisible"
                    @button-toggled="setMobileNavVisible"
                />
            </nav>
        </div>

        <header-menu-mobile
            :is-visible="isMobileNavVisible"
            :navigation-links="headerMenu"
            @link-selected="setMobileNavVisible(false)"
        />
    </header>
</template>
<script>
    import HamburgerButton from "../buttons/HamburgerButton";
    import HeaderMenuMobile from "./HeaderMenuMobile";

    export default {
        components: {
            HeaderMenuMobile,
            HamburgerButton
        },
        computed: {

        },
        data() {
            return {
                headerMenu: [
                    {
                        href: "/#",
                        label: "Pricing",
                    },
                    {
                        href: "/#",
                        label: "About",
                    },
                    {
                        href: "/#",
                        label: "Contact",
                    },
                ],
                isMobileNavVisible: false,
                mobileNavScrollClass: 'mobile-nav-scroll-lock',
            }
        },
        methods: {
            setMobileNavVisible(isVisible) {
                this.isMobileNavVisible = isVisible;

                if (isVisible) {
                    document.body.classList.add(this.mobileNavScrollClass);
                } else {
                    document.body.classList.remove(this.mobileNavScrollClass);
                }
            },
        }
    }
</script>
