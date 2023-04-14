<script setup>
    import AppHead from "./AppHead.vue";
    import Layout from "./Layout.vue";
    import { Link } from "@inertiajs/vue3";
</script>

<template>
    <Layout>
        <AppHead title="Confirmation" />

        <div class="w-full max-w-md mx-auto my-8">
            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
                <div class="flex">
                    <div>
                        <p class="font-bold">Success</p>
                        <p class="text-sm">Thanks for your submittion. Your infomration has been saved successfully.</p>
                    </div>
                </div>
            </div>
            <div class="my-5 text-center">
                <Link href="/" as="button" type="button">Back to the homepage</Link>
            </div>
        </div>
    </Layout>
</template>
<style scoped>
    button[type="button"]{
        @apply font-bold py-2 px-4 rounded bg-gray-500 text-white mr-3;
    }
    button[type="button"]:hover{
        @apply bg-gray-700;
    }
</style>
