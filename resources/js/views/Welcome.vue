<template>
  <div>
    <h1 class="text-3xl">WELCOME</h1>
    <button
        class="text-sm text-gray-700 underline"
        @click="this.$router.push({name: 'login'})"
    >
      Log in
    </button>

    <button
        class="ml-4 text-sm text-gray-700 underline"
        @click="this.$router.push({name: 'register'})"
    >
      Register
    </button>

    <div class="mt-8 bg-red-300">
      <button class="ml-8 bg-blue-300" @click="this.$router.push({name: 'test'})">
        GO TO TEST
      </button>
    </div>
  </div>
</template>

<script>
import { defineComponent } from 'vue';
import useUser             from '@/composables/useUser';

export default defineComponent({
  name: 'Welcome',
  components: {},
  setup() {

    return {
    };
  },
});
</script>
