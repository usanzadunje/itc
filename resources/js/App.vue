<template>
  <router-view/>
</template>

<script>
import { defineComponent } from 'vue';

import useUser from '@/composables/useUser';

export default defineComponent({
  name: 'App',
  setup() {
    const { getAuthUser } = useUser();

    (async() => {
      await getAuthUser();
    })();

    return {};
  },
});
</script>