<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
        <slot></slot>
    </button>
</template>

<script>
    import { defineComponent } from 'vue'

    export default defineComponent({
        props: {
            type: {
                type: String,
                default: 'submit',
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
    background: #16df7e;
    color: #fff;
    transition: 0.3s;
    border-radius: 4px;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
}
button:hover {
    background: #206bfb;
}
</style>
