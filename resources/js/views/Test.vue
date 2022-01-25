<template>
  <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
    <h1>{{ authUser }}</h1>
    <button class="ml-8 bg-blue-300" @click="this.$router.push({name: 'welcome'})">
      GO TO WELCOME
    </button>
  </div>
</template>

<script>
import { defineComponent } from 'vue';
import useUser             from '@/composables/useUser';

export default defineComponent({
  name: 'Test',
  components: {},
  setup() {
    const { authUser } = useUser();

    return {
      authUser,
    };
  },
});
</script>
