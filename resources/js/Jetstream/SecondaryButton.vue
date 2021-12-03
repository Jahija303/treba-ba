<template>
    <button :type="type" class="inline-flex jet-btn-secondary items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition">
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
    border: 0;
    background: none;
    font-size: 16px;
    padding: 0 20px;
    background: rgb(255, 255, 255);
    color: #111111;
    transition: 0.3s;
    border-radius: 4px;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
}
button:hover {
    background: rgba(255, 255, 255, 0.95);
}
</style>
