<template>
  <div
      class="flex justify-between w-full p-6 bg-white"
      :class="cssClass"
  >
    <div>
      <AppNavLink
          :to="{name:'welcome'}"
          class="text-2xl font-semibold"
      >
        <h1>ITC</h1>
      </AppNavLink>
    </div>

    <div
        v-if="!loggedIn"
        class="flex items-center gap-1"
    >
      <AppNavLink
          :to="{name:'login'}"
          text="Sign in"
          class="text-xl font-light"
      />
      <span>/</span>
      <AppNavLink
          :to="{name:'register'}"
          text="Sign up"
          class="text-xl font-light"
      />
    </div>
    <div
        v-else
        class="flex justify-between items-center w-full"
    >
      <div></div>

      <div class="flex items-center gap-3">
        <AppNavLink
            :to="{name:'project.index'}"
            text="All Projects"
            class="text-xl font-light"
        />
        |
        <button
            class="text-xl font-light hover:text-primary-600"
            :class="{'text-primary-600': isOpen}"
            @click="openModal(true)"
        >
          Create Project
        </button>
      </div>

      <button
          class="text-xl font-light hover:text-primary-600"
          @click="logout"
      >
        Logout
      </button>
    </div>
  </div>
  <AppModal
      :is-open="isOpen"
      @dismiss="openModal(false)"
  >
    <ProjectStoreUpdateModal
        @dismiss-modal="openModal(false);$router.push({name:'project.index'})"
    />
  </AppModal>
</template>

<script>
import { defineComponent } from 'vue';

import AppNavLink              from '@/components/AppNavLink.vue';
import AppModal                from '@/components/AppModal.vue';
import ProjectStoreUpdateModal from '@/components/ProjectStoreUpdateModal.vue';

import useUser  from '@/composables/useUser';
import useModal from '@/composables/useModal';

export default defineComponent({
  name: 'AppNav',
  components: {
    AppNavLink,
    AppModal,
    ProjectStoreUpdateModal,
  },
  props: {
    cssClass: {
      type: String,
    },
  },
  setup() {
    /* Composables */
    const { loggedIn, logout } = useUser();
    const { isOpen, openModal } = useModal();

    return {
      /* Component properties */
      loggedIn,
      isOpen,

      /* Event handlers */
      logout,
      openModal,
    };
  },
});
</script>