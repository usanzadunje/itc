<template>
  <div class="p-10">
    <h1 class="text-4xl ">Projects</h1>
    <div class="grid grid-cols-fit gap-5 mt-6 pb-8">
      <div
          v-for="project in http.response"
          :key="project.id"
          class="relative bg-white rounded-xl h-60 w-full p-8 cursor-pointer hover:scale-95 hover:shadow-md"
      >
        <h2 class="text-center font-light text-3xl">{{ project.name }}</h2>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent, onMounted } from 'vue';

import useUser from '@/composables/useUser';
import useHttp from '@/composables/useHttp';

export default defineComponent({
  name: 'project/Index',
  components: {},
  setup() {
    /* Composables */
    const { authUser } = useUser();
    const http = useHttp();

    onMounted(() => {
      http.get('/api/project');
    });

    return {
      /* Component properties */
      http,
      authUser,
    };
  },
});
</script>
