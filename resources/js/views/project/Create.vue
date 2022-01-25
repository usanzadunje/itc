<template>
  <div>
    CREATE PROJECT

    {{ authUser }}
  </div>
</template>

<script>
import { defineComponent } from 'vue';
import useUser             from '@/composables/useUser';

export default defineComponent({
  name: 'project/Create',
  components: {},
  setup() {
    const { authUser } = useUser();

    return {
      authUser,
    };
  },
});
</script>
