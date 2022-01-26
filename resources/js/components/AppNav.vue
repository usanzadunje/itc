<template>
  <div class="flex justify-between w-full p-6 bg-white rounded-md">
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
        <AppNavLink
            :to="{name:'project.create'}"
            text="Create Project"
            class="text-xl font-light"
        />
      </div>

      <button
          class="text-xl font-light hover:text-primary-600"
          @click="logout"
      >
        Logout
      </button>
    </div>
  </div>
</template>

<script>
import { defineComponent } from 'vue';

import AppNavLink from '@/components/AppNavLink.vue';

import useUser from '@/composables/useUser';

export default defineComponent({
  name: 'AppNav',
  components: {
    AppNavLink,
  },
  setup() {
    /* Composables */
    const { loggedIn, logout } = useUser();


    return {
      /* Component properties */
      loggedIn,

      /* Event handlers */
      logout,
    };
  },
});
</script>