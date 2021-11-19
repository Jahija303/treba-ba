<template>

    <h1>Edit role</h1>
    <p>{{ role }}</p>
    <p>{{ permissions }}</p>

</template>

<script>
    import { defineComponent } from 'vue'
    import AdminLayout from "../../../Layouts/AdminLayout";

    export default defineComponent({
        components: {
            AdminLayout,
        },
        data() {
            return {

            }
        },
        props: ['role', 'permissions'],
        methods: {

        },
    })

</script>
