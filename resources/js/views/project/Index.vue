<template>
  <div class="p-10">
    <div class="flex justify-between items-center">
      <h1 class="text-4xl">Projects</h1>
      <AppModalButton
          v-slot="modal"
          text="Create new"
          cssClass="bg-primary-600 text-white hover:bg-primary-900 px-6 py-2.5 rounded-xl font-medium"
      >
        <ProjectCreateUpdateModal
            :modal="modal"
            @projectCreated="fetchProjects"
        />
      </AppModalButton>
    </div>
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

import AppModalButton           from '@/components/AppModalButton.vue';
import ProjectCreateUpdateModal from '@/components/ProjectCreateUpdateModal.vue';

import useUser from '@/composables/useUser';
import useHttp from '@/composables/useHttp';

export default defineComponent({
  name: 'project/Index',
  components: {
    AppModalButton,
    ProjectCreateUpdateModal,

  },
  setup() {
    /* Composables */
    const { authUser } = useUser();
    const http = useHttp();

    /* Event handlers */
    const fetchProjects = () => {
      http.get('/api/project');
    };

    /* Lifecycle hooks */
    onMounted(() => {
      fetchProjects();
    });


    return {
      /* Component properties */
      http,
      authUser,

      /* Event handlers */
      fetchProjects,
    };
  },
});
</script>
