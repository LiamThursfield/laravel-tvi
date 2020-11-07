<template>
    <main
        id="auth-layout"
        class="bg-theme-base-contrast"
    >
        <div class="absolute inset-0  w-full">
            <div
                class="auth-background-container bg-theme-primary"
            />
            <svg
                class="fill-current -mt-px text-theme-primary"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 1440 320"
            >
                <path
                    fill-opacity="1"
                    d="M0,64L120,69.3C240,75,480,85,720,85.3C960,85,1200,75,1320,69.3L1440,64L1440,0L1320,0C1200,0,960,0,720,0C480,0,240,0,120,0L0,0Z"
                />
            </svg>
        </div>

        <div class="flex items-center justify-center min-h-screen min-w-full p-4 relative">
            <slot />
        </div>
    </main>
</template>

<script>
    export default {
        name: "AuthLayout",
        metaInfo() {
            return {
                title: 'Laravel TVI',
                meta: [
                    {
                        name: 'description',
                        content: 'Laravel TVI',
                    }
                ]
            }
        },
    }
</script>
