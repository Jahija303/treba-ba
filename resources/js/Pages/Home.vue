<template>
    <h1>Home Page</h1>
    <!-- Authentication -->
    <form method="POST" @submit.prevent="logout">
        <jet-responsive-nav-link as="button">
            Log Out
        </jet-responsive-nav-link>
    </form>
</template>

<script>
import { defineComponent } from 'vue'
import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink.vue'
import { Link } from '@inertiajs/inertia-vue3';

export default defineComponent({
    components: {
        JetResponsiveNavLink,
        Link,
    },

    methods: {
        logout() {
            this.$inertia.post(route('logout'));
        },
    }
})
</script>

<style scoped>

</style>
