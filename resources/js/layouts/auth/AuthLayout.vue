<template>
    <main
        class="bg-gray-800"
    >
        <div style="width: 100%; position: absolute; top: 0; left: 0;">
            <div
                class="bg-indigo-600"
                style="height: 35vh;"
            />
            <svg
                class="text-indigo-600 fill-current"
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
    }
</script>
