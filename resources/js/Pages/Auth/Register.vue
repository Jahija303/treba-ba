<template>
    <Head title="Register" />

    <jet-authentication-card :large="true">
        <template #logo>
            <jet-authentication-card-logo />
        </template>

        <jet-validation-errors class="mb-4" />

        <form @submit.prevent="submit">
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <div>
                            <div>
                                <jet-label for="firstname" value="First name" />
                                <jet-input id="firstname" type="text" class="mt-1 block w-full" v-model="form.firstname" required autofocus autocomplete="firstname" />
                            </div>

                            <div class="mt-4">
                                <jet-label for="lastname" value="Last name" />
                                <jet-input id="lastname" type="text" class="mt-1 block w-full" v-model="form.lastname" required />
                            </div>

                            <div class="mt-4">
                                <jet-label value="City"/>
                                <select id="citySelect" class="mt-1 block w-100 border-gray-300
                                    focus:border-indigo-300 focus:ring focus:ring-indigo-200
                                    focus:ring-opacity-50 rounded-md shadow-sm"
                                        @change="selectedCity($event)">
                                    <option v-for="city in cities"
                                            :value="city.id">
                                        {{city.name}}</option>
                                </select>

                                <jet-input-error :message="form.errors.city_id" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <jet-label for="address" value="Address" />
                                <jet-input id="address" type="text" class="mt-1 block w-full" v-model="form.address" required />
                            </div>
                        </div>
                    </div>

                    <div class="col-sm">
                        <div>
                            <div>
                                <jet-label for="email" value="Email" />
                                <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required />
                            </div>

                            <div class="mt-4">
                                <jet-label for="username" value="Username" />
                                <jet-input id="username" type="text" class="mt-1 block w-full" v-model="form.username" required />
                            </div>

                            <div class="mt-4">
                                <jet-label for="password" value="Password" />
                                <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
                            </div>

                            <div class="mt-4">
                                <jet-label for="password_confirmation" value="Confirm Password" />
                                <jet-input id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4" v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature">
                <jet-label for="terms">
                    <div class="flex items-center">
                        <jet-checkbox name="terms" id="terms" v-model:checked="form.terms" />

                        <div class="ml-2">
                            I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Privacy Policy</a>
                        </div>
                    </div>
                </jet-label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Already registered?
                </Link>

                <jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </jet-button>
            </div>
        </form>
    </jet-authentication-card>
</template>

<script>
    import { defineComponent } from 'vue'
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetCheckbox from '@/Jetstream/Checkbox.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
    import JetInputError from '@/Jetstream/InputError.vue'
    import JetDropdown from '@/Jetstream/Dropdown.vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Head,
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            JetButton,
            JetInput,
            JetCheckbox,
            JetLabel,
            JetValidationErrors,
            JetDropdown,
            Link,
            JetInputError,
        },

        props: ['cities'],

        data() {
            return {
                form: this.$inertia.form({
                    firstname: '',
                    lastname: '',
                    city_id: 1,
                    address: '',
                    email: '',
                    username: '',
                    password: '',
                    password_confirmation: '',
                    terms: false,
                })
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('register'), {
                    onFinish: () => this.form.reset('password', 'password_confirmation'),
                })
            },
            selectedCity(e) {
                this.form.city_id = e.target.value
            },
        }
    })
</script>
