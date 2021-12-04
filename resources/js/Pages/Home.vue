<template>

    <!-- Header Section -->
    <Header :isHomePage="true" :can-login="canLogin" :can-register="canRegister" :dashboardAccess="dashboardAccess"/>

    <!-- Hero Section -->
    <Hero/>

    <!-- Main Content -->
    <main id="main">
        <!-- Featured Services Section -->
        <Featured/>

        <!-- About Section -->
        <About/>

        <!-- Counts Section -->
        <Counts/>

        <!-- Portfolio Section -->
        <Issues :issues="issues"/>

        <!-- Cta Section -->
        <Cta/>

        <!-- Contact Section -->
        <Contact/>
    </main>

    <!-- Footer -->
    <Footer />

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="fas fa-arrow-up"></i></a>

</template>

<script>
    import { defineComponent } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink.vue';
    import Header from "../Components/LandingPage/Header";
    import Hero from "../Components/LandingPage/Hero";
    import Featured from "../Components/LandingPage/Featured";
    import About from "../Components/LandingPage/About";
    import Counts from "../Components/LandingPage/Counts";
    import Issues from "../Components/LandingPage/Issues";
    import Cta from "../Components/LandingPage/Cta";
    import Contact from "../Components/LandingPage/Contact";
    import Footer from "../Components/LandingPage/Footer";

    export default defineComponent({
        components: {
            Head,
            Link,
            JetResponsiveNavLink,
            Header,
            Hero,
            Featured,
            About,
            Counts,
            Issues,
            Cta,
            Contact,
            Footer,
        },
        mounted() {
            this.init()
        },
        methods: {
            logout() {
                this.$inertia.post(route('logout'));
            },
            init() {
                /**
                 * Easy selector helper function
                 */
                const select = (el, all = false) => {
                    el = el.trim()
                    if (all) {
                        return [...document.querySelectorAll(el)]
                    } else {
                        return document.querySelector(el)
                    }
                }

                /**
                 * Easy event listener function
                 */
                const on = (type, el, listener, all = false) => {
                    let selectEl = select(el, all)
                    if (selectEl) {
                        if (all) {
                            selectEl.forEach(e => e.addEventListener(type, listener))
                        } else {
                            selectEl.addEventListener(type, listener)
                        }
                    }
                }

                /**
                 * Easy on scroll event listener
                 */
                const onscroll = (el, listener) => {
                    el.addEventListener('scroll', listener)
                }

                /**
                 * Navbar links active state on scroll
                 */
                let navbarlinks = select('#navbar .scrollto', true)
                const navbarlinksActive = () => {
                    let position = window.scrollY + 200
                    navbarlinks.forEach(navbarlink => {
                        if (!navbarlink.hash) return
                        let section = select(navbarlink.hash)
                        if (!section) return
                        if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
                            navbarlink.classList.add('active')
                        } else {
                            navbarlink.classList.remove('active')
                        }
                    })
                }
                window.addEventListener('load', navbarlinksActive)
                onscroll(document, navbarlinksActive)

                /**
                 * Scrolls to an element with header offset
                 */
                const scrollto = (el) => {
                    let header = select('#header')
                    let offset = header.offsetHeight

                    if (!header.classList.contains('header-scrolled')) {
                        offset -= 16
                    }

                    let elementPos = select(el).offsetTop
                    window.scrollTo({
                        top: elementPos - offset,
                        behavior: 'smooth'
                    })
                }

                /**
                 * Toggle .header-scrolled class to #header when page is scrolled
                 */
                let selectHeader = select('#header')
                if (selectHeader) {
                    const headerScrolled = () => {
                        if (window.scrollY > 100) {
                            selectHeader.classList.add('header-scrolled')
                        } else {
                            selectHeader.classList.remove('header-scrolled')
                        }
                    }
                    window.addEventListener('load', headerScrolled)
                    onscroll(document, headerScrolled)
                }

                /**
                 * Back to top button
                 */
                let backtotop = select('.back-to-top')
                if (backtotop) {
                    const toggleBacktotop = () => {
                        if (window.scrollY > 100) {
                            backtotop.classList.add('active')
                        } else {
                            backtotop.classList.remove('active')
                        }
                    }
                    window.addEventListener('load', toggleBacktotop)
                    onscroll(document, toggleBacktotop)
                }

                /**
                 * Mobile nav toggle
                 */
                on('click', '.mobile-nav-toggle', function(e) {
                    select('#navbar').classList.toggle('navbar-mobile')
                    this.classList.toggle('bi-list')
                    this.classList.toggle('bi-x')
                })

                /**
                 * Mobile nav dropdowns activate
                 */
                on('click', '.navbar .dropdown > a', function(e) {
                    if (select('#navbar').classList.contains('navbar-mobile')) {
                        e.preventDefault()
                        this.nextElementSibling.classList.toggle('dropdown-active')
                    }
                }, true)

                /**
                 * Scrool with ofset on links with a class name .scrollto
                 */
                on('click', '.scrollto', function(e) {
                    if (select(this.hash)) {
                        e.preventDefault()

                        let navbar = select('#navbar')
                        if (navbar.classList.contains('navbar-mobile')) {
                            navbar.classList.remove('navbar-mobile')
                            let navbarToggle = select('.mobile-nav-toggle')
                            navbarToggle.classList.toggle('bi-list')
                            navbarToggle.classList.toggle('bi-x')
                        }
                        scrollto(this.hash)
                    }
                }, true)

                /**
                 * Scroll with ofset on page load with hash links in the url
                 */
                window.addEventListener('load', () => {
                    if (window.location.hash) {
                        if (select(window.location.hash)) {
                            scrollto(window.location.hash)
                        }
                    }
                });
            },
        },

        props: ['canLogin', 'canRegister', 'issues', 'dashboardAccess'],
    })
</script>

<style>
/*--------------------------------------------------------------
# General
--------------------------------------------------------------*/
body {
    color: #444444;
}

a {
    color: #14c871;
    text-decoration: none;
}

a:hover {
    color: #206bfb;
    text-decoration: none;
}

.container {
    max-width: 1320px !important;
}

/*--------------------------------------------------------------
# Sections General
--------------------------------------------------------------*/
section {
    padding: 60px 0;
    overflow: hidden;
}

.section-bg {
    background-color: #f9f9fa;
}

.section-title {
    text-align: center;
    padding: 30px 0;
    position: relative;
}
.section-title h2 {
    font-size: 32px;
    font-weight: 700;
    text-transform: uppercase;
    margin-bottom: 20px;
    padding-bottom: 0;
    color: #5f687b;
    position: relative;
    z-index: 2;
}
.section-title span {
    position: absolute;
    top: 30px;
    color: #f0f1f3;
    left: 0;
    right: 0;
    z-index: 1;
    font-weight: 700;
    font-size: 52px;
    text-transform: uppercase;
    line-height: 0;
}
.section-title p {
    margin-bottom: 0;
    position: relative;
    z-index: 2;
}
@media (max-width: 575px) {
    .section-title h2 {
        font-size: 28px;
        margin-bottom: 15px;
    }
    .section-title span {
        font-size: 38px;
    }
}

/*--------------------------------------------------------------
# Back to top button
--------------------------------------------------------------*/
.back-to-top {
    position: fixed;
    visibility: hidden;
    opacity: 0;
    right: 15px;
    bottom: 15px;
    z-index: 996;
    background: #16df7e;
    width: 40px;
    height: 40px;
    border-radius: 4px;
    transition: all 0.4s;
}
.back-to-top i {
    font-size: 24px;
    color: #fff;
    line-height: 0;
}
.back-to-top:hover {
    background: #33eb92;
    color: #fff;
}
.back-to-top.active {
    visibility: visible;
    opacity: 1;
}
</style>
