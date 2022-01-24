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
  </div>
</template>

<script>
import { defineComponent } from 'vue';

export default defineComponent({
  name: 'Welcome',
  components: {},
  setup() {
    return {};
  },
});
</script>
