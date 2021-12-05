<template>
    <!-- Header Section -->
    <Header :isHomePage="false" :can-login="canLogin" :can-register="canRegister" :dashboardAccess="dashboardAccess"/>

    <div class="container">
        <div class="row">
            <div class="col">
                <div ref="mapDiv" style="width: 100%; height: 100%" />
            </div>
            <div class="col" style="height: 91vh; background-color: #f9f9fa">
                <!-- Form -->
                <form class="mt-4" @submit.prevent="submit">
                    <jet-label value="Lokacija" />
                    <span v-if="selectedPos">
                        Geografska širina: <b>{{ selectedPos.lat.toFixed(4) }}</b>, Geografska dužina:
                        <b>{{ selectedPos.lng.toFixed(4) }}</b>
                    </span>
                    <span v-else>Odaberite mjesto na mapi</span>
                    <jet-input-error :message="form.errors.latitude" class="mt-2" />
                    <jet-input-error :message="form.errors.longitude" class="mt-2" />

                    <div class="mt-4">
                        <jet-label for="title" value="Naslov" />
                        <jet-input id="title" type="text" class="mt-1 block w-3/4" v-model="form.title" required autofocus autocomplete="title" />
                    </div>

                    <div class="mt-4">
                        <jet-label for="description" value="Opis" />
                        <jet-input id="description"
                                   type="text"
                                   class="mt-1 block w-3/4"
                                   v-model="form.description" required />
                    </div>

                    <div class="mt-4">
                        <jet-label value="Prioritet"/>
                        <select class="mt-1 block w-3/4 border-gray-300
                                    focus:border-indigo-300 focus:ring focus:ring-indigo-200
                                    focus:ring-opacity-50 rounded-md shadow-sm"
                                @change="selectedPriority($event)">
                            <option v-for="priority in priorities"
                                    :value="priority.id">
                                {{priority.name}}</option>
                        </select>
                        <jet-input-error :message="form.errors.priority" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <jet-label value="Kategorija"/>
                        <select class="mt-1 block w-3/4 border-gray-300
                                    focus:border-indigo-300 focus:ring focus:ring-indigo-200
                                    focus:ring-opacity-50 rounded-md shadow-sm"
                                @change="selectedCategory($event)">
                            <option v-for="category in categoriesList" :value="category.id">{{category.name}}</option>
                        </select>

                        <jet-input-error :message="form.errors.category_id" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <jet-label value="Grad"/>
                        <select class="mt-1 block w-3/4 border-gray-300
                                    focus:border-indigo-300 focus:ring focus:ring-indigo-200
                                    focus:ring-opacity-50 rounded-md shadow-sm"
                                @change="selectedCity($event)">
                            <option v-for="city in citiesList" :value="city.id">{{city.name}}</option>
                        </select>

                        <jet-input-error :message="form.errors.city_id" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <jet-label value="Distrikt"/>
                        <select class="mt-1 block w-3/4 border-gray-300
                                    focus:border-indigo-300 focus:ring focus:ring-indigo-200
                                    focus:ring-opacity-50 rounded-md shadow-sm"
                                @change="selectedDistrict($event)">
                            <option v-for="district in districtsList" :value="district.id">{{district.name}}</option>
                        </select>

                        <jet-input-error :message="form.errors.district_id" class="mt-2" />
                    </div>



                    <div class="mt-5">
                        <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Prijavi
                        </jet-button>
                    </div>
                </form>
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
import JetInput from '@/Jetstream/Input.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetInputError from '@/Jetstream/InputError.vue'
import JetButton from '@/Jetstream/Button.vue'

const GOOGLE_MAPS_API_KEY = 'AIzaSyAZdwXBzrBmWr0oD9ZFC8_jaRD2us5GPmc'

export default defineComponent({
    components: {
        Link,
        Header,
        Loader,
        JetLabel,
        JetInput,
        JetInputError,
        JetButton,
    },
    data() {
        return {
            form: this.$inertia.form({
                title: '',
                description: '',
                priority: 1,
                category_id: 1,
                city_id: 1,
                district_id: 1,
                latitude: '',
                longitude: '',
            }),

            categoriesList: this.categories,
            citiesList: this.cities,
            districtsList: this.districts.filter((district) => district.city_id == 1),

            priorities: [
                {
                    id:1,
                    name: 'Umjereno'
                },
                {
                    id:2,
                    name: 'Važno'
                },
                {
                    id:3,
                    name: 'Hitno'
                },
            ],
        }
    },
    props: ['canLogin', 'canRegister', 'dashboardAccess', 'categories', 'cities', 'districts'],
    methods: {
        submit() {
            if(this.selectedPos !== null) {
                this.form.latitude = this.selectedPos.lat
                this.form.longitude = this.selectedPos.lng
            }
            this.form.post(this.route('issues.store'), {
                onFinish: () => console.log('Done'),
            })
        },
        selectedPriority(e) {
            this.form.priority = e.target.value
        },
        selectedCity: function (e) {
            this.form.city_id = e.target.value
            this.districtsList = this.districts.filter((district) => district.city_id == e.target.value)
            this.form.district_id = this.districtsList[0]
        },
        selectedCategory(e) {
            this.form.category_id = e.target.value
        },
        selectedDistrict(e) {
            this.form.district_id = e.target.value
        },
    },

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

        return { selectedPos, mapDiv, initPos }
    }
})
</script>

<style scoped>
.container {
    margin-top: 5rem;
    max-width: 100% !important;
}
</style>
