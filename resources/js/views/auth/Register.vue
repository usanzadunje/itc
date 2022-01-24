<template>
  <AuthLayout heading="Sign up">
    <template v-slot:left>
      <form @submit.prevent="register">
        <AppInput
            :required="true"
            label="Email"
            type="text"
            v-model="form.email"
            :error="form.errors.email"
            placeholder="mail@website.com"
        />
        <AppInput
            :required="true"
            label="Password"
            type="password"
            v-model="form.password"
            :error="form.errors.password"
            placeholder="Min. 8 characters"
            class="mt-4"
        />
        <AppInput
            :required="true"
            label="Confirm Password"
            type="password"
            v-model="form.password_confirmation"
            :error="form.errors.password"
            placeholder="Confirm password"
            class="mt-4"
        />
        <button
            :loading="form.processing"
            class="bg-primary-600 hover:bg-primary-900 w-full rounded-full mt-6 py-3 px-6 text-white font-medium"
        >
          Sign up
        </button>
        <div class="mt-8 font-medium">
          <p>
            Already have an account?
            <button class="text-primary-600 font-semibold" @click="this.$router.push({name:'login'})">
              Sign in
            </button>
          </p>
        </div>
      </form>
    </template>
    <template v-slot:right>
      <div class="w-full h-full register-image rounded-r-xl">
      </div>
    </template>
  </AuthLayout>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

import AuthLayout from '@/components/AuthLayout.vue';
import AppInput   from '@/components/AppInput.vue';

import { useForm } from '@composables/useForm';

export default defineComponent({
  name: 'Register',
  components: {
    AuthLayout,
    AppInput,
  },
  setup() {
    /* Component properties */
    const form = useForm({
      email: null,
      password: null,
      password_confirmation: null,
      tos: false,
    });

    /* Event handlers */
    const register = () => {
      form.post('/register');
    };

    return {
      /* Component properties */
      form,

      /* Event handlers */
      register,

      /* Helpers */
    };
  },
});
</script>
<style>
.register-image {
  background-color: #3521B5;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 200 200'%3E%3Cdefs%3E%3ClinearGradient id='a' gradientUnits='userSpaceOnUse' x1='100' y1='33' x2='100' y2='-3'%3E%3Cstop offset='0' stop-color='%23000' stop-opacity='0'/%3E%3Cstop offset='1' stop-color='%23000' stop-opacity='1'/%3E%3C/linearGradient%3E%3ClinearGradient id='b' gradientUnits='userSpaceOnUse' x1='100' y1='135' x2='100' y2='97'%3E%3Cstop offset='0' stop-color='%23000' stop-opacity='0'/%3E%3Cstop offset='1' stop-color='%23000' stop-opacity='1'/%3E%3C/linearGradient%3E%3C/defs%3E%3Cg fill='%232316aa' fill-opacity='0.6'%3E%3Crect x='100' width='100' height='100'/%3E%3Crect y='100' width='100' height='100'/%3E%3C/g%3E%3Cg fill-opacity='0.5'%3E%3Cpolygon fill='url(%23a)' points='100 30 0 0 200 0'/%3E%3Cpolygon fill='url(%23b)' points='100 100 0 130 0 100 200 100 200 130'/%3E%3C/g%3E%3C/svg%3E");
}
</style>