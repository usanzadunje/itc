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

    console.log(props.to.name == route.name);
    /* Component properties */
    const isActive = computed(() => {
      if(typeof props.to === 'string') {
        return props.to == route.path;
      }else {
        return props.to.name == route.name;
      }
    });

    return {
      /* Component properties */
      isActive,
    };
  },
});
</script>