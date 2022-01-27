<template>
  <router-link
      :to="to"
      class="hover:text-primary-600"
      :class="{'text-primary-600': isActive}"
  >
    <slot v-if="!text"></slot>
    {{ text }}
  </router-link>
</template>

<script>
import { defineComponent, computed } from 'vue';
import { useRoute }                  from 'vue-router';

export default defineComponent({
  name: 'AppNavLink',
  props: {
    text: {
      type: String,
    },
    to: {
      required: false,
    },
  },
  setup(props) {
    /* Globals */
    const route = useRoute();

    /* Component properties */
    const isActive = computed(() => {
      const routeNameStart = props.to.name.split('.')[0];

      return route.name.includes(routeNameStart);
    });

    return {
      /* Component properties */
      isActive,
    };
  },
});
</script>