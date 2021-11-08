<template>
    <footer class="main-footer">
        <strong>Copyright &copy; 2020-{{ currentDate.getFullYear()}} <Link href="#">Admin-Treba.ba</Link>.</strong>
            All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0.0
        </div>
    </footer>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3'

    export default defineComponent({
        components: {
            Link,
        },

        data() {
            return {
                currentDate: new Date()
            }
        }
    })
</script>
