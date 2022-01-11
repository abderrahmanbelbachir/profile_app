<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                       Hi {{$page.props.user.first_name}} , You're logged in!
                    </div>
                </div>

                <BreezeValidationErrors class="mb-4" />

                <div class="profile-nav mt-4">
                    <BreezeButton class="ml-4" @click="switchStep(1)"
                                  :class="{ 'active': step === 1 }">
                        Personal information
                    </BreezeButton>
                    <BreezeButton class="ml-4" @click="switchStep(2)"
                                  :class="{ 'active': step === 2 }">
                        Work experience
                    </BreezeButton>
                    <BreezeButton class="ml-4" @click="switchStep(3)"
                                  :class="{ 'active': step === 3 }">
                        Organization associations
                    </BreezeButton>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-8">
                    <div class="p-6 bg-white border-b border-gray-200" v-if="step === 1">
                        <form @submit.prevent="submitInfo">
                            <div>
                                <BreezeLabel for="first_name" value="First Name" />
                                <BreezeInput id="first_name" type="text" class="mt-1 block w-full" v-model="form.first_name" required autofocus autocomplete="first_name" />
                            </div>

                            <div class="mt-4">
                                <BreezeLabel for="last_name" value="Last Name" />
                                <BreezeInput id="last_name" type="text" class="mt-1 block w-full" v-model="form.last_name" required autofocus autocomplete="last_name" />
                            </div>

                            <div class="mt-4">
                                <BreezeLabel for="email" value="Email" />
                                <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autocomplete="username" />
                            </div>


                            <div class="flex items-center justify-end mt-4">

                                <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Save
                                </BreezeButton>
                            </div>
                        </form>
                    </div>

                    <div class="p-6 bg-white border-b border-gray-200" v-if="step === 2">
                        <form @submit.prevent="submitExperience">


                            <div class="mt-4">
                                <h1>Work Experience</h1>
                                <BreezeButton class="ml-4"
                                              :type="'button'" @click="addExperience">
                                    Add experience
                                </BreezeButton>
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="p-6 bg-white border-b border-gray-200" v-for="experience of form.experiences">
                                        <div class="md:grid-cols-2">
                                            <div class="mt-4">
                                                <BreezeLabel for="company" value="Company" />
                                                <BreezeInput id="company" type="text"
                                                             class="mt-1 block w-full" v-model="experience.company"
                                                             required autocomplete="off" />
                                            </div>

                                            <div class="mt-4">
                                                <BreezeLabel for="role" value="Role" />
                                                <BreezeInput id="role" type="text"
                                                             class="mt-1 block w-full" v-model="experience.role"
                                                             required autocomplete="off" />
                                            </div>
                                        </div>
                                        <div class="md:grid-cols-2">
                                            <div class="mt-4">
                                                <BreezeLabel for="start_experience" value="Start Date" />
                                                <BreezeInput id="start_experience" type="date"
                                                             class="mt-1 block w-full" v-model="experience.start_date"
                                                             required autocomplete="off" />
                                            </div>

                                            <div class="mt-4" v-if="!experience.current_job">
                                                <BreezeLabel for="end_experience" value="End Date" />
                                                <BreezeInput id="end_experience" type="date"
                                                             class="mt-1 block w-full" v-model="experience.end_date"
                                                             required autocomplete="off" />
                                            </div>
                                            <div class="mt-4">
                                                <BreezeCheckbox :checked="experience.current_job ? true : false"
                                                                v-on:update:checked="experience.current_job = !experience.current_job"></BreezeCheckbox>
                                                <span class="inline-flex ml-2">Current job</span>
                                            </div>
                                        </div>

                                        <div class="grid-cols-1">
                                            <div class="mt-4">
                                                <BreezeLabel for="description" value="Description" />
                                                <textarea id="description" type="text"
                                                          class="mt-1 block w-full" v-model="experience.description"
                                                          required autocomplete="off" cols="5" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="flex items-center justify-end mt-4">

                                <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Save
                                </BreezeButton>
                            </div>
                        </form>
                    </div>

                    <div class="p-6 bg-white border-b border-gray-200" v-if="step === 3">
                        <form @submit.prevent="submitOrganization">


                            <div class="mt-4">
                                <h1>Organization associations</h1>
                                <BreezeButton class="ml-4"
                                              :type="'button'" @click="addOrganization">
                                    Add Association
                                </BreezeButton>
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="p-6 bg-white border-b border-gray-200" v-for="organization of form.organizations">
                                        <div class="md:grid-cols-2">
                                            <div class="mt-4">
                                                <BreezeLabel for="organization_name" value="Organization" />
                                                <BreezeInput id="organization_name" type="text"
                                                             class="mt-1 block w-full" v-model="organization.organization"
                                                             required autocomplete="off" />
                                            </div>

                                            <div class="mt-4">
                                                <BreezeLabel for="role" value="Associated as" />
                                                <BreezeInput id="associated_as" type="text"
                                                             class="mt-1 block w-full" v-model="organization.associated_as"
                                                             required autocomplete="off" />
                                            </div>
                                        </div>
                                        <div class="md:grid-cols-2">
                                            <div class="mt-4">
                                                <BreezeLabel for="start_organization" value="Start Date" />
                                                <BreezeInput id="start_organization" type="date"
                                                             class="mt-1 block w-full" v-model="organization.start_date"
                                                             required autocomplete="off" />
                                            </div>

                                            <div class="mt-4" v-if="!organization.current_job">
                                                <BreezeLabel for="end_organization" value="End Date" />
                                                <BreezeInput id="end_organization" type="date"
                                                             class="mt-1 block w-full" v-model="organization.end_date"
                                                             required autocomplete="off" />
                                            </div>
                                            <div class="mt-4">
                                                <BreezeCheckbox :checked="organization.current_job ? true : false"
                                                                v-on:update:checked="organization.current_job = !organization.current_job"></BreezeCheckbox>
                                                <span class="inline-flex ml-2">Current organization</span>
                                            </div>
                                        </div>

                                        <div class="grid-cols-1">
                                            <div class="mt-4">
                                                <BreezeLabel for="organization_description" value="Description" />
                                                <textarea id="organization_description" type="text"
                                                          class="mt-1 block w-full" v-model="organization.description"
                                                          required autocomplete="off" cols="5" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="flex items-center justify-end mt-4">

                                <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Save
                                </BreezeButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'

import BreezeButton from '@/Components/Button.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import BreezeCheckbox from '@/Components/Checkbox.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
        Link,
        BreezeCheckbox
    },
    data() {
        return {
            form: this.$inertia.form({
                first_name: this.$page.props.user.first_name,
                last_name: this.$page.props.user.last_name,
                email: this.$page.props.user.email,
                experiences:    this.$page.props.user.experiences &&
                                this.$page.props.user.experiences.length > 0 ?
                                this.$page.props.user.experiences :
                                [{
                                    start_date: '',
                                    end_date: '',
                                    company: '',
                                    role: '',
                                    description: '',
                                    current_job: false
                                }],
                organizations:    this.$page.props.user.organizations &&
                this.$page.props.user.organizations.length > 0 ?
                    this.$page.props.user.organizations :
                    [{
                        start_date: '',
                        end_date: '',
                        name: '',
                        associated_as: '',
                        description: '',
                        current_job: false
                    }],
            }),
            step: 1
        }
    },
    mounted() {
        console.log('mounted here ' , this.$page);
    },
    methods: {
        submitInfo() {
            console.log('going to submit update info : ' , this.form);
            this.form.post(this.route('profile.update'), {
                onFinish: (result) => {
                    this.refreshUser();
                },
            })
        },
        submitExperience() {
            console.log('going to submit update experience : ' , this.form);
            this.form.post(this.route('experience.update'), {
                onFinish: (result) => {
                    this.refreshUser();
                },
            })
        },
        submitOrganization() {
            console.log('going to submit update organization : ' , this.form);
            this.form.post(this.route('organization.update'), {
                onFinish: (result) => {
                    this.refreshUser();
                },
            })
        },
        addExperience() {
            this.form.experiences.push({
                start_date: '',
                end_date: '',
                company: '',
                role: '',
                description: '',
                current_job: false
            });
        },
        addOrganization() {
            this.form.organizations.push({
                start_date: '',
                end_date: '',
                organization: '',
                associated_as: '',
                description: '',
                current_job: false
            });
        },
        refreshUser() {
            axios.get(`/user`)
                .then(({data}) => {
                    this.$page.props.user = data;
                    this.form.first_name = this.$page.props.user.first_name;
                    this.form.last_name = this.$page.props.user.last_name;
                    this.form.email = this.$page.props.user.email;
                    this.form.experiences = this.$page.props.user.experiences &&
                        this.$page.props.user.experiences.length > 0 ?
                        this.$page.props.user.experiences :
                        [{
                            start_date: '',
                            end_date: '',
                            company: '',
                            role: '',
                            description: '',
                            current_job: false
                        }];
                    this.form.organizations = this.$page.props.user.organizations &&
                        this.$page.props.user.organizations.length > 0 ?
                        this.$page.props.user.organizations :
                        [{
                            start_date: '',
                            end_date: '',
                            name: '',
                            associated_as: '',
                            description: '',
                            current_job: false
                        }];
                })
                .catch((error) => {
                    console.log('error refreshing user ! ' , error);
                });
        },
        switchStep(step) {
            this.step = step;
        }
    }
}
</script>
