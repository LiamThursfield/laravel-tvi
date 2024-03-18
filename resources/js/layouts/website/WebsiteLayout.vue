<template>
    <div>
        <main
            id="website-layout"
        >
            <nav class="bg-white px-4 py-3">
                <div class="container flex flex-row justify-between mx-auto">
                    <inertia-link
                        class="font-semibold hover:text-theme-primary-hover"
                        href="/"
                    >
                        {{ __('messages.homepage') }}
                    </inertia-link>

                    <ul class="flex flex-row space-x-4">
                        <li>
                            <inertia-link
                                class="hover:text-theme-primary-hover"
                                href="#"
                            >
                                {{ __('messages.courses') }}
                            </inertia-link>
                        </li>
                        <li>
                            <inertia-link
                                class="hover:text-theme-primary-hover"
                                href="#"
                            >
                                {{ __('messages.about') }}
                            </inertia-link>
                        </li>
                        <li>
                            <inertia-link
                                class="hover:text-theme-primary-hover"
                                href="#"
                            >
                                {{ __('messages.contact') }}
                            </inertia-link>
                        </li>
                    </ul>
                </div>
            </nav>

            <slot />
        </main>
    </div>
</template>

<script>
    export default {
        name: "WebsiteLayout",
        metaInfo() {
            return {
                title: 'SIGI',
                meta: [
                    {
                        name: 'description',
                        content: 'SIGI - powered by Laravel, Tailwind, Vue, and Inertia',
                    }
                ]
            }
        },
    }
</script>
