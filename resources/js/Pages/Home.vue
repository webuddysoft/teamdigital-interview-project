<script setup>
    import { watch } from "vue";
    import AppHead from "./AppHead.vue";
    import Layout from "./Layout.vue";
    import { useForm } from '@inertiajs/vue3';

    const form = useForm({
        first_name: null,
        last_name: null,
        email: null,
        phone_number: null,
        agree_rules: null,
        subscribed_to_newsletter: null,
    });

    const rules = {
        first_name: ['required'],
        last_name: ['required'],
        email: ['required', ['email', 'Please enter valid email address.']],
        phone_number: ['required'],
        agree_rules: [['required', 'You must agree with our rules.']],
    }

    watch(() => form.first_name, () => validateForm('first_name'));
    watch(() => form.last_name, () => validateForm('last_name'));
    watch(() => form.email, () => validateForm('email'));
    watch(() => form.phone_number, () => validateForm('phone_number'));
    watch(() => form.agree_rules, () => validateForm('agree_rules'));

    function validateForm(field = null) {
        const fields = field === null ? Object.keys(rules) : [field];

        const errors = {};
        let hasError = false;

        fields.forEach((f) => {
            let fieldRules = rules[f];
            let isValid = true;
            fieldRules.forEach((rule) => {
                let message = 'This field is required.';
                if (Array.isArray(rule)) {
                    message = rule[1];
                    rule = rule[0];
                }
                if (isValid) {
                    if (rule === 'required' && !form[f]) {
                        isValid = false;
                        errors[f] = message;
                    } else if (rule === 'email' && !/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(form.email)) {
                        isValid = false;
                        errors[f] = message;
                    }
                }
            });
            form.clearErrors(f);
            if (!isValid) {
                hasError = true;
            }
        });


        if (hasError) {
            form.setError(errors);
        }
        return !hasError;
    }

    function submit() {
        form.clearErrors('save_error');
        if (validateForm()) {
            form.transform((data) => ({
                ...data,
                agree_rules: data.agree_rules ? 1 : null,
                subscribed_to_newsletter: data.subscribed_to_newsletter ? 1 : 0
            }))
            .post('/register', {
                preserveScroll: true
            });
        }
    }
</script>

<template>
    <Layout>
        <AppHead title="Home" />
        <div class="w-full max-w-md mx-auto">
            <form @submit.prevent="submit">
                <div class="form-row">
                    <div class="form-control form-control-half md:mb-0 mb-2" :class="{'has-error': form.errors.first_name}">
                        <label class="input-label" for="first_name">
                            First Name
                            <span class="text-red-500">*</span>
                        </label>
                        <input v-model="form.first_name" id="first_name" type="text" placeholder="First Name" />
                        <div v-if="form.errors.first_name" class="error-info">{{ form.errors.first_name }}</div>
                    </div>
                    <div class="form-control form-control-half" :class="{'has-error': form.errors.last_name}">
                        <label class="input-label" for="last_name">
                            Last Name
                            <span class="text-red-500">*</span>
                        </label>
                        <input v-model="form.last_name" id="last_name" type="text" placeholder="Last Name" />
                        <div v-if="form.errors.last_name" class="error-info">{{ form.errors.last_name }}</div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-control" :class="{'has-error': form.errors.email}">
                        <label class="input-label" for="email">
                            Email
                            <span class="text-red-500">*</span>
                        </label>
                        <input v-model="form.email" id="email" type="text" placeholder="Email" />
                        <div v-if="form.errors.email" class="error-info">{{ form.errors.email }}</div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-control" :class="{'has-error': form.errors.phone_number}">
                        <label class="input-label" for="phone_number">
                            Phone Number
                            <span class="text-red-500">*</span>
                        </label>
                        <input v-model="form.phone_number" id="phone_number" type="text" placeholder="Phone Number" />
                        <div v-if="form.errors.phone_number" class="error-info">{{ form.errors.phone_number }}</div>
                    </div>
                </div>
                <div class="form-row form-checkbox-row">
                    <div class="form-control" :class="{'has-error': form.errors.agree_rules}">
                        <label class="input-label" for="agree_rules">
                            <input v-model="form.agree_rules" type="checkbox" name="agree_rules" id="agree_rules" />
                            <span>I agree with the rules. <b class="text-red-500">*</b></span>
                        </label>
                        <div v-if="form.errors.agree_rules" class="error-info">{{ form.errors.agree_rules }}</div>
                    </div>
                </div>
                <div class="form-row form-checkbox-row">
                    <div class="form-control">
                        <label class="input-label" for="subscribed_to_newsletter">
                            <input v-model="form.subscribed_to_newsletter" type="checkbox" name="subscribed_to_newsletter" id="subscribed_to_newsletter" value="0" />
                            <span>Subscribe to newsletter</span>
                        </label>
                    </div>
                </div>
                <div v-if="form.errors.save_error" class="mb-3">
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block">{{ form.errors.save_error }}</span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-control text-right">
                        <button v-if="form.isDirty" type="button" :disabled="form.processing" @click="[form.reset(), form.clearErrors()]">Clear</button>
                        <button type="submit" :disabled="form.processing">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </Layout>
</template>

<style scoped>
    form{
        @apply bg-white shadow-md border rounded px-8 py-6 my-8;
    }
    .form-row{
        @apply flex flex-wrap -mx-3 mb-2;
    }
    .form-control{
        @apply w-full px-3 mb-2;
    }
    .form-control-half{
        @apply md:w-1/2;
    }
    .input-label{
        @apply block tracking-wide text-gray-700 font-bold mb-2;
    }
    input[type="text"]{
        @apply appearance-none block w-full bg-gray-50 text-gray-700 border rounded py-3 px-4 mb-0 leading-tight focus:outline-none focus:bg-white focus:border-gray-500;
    }
    input[type="checkbox"]{
        @apply w-5 h-5 mr-2 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600;
    }
    .form-checkbox-row .input-label{
        @apply flex items-center mb-0;
    }
    .form-control.has-error input[type="text"]{
        @apply bg-red-50 border-red-500 focus:bg-white
    }
    .form-checkbox-row .form-control.has-error .input-label{
        @apply text-red-500;
    }
    .error-info{
        @apply text-red-500 text-xs italic;
    }
    button[type="submit"]{
        @apply font-bold py-2 px-4 rounded bg-blue-500 text-white;
    }
    button[type="submit"]:hover{
        @apply bg-blue-700
    }
    button[type="button"]{
        @apply font-bold py-2 px-4 rounded bg-gray-500 text-white mr-3;
    }
    button[type="button"]:hover{
        @apply bg-gray-700;
    }
</style>
