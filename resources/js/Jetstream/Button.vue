<template>
    <button :type="type" class="inline-flex btn-get-started items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
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
.btn-get-started {
    transition: 0.5s;
    color: #fff;
    background: #16df7e;
    box-shadow: 0 8px 28px rgba(22, 223, 126, 0.45);
}
.btn-get-started:hover {
    background: #206bfb;
    box-shadow: 0 8px 28px rgba(32, 107, 251, 0.45);
}
</style>
