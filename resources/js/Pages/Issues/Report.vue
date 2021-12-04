<template>
    <!-- Header Section -->
    <Header :isHomePage="false" :can-login="canLogin" :can-register="canRegister" :dashboardAccess="dashboardAccess"/>

    <div class="container">
        <div class="row">
            <div class="col">
                <div ref="mapDiv" style="width: 100%; height: 100%" />
            </div>
            <div class="col" style="height: 91vh;">
                <h4>Clicked Position</h4>
                <span v-if="selectedPos">
                    Latitude: {{ selectedPos.lat.toFixed(2) }}, Longitude:
                    {{ selectedPos.lng.toFixed(2) }}
                  </span>
                <span v-else>Click the map to select a position</span>
            </div>
        </div>
    </div>

</template>

<script>
import { defineComponent } from 'vue'
import { Link } from '@inertiajs/inertia-vue3'
import Header from "../../Components/LandingPage/Header"
import { Loader } from '@googlemaps/js-api-loader'
import { computed, ref, onMounted, onUnmounted, watch } from 'vue'

const GOOGLE_MAPS_API_KEY = 'AIzaSyCGCUEXJ0zXCXOo1rvBLi829ewqjobWI5M'

export default defineComponent({
    components: {
        Link,
        Header,
        Loader,
    },
    props: ['canLogin', 'canRegister', 'dashboardAccess'],
    setup() {
        const initPos = computed(() => ({
            lat: 44.203357,
            lng: 17.907075
        }))
        const selectedPos = ref(null)
        const loader = new Loader({ apiKey: GOOGLE_MAPS_API_KEY })
        const mapDiv = ref(null)
        let map = ref(null)
        let clickListener = null

        onMounted(async () => {
            await loader.load()
            map.value = new google.maps.Map(mapDiv.value, {
                center: initPos.value,
                zoom: 15
            })
            clickListener = map.value.addListener(
                'click',
                ({ latLng: { lat, lng } }) =>
                    (selectedPos.value = { lat: lat(), lng: lng() })
            )
        })
        onUnmounted(async () => {
            if (clickListener) clickListener.remove()
        })

        let marker = null
        watch([map, selectedPos], () => {
            if (marker) marker.setMap(null)
            if (map.value && selectedPos.value != null)
                marker = new google.maps.Marker({
                    position: selectedPos.value,
                    map: map.value,
                })
        })

        return { selectedPos, mapDiv }
    }
})
</script>

<style scoped>
.container {
    margin-top: 5rem;
    max-width: 100% !important;
}
</style>
