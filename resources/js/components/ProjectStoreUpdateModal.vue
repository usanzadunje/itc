<template>
  <div class="w-96 h-78 bg-primary-paint-300 rounded-xl p-8">
    <h2 class="text-xl text-medium text-center">
      {{ project ? `Edit ${project.name} ` : 'Create new ' }}project
    </h2>
    <form @submit.prevent="storeOrUpdateProject">
      <AppInput
          :required="true"
          label="Project name"
          type="text"
          :autofocus="true"
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
        {{ project ? 'Update' : 'Create' }}
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
  name: 'ProjectStoreUpdateModal',
  props: {
    project: {
      type: Object,
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
      name: null,
    });

    if(project.value) {
      http.name = project.value.name;
    }

    /* Event handlers */
    const storeOrUpdateProject = async() => {
      let response;

      if(project.value) {
        response = await http.patch(`/api/project/${project.value.id}`);
      }else {
        response = await http.post('/api/project');
      }

      if(response?.message) {
        emit('dismissModal', response.message);
      }
    };

    return {
      /* Component properties */
      http,

      /* Event handlers */
      storeOrUpdateProject,
    };
  },
});
</script>