<template>
    <section id="cta" class="cta">
        <div class="container">

            <div class="text-center">
                <h3>Postanite dio bolje budućnosti</h3>
                <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua </p>
                <Link class="cta-btn" :href="route('home')">Prijavi Problem</Link>
            </div>

        </div>
    </section>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
import {defineComponent} from "vue";

export default defineComponent({
    components: {
        Link,
    },
})
</script>

<style>
/*--------------------------------------------------------------
# Cta
--------------------------------------------------------------*/
.cta {
    background: #16df7e;
    background-size: cover;
    padding: 60px 0;
}
.cta h3 {
    color: #fff;
    font-size: 28px;
    font-weight: 700;
}
.cta p {
    color: #fff;
}
.cta .cta-btn {
    font-family: "Raleway", sans-serif;
    text-transform: uppercase;
    font-weight: 500;
    font-size: 16px;
    letter-spacing: 1px;
    display: inline-block;
    padding: 8px 28px;
    border-radius: 4px;
    transition: 0.5s;
    margin-top: 10px;
    border: 2px solid #fff;
    color: #fff;
}
.cta .cta-btn:hover {
    background: #206bfb;
    border-color: #206bfb;
}
</style>
