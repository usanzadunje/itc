<template>
  <div class="p-10">
    <div class="flex justify-between items-center">
      <div></div>
      <h1 class="text-4xl hover:text-primary-600">{{ project?.name }}</h1>
      <button
          class="bg-primary-600 text-white hover:bg-primary-900 px-6 py-2.5 rounded-xl font-medium"
          @click="openModal(true)"
      >
        Add Time
      </button>
    </div>
    <div class="mt-8 flex flex-col px-32">
      <p class="text-primary-600 font-medium text-2xl">Total: {{ project?.total_time }}</p>

      <div class="flex flex-col gap-4 mt-6">
        <div
            v-for="time in project?.times"
            class="flex justify-between items-center font-light text-xl bg-white rounded-xl px-20 py-6 cursor-pointer"
            @click=""
        >
          <p>
            <span class="text-primary-600 font-normal">Recorded at:</span>
            {{
              time?.created_at ?
                  dayjs(time?.created_at).format('DD.MM.YYYY') :
                  'N/A'
            }}
          </p>
          <p class="mt-1">
            <span class="text-primary-600 font-normal">Time spent:</span>
            {{
              time?.time_spent ?? 'N/A'
            }}
          </p>
          <div class="flex items-center gap-4">
            <button
                class="text-3xl text-green-600 rounded-md hover:opacity-70"
                @click="updateTime($event, time)"
            >
              <i class="fas fa-edit"></i>
            </button>
            <button
                class="text-3xl text-red-600 rounded-md hover:opacity-70"
                @click="destroyTime($event, time.id)"
            >
              <i class="fas fa-trash-alt"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent, onMounted, ref } from 'vue';
import { useRoute }                        from 'vue-router';

import AppModal                from '@/components/AppModal.vue';
import ProjectStoreUpdateModal from '@/components/ProjectStoreUpdateModal.vue';

import useHttp from '@/composables/useHttp';
// import useModal from '@/composables/useModal';

import dayjs from 'dayjs';

export default defineComponent({
  name: 'project/Index',
  components: {
    AppModal,
    ProjectStoreUpdateModal,
  },
  setup() {
    /* Globals */
    const route = useRoute();

    /* Component properties */
    const project = ref();

    /* Composables */
    const http = useHttp();
    // const { isOpen, modalData, openModal } = useModal();

    /* Event handlers */
    const fetchProject = async() => {
      project.value = await http.get(`/api/project/${route.params.project}`);
    };
    const updateTime = async(event, time) => {
      event.stopPropagation();

      openModal(true, time);
    };
    const destroyTime = async(event, timeId) => {
      event.stopPropagation();

      const response = await http.delete(`/api/project/${project.value.id}/time/${timeId}`);

      if(response.message) {
        await fetchProject();
      }
    };

    /* Lifecycle hooks */
    onMounted(async() => {
      await fetchProject();
    });

    return {
      /* Component properties */
      project,
      // isOpen,
      // modalData,

      /* Event handlers */
      fetchProject,
      // openModal,
      updateTime,
      destroyTime,

      /* Helpers */
      dayjs,
    };
  },
});
</script>
