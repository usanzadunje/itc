<template>
  <div class="flex items-center justify-center h-screen">
    <div class="flex flex-col justify-between h-full">
      <AppNav />
      <h1 class="text-3xl">WELCOME</h1>
      <AppLogo/>


      <div class="mt-8 bg-red-300">
        <button class="ml-8 bg-blue-300" @click="this.$router.push({name: 'test'})">
          GO TO TEST
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent } from 'vue';

import AppLogo from '@/components/AppLogo.vue';
import AppNav from '@/components/AppNav.vue';

import useUser from '@/composables/useUser';

export default defineComponent({
  name: 'Welcome',
  components: {
    AppLogo,
    AppNav,
  },
  setup() {

    return {

    };
  },
});
</script>
