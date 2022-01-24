<template>
  <div class="flex h-screen bg-primary-100 p-4 sm:p-16 md:py-14 md:px-44">
    <div
        class="w-full h-full xl:w-1/2 flex flex-col items-center justify-between px-8 sm:px-28 md:px-44 bg-white rounded-l-xl">
      <div class="w-full h-full flex flex-col justify-center ">
        <div>
          <i class="fas fa-bolt text-primary-600 text-5xl"></i>
        </div>
        <div class="mt-6">
          <h1 class="text-3xl font-semibold">{{ heading }}</h1>
          <p class="mt-2 text-gray-600">Track your time!</p>
        </div>
        <slot name="left"></slot>
      </div>
      <div class="w-full font-medium text-gray-400 mb-8">
        <i class="far fa-copyright"></i> 2022 ProjekatC All rights reserved.
      </div>
    </div>
    <div class="hidden xl:block w-1/2">
      <slot name="right"></slot>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';


export default defineComponent({
  name: 'AuthLayout',
  components: {},
  props: {
    heading: {
      type: String,
    },
  },
  setup() {
    return {};
  },
});
</script>