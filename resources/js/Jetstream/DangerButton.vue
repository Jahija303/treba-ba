<template>
    <button :type="type" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition">
        <slot></slot>
    </button>
</template>

<script>
    import { defineComponent } from 'vue'

    export default defineComponent({
        props: {
            type: {
                type: String,
                default: 'button',
            },
        }
    })
</script>

<style scoped>
button {
    transition: 0.5s;
    background: #f10000;
    box-shadow: 0 8px 28px rgba(217, 0, 0, 0.45);
}
button:hover {
    background: #d90000;
    color: #181818;
    box-shadow: 0 8px 28px rgba(217, 0, 0, 0.45);
}
</style>
