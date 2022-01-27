<template>
  <div class="w-96 h-78 bg-primary-paint-300 rounded-xl p-8">
    <h2 class="text-xl text-medium text-center">
      {{ project.time ? `Edit time for: ${project.name}` : `Add new time for: ${project.name}` }}
    </h2>
    <form @submit.prevent="storeOrUpdateTime">
      <AppInput
          :required="true"
          label="Project time"
          type="text"
          v-model="http.time_spent"
          :errors="http.errors.time_spent"
          placeholder="Enter time spent..."
          class="mt-8"
          @focus="http.clearError('time_spent')"
      />
      <AppLoadingButton
          :loading="http.processing"
          class="bg-primary-600 hover:bg-primary-900 w-full rounded-full mt-12 py-3 px-6 text-white font-medium"
      >
        {{ project.time ? 'Update' : 'Create' }}
      </AppLoadingButton>
    </form>
  </div>
</template>

<script>
import { defineComponent, toRefs } from 'vue';

import AppInput         from '@/components/AppInput.vue';
import AppLoadingButton from '@/components/AppLoadingButton.vue';

import useHttp from '@/composables/useHttp';

export default defineComponent({
  name: 'TimeStoreUpdateModal',
  props: {
    project: {
      type: Object,
      required: true,
      default: null,
    },
  },
  components: {
    AppInput,
    AppLoadingButton,
  },
  emits: ['dismissModal'],
  setup(props, { emit }) {
    /* Component properties */
    const { project } = toRefs(props);

    /* Composables */
    const http = useHttp({
      time_spent: null,
    });

    if(project.value.time) {
      http.time_spent = project.value.time.time_spent;
    }

    /* Event handlers */
    const storeOrUpdateTime = async() => {
      let response;

      if(project.value.time) {
        response = await http.patch(`/api/project/${project.value.id}/time/${project.value.time.id}`);
      }else {
        response = await http.post(`/api/project/${project.value.id}/time`);
      }

      if(response?.message) {
        emit('dismissModal', response.message);
      }
    };

    return {
      /* Component properties */
      http,

      /* Event handlers */
      storeOrUpdateTime,
    };
  },
});
</script>