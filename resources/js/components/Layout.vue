<template>
  <div class="flex justify-center">
    <div class="container">
      <slot/>
    </div>
  </div>
</template>

<script>
import { defineComponent } from 'vue';

export default defineComponent({
  name: 'Layout',
  components: {},
  setup() {


    return {};
  },
});
</script>