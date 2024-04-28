<template>
    <nav
        class="top-menu"
    >
        <menu class="flex p-0 space-x-5">
            <inertia-link
                v-for="(item, key) in menu"
                :key="`menu-${key}`"
                :class="{
                    'text-theme-primary': $routeCurrent(item.route)
                }"
                class="hover:text-theme-primary-hover"
                :href="$route(item.route)"
            >
                <span v-if="!logoUrl">{{__('messages.' + item.label) }}</span>
                <span
                    v-else
                    class="flex flex-row items-center space-x-3"
                >
                    <img :src="logoUrl" class="h-8 w-8 md:h-12 md:w-12"/>
                    <!-- TODO:: Make this more stylish and pass in the tenant name correctly -->
                    <span class="font-semibold text-lg md:text-xl">
                         {{ tenantName }}
                    </span>
                </span>
            </inertia-link>
        </menu>

        <div class="ml-auto select-none">
            <button
                id="userDropdownButton"
                class="menu-link"
            >
                {{ $page.props.auth.user.first_name }}
            </button>
        </div>

        <div
            ref="userDropdownMenu"
            class="
                flex flex-col py-2
                focus:outline-none
            "
        >

            <p class="dropdown-subheading mb-2">
                {{ __('messages.hello', { name: $page.props.auth.user.first_name }) }}
            </p>

            <inertia-link
                class="dropdown-link"
                :href="$route('student.admin.index')"
            >
                {{ __('messages.homepage') }}
            </inertia-link>

            <inertia-link
                v-if="userCan('profile.view')"
                class="dropdown-link"
                :href="$route('student.admin.profile.index')"
                @click="closeUserDropdown"
            >
                {{ __('messages.profile') }}
            </inertia-link>

            <div class="dropdown-separator"></div>

            <inertia-link
                class="dropdown-link"
                as="button"
                :href="$route('logout')"
                method="post"
            >
                {{ __('messages.logout') }}
            </inertia-link>
        </div>
    </nav>
</template>

<script>
import tippy from 'tippy.js';
import 'tippy.js/animations/shift-away-extreme.css';

export default {
    name: "StudentTopMenu",
    data() {
        return {
            userDropDown: null,
            menu: {
                courses: {
                    label: "courses",
                    route: "student.admin.index",
                },
            }
        }
    },
    computed: {
        logoUrl() {
            // return this.$page.props.layout.logo_url;
            return 'https://sigi-media-pub.s3.eu-west-1.amazonaws.com/logo-minducate.webp';
        },
        tenantName() {
            return 'Minducate.Us';
        }
    },
    mounted() {
        this.initialiseUserDropdown();
    },
    methods: {
        closeUserDropdown() {
            try {
                if (Array.isArray(this.userDropDown)) {
                    this.userDropDown.forEach(item => {
                        item.hide();
                    })
                } else {
                    this.userDropDown.hide();
                }
            } catch (e) {
                console.log(e)
            }
        },
        initialiseUserDropdown() {
            let userDropdownMenu = this.$refs.userDropdownMenu;
            userDropdownMenu.style.display = 'block';

            this.userDropDown = tippy('#userDropdownButton',{
                animation: 'shift-away-extreme',
                content: userDropdownMenu,
                interactive: true,
                theme: 'dropdown',
                trigger: 'click',
            });
        },
        showMobileSideMenu() {
            this.$store.commit('showMobileSideMenu');
        }
    },
}
</script>
