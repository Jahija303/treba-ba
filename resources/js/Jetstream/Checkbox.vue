<template>
    <input type="checkbox" :value="value" v-model="proxyChecked"
           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
</template>

<script>
import { defineComponent } from 'vue'

export default defineComponent({
    emits: ['update:checked', 'update:unchecked'],

    props: {
        checked: {
            type: [Array, Boolean],
            default: false,
        },
        value: {
            default: null,
        },
    },

    computed: {
        proxyChecked: {
            get() {
                return this.checked;
            },

            set(val) {
                if(val) {
                    this.$emit("update:checked", val);
                } else if(!val) {
                    this.$emit("update:unchecked", val);
                }
            },
        },
    },
})
</script>
