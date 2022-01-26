<template>
  <div class="w-96 h-78 bg-primary-paint-300 rounded-xl p-8">
    <h2 class="text-xl text-medium text-center">Create new project</h2>
    <form @submit.prevent="createProject">
      <AppInput
          :required="true"
          label="Project name"
          type="text"
          v-model="http.name"
          :errors="http.errors.name"
          placeholder="Project name..."
          class="mt-8"
          @focus="http.clearError('name')"
      />

      <AppLoadingButton
          :loading="http.processing"
          class="bg-primary-600 hover:bg-primary-900 w-full rounded-full mt-12 py-3 px-6 text-white font-medium"
      >
        Create
      </AppLoadingButton>
    </form>
  </div>
</template>

<script>
import { defineComponent } from 'vue';

import AppInput         from '@/components/AppInput.vue';
import AppLoadingButton from '@/components/AppLoadingButton.vue';
import useHttp          from '@/composables/useHttp';

export default defineComponent({
  name: 'ProjectCreateUpdateModal',
  props: {
    modal: {
      type: Object,
    },
  },
  components: {
    AppInput,
    AppLoadingButton,
  },
  emits: ['projectCreated'],
  setup(props, { emit }) {
    /* Composables */
    const http = useHttp({
      name: null,
    });

    /* Event handlers */
    const createProject = async() => {
      const response = await http.post('/api/project');

      if(response?.message) {
        emit('projectCreated', response.message);

        props.modal.openModal(false);
      }
    };

    return {
      /* Component properties */
      http,

      /* Event handlers */
      createProject,
    };
  },
});
</script>