<template>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark position-top absolute-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#"><h3 data-aos="fade-right" data-aos-duration="900" data-aos-delay="100">TREBA<span>.ba</span></h3></a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ml-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">

                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#" data-aos="fade-left" data-aos-duration="900" data-aos-delay="100">Home</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#"  data-aos="fade-left" data-aos-duration="900" data-aos-delay="150">About</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#" data-aos="fade-left" data-aos-duration="900" data-aos-delay="200">Contact</a></li>

                    <li v-if="canLogin" class="nav-item">
                        <div v-if="$page.props.user">
                            <form method="POST" @submit.prevent="logout">
                                <jet-responsive-nav-link as="button">
                                    Log Out
                                </jet-responsive-nav-link>
                            </form>
                        </div>

                        <template v-else>
                            <div class="container">
                                <jet-responsive-nav-link :href="route('login')">
                                    Log in
                                </jet-responsive-nav-link>

                                <jet-responsive-nav-link v-if="canRegister" :href="route('register')">
                                    Register
                                </jet-responsive-nav-link>
                            </div>
                        </template>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink.vue';

    export default defineComponent({
        components: {
            Head,
            Link,
            JetResponsiveNavLink,
        },

        methods: {
            logout() {
                this.$inertia.post(route('logout'));
            },
        },

        props: {
            canLogin: Boolean,
            canRegister: Boolean,
        }
    })
</script>

<style scoped></style>
