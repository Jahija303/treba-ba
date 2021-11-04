<template>
    <footer class="main-footer">
        <strong>Copyright &copy; 2020-{{ currentDate.getFullYear()}} <inertia-link href="#">Admin-Treba.ba</inertia-link>.</strong>
            All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0.0
        </div>
    </footer>
</template>

<script>
    import { defineComponent } from 'vue'

    export default defineComponent({
        data() {
            return {
                currentDate: new Date()
            }
        }
    })
</script>
