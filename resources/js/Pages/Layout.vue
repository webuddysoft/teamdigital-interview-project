<script setup>
    import AppHead from './AppHead.vue';
</script>

<template>
    <AppHead />
    <main>
        <header class="w-full bg-blue-500 py-5 px-10">
            <div class="container mx-auto flex justify-between items-center text-white">
                <h1 class="text-2xl uppercase font-bold">Sweepstakes</h1>
                <p class="text-xl">TeamDigital Assessment</p>
            </div>
        </header>
        <section class="container mx-auto">
            <slot />
        </section>
    </main>
</template>
