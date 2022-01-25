<template>
  <div class="flex items-center justify-center h-screen">
    <div class="flex flex-col justify-between h-full">
      <AppNav/>

      <div>
        <h1 class="text-6xl text-center font-medium hover:text-primary-900">Track your time</h1>
        <AppLogo class="mt-12"/>
      </div>


      <button class="ml-8 bg-blue-200" @click="this.$router.push({name: 'test'})">
        GO TO TEST
      </button>
    </div>
  </div>
</template>

<script>
import { defineComponent } from 'vue';

import AppLogo from '@/components/AppLogo.vue';
import AppNav  from '@/components/AppNav.vue';

export default defineComponent({
  name: 'Welcome',
  components: {
    AppLogo,
    AppNav,
  },
  setup() {

    return {};
  },
});
</script>
