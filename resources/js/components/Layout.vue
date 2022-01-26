<template>
  <AppNav/>
  <div class="flex justify-center">
    <div class="container">
      <router-view/>
    </div>
  </div>
</template>

<script>
import { defineComponent } from 'vue';

import AppNav from '@/components/AppNav.vue';

export default defineComponent({
  name: 'Layout',
  components: {
    AppNav,
  },
  setup() {


    return {};
  },
});
</script>