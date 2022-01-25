<template>
  <div class="flex justify-between">
    <AppLogo/>
    <div class="self-justify-end">
      <div v-if="!authUser">
        <AppNavLink
            :to="{name:'login'}"
            text="Sign in"
            class="text-xl font-light"
        />
        <AppNavLink
            :to="{name:'register'}"
            text="Sign up"
            class="text-xl font-light"
        />
      </div>

      <div v-else>
        <button
            class="text-sm text-gray-700 underline"
            @click="this.$router.push({name:'project.index'})"
        >
          Projects
        </button>
        <button
            class="text-sm text-gray-700 underline"
            @click="this.$router.push({name:'project.create'})"
        >
          Create Project
        </button>
        <button
            class="text-sm text-gray-700 underline"
            @click="logout"
        >
          Logout
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent } from 'vue';

import AppLogo    from '@/components/AppLogo.vue';
import AppNavLink from '@/components/AppNavLink.vue';

import useUser from '@/composables/useUser';

export default defineComponent({
  name: 'AppLogo',
  components: {
    AppLogo,
    AppNavLink,
  },
  setup() {
    /* Composables */
    const { authUser, logout } = useUser();


    return {
      /* Component properties */
      authUser,

      /* Event handlers */
      logout,
    };
  },
});
</script>