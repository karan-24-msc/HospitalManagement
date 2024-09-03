<script setup>
import {Head, useForm} from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {ref} from "vue";
import Checkbox from "@/Components/Checkbox.vue";

const showPassword = ref(false)

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const togglePasswordVisibility = () => {
    showPassword.value = !showPassword.value
}

const getImageUrl = (imagePath) => {
    return `http://127.0.0.1:8000/${imagePath}`;
}
const submit = () => {
    console.log(form)
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Log in" />
    <!-- MAIN CONTENT -->
    <div class="main">

        <div class="main-content">
            <section class="login">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-5">
                        <div class="box_login">
                            <div class="box-header d-flex justify-content-between">
                                <a href="index.html">
                                    <img :src="getImageUrl($page.props.siteInformation?.logo)" alt="">
                                </a>

                                <div class="action-reg">
                                    <h4 class="fs-30">Login</h4>
                                </div>

                            </div>
                            <div class="line"></div>
                            <div class="box-body">
                                <div class="auth-content my-auto">

                                    <form class="mt-5 pt-5" @submit.prevent="submit">
                                        <div class="mb-24">
                                            <label class="form-label mb-14">Mail or User Name</label>
                                            <input type="text" v-model="form.email" class="form-control" id="username" placeholder="Your Email">
                                            <InputError class="mt-2" :message="form.errors.email" />
                                        </div>
                                        <div class="mb-16">
                                            <div class="d-flex align-items-start">
                                                <div class="flex-grow-1">
                                                    <label class="form-label mb-14">Password</label>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <div class="">
                                                        <a href="#" class="text-muted">Forgot password?</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="input-group auth-pass-inputgroup">
                                                <input
                                                    class="form-control"
                                                    v-model="form.password"
                                                    placeholder="Enter password"
                                                    aria-label="Password"
                                                    :aria-describedby="showPassword ? 'password-addon' : null"
                                                    :type="showPassword ? 'text' : 'password'"
                                                >
                                                <button
                                                    class="btn shadow-none ms-0"
                                                    type="button"
                                                    @click="togglePasswordVisibility"
                                                    :id="showPassword ? 'hide-addon' : 'show-addon'"
                                                >
                                                    {{ showPassword ? 'Hide' : 'Show' }}
                                                </button>
                                            </div>
                                        </div>
                                        <div class="row mb-29">
                                            <div class="col">
                                                <div class="form-check">
                                                    <Checkbox v-model:checked="form.remember" class="form-check-input" name="remember" id="remember-check"/>
                                                    <label class="form-check-label fs-14" for="remember-check">
                                                        Remember me
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="mb-3">
                                            <PrimaryButton class="btn bg-primary color-white w-100 waves-effect waves-light fs-18 font-w500" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                                Sign in
                                            </PrimaryButton>
                                        </div>
                                    </form>

                                    <div class="mt-20 pt-2 text-center">
                                        <div class="signin-other-title">
                                            <a href="{{ route('password.request') }}" class="text-muted fs-14">Forgot password?</a>
                                        </div>

                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-5"></div>
                </div>
            </section>
        </div>
    </div>
    <!-- END MAIN CONTENT -->

    <div class="overlay"></div>
</template>
