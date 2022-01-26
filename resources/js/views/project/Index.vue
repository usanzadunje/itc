<template>
  <div class="p-10">
    <div class="flex justify-between items-center">
      <h1 class="text-4xl">Projects</h1>
      <button
          class="bg-primary-600 text-white hover:bg-primary-900 px-6 py-2.5 rounded-xl font-medium"
          @click="openModal(true)"
      >
        Create new
      </button>
    </div>
    <div class="grid grid-cols-fit gap-5 mt-6 pb-8">
      <div
          v-for="project in http.response"
          :key="project.id"
          class="relative bg-white rounded-xl h-60 w-full p-8 cursor-pointer hover:scale-95 hover:shadow-md"
          @click="openModal(true, project)"
      >
        <h2 class="text-center font-light text-3xl">{{ project.name }}</h2>
        <button
            class="absolute bottom-8 right-8 text-3xl text-red-600 rounded-md hover:opacity-70"
            @click="destroyProject($event, project.id)"
        >
          <i class="fas fa-trash-alt"></i>
        </button>
      </div>
    </div>
    <AppModal
        :is-open="isOpen"
        @dismiss="openModal(false)"
    >
      <ProjectStoreUpdateModal
          :project="modalData"
          @dismiss-modal="fetchProjects();openModal(false)"
      />
    </AppModal>
  </div>
</template>

<script>
import { defineComponent, onMounted } from 'vue';

import AppModal                from '@/components/AppModal.vue';
import ProjectStoreUpdateModal from '@/components/ProjectStoreUpdateModal.vue';

import useUser  from '@/composables/useUser';
import useHttp  from '@/composables/useHttp';
import useModal from '@/composables/useModal';

export default defineComponent({
  name: 'project/Index',
  components: {
    AppModal,
    ProjectStoreUpdateModal,

  },
  setup() {
    /* Composables */
    const { authUser } = useUser();
    const http = useHttp();
    const { isOpen, modalData, openModal } = useModal();


    /* Event handlers */
    const fetchProjects = () => {
      http.get('/api/project');
    };
    const destroyProject = async(event, projectId) => {
      event.stopPropagation();

      const response = await http.delete(`/api/project/${projectId}`);

      if(response.message) {
        fetchProjects();
      }
    };

    /* Lifecycle hooks */
    onMounted(() => {
      fetchProjects();
    });


    return {
      /* Component properties */
      http,
      authUser,
      isOpen,
      modalData,

      /* Event handlers */
      fetchProjects,
      openModal,
      destroyProject,
    };
  },
});
</script>
