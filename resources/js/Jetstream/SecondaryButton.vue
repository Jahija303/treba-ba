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
    transition: 0.5s;
    background: white;
    box-shadow: 0 8px 28px rgba(22, 223, 126, 0.45);
}
button:hover {
    background: whitesmoke;
    color: #181818;
    box-shadow: 0 8px 28px rgba(32, 107, 251, 0.45);
}
</style>
