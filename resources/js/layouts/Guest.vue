<template>
  <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div>
      <button>
        <BreezeApplicationLogo class="w-20 h-20 fill-current text-gray-500"/>
      </button>
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
      <slot/>
    </div>
  </div>
</template>

<script>
import BreezeApplicationLogo from '@/components/ApplicationLogo.vue';

import { defineComponent } from 'vue';

export default defineComponent({
  name: 'Guest',
  components: {
    BreezeApplicationLogo,
  },
  setup() {


    return {};
  },
});
</script>