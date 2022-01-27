<template>
  <div>
    <teleport to="body">
      <div
          v-if="isOpen"
          class="modal cursor-pointer"
          @click="$emit('dismiss')"
      >
        <div
            class="cursor-default"
            @click="$event.stopPropagation()"
        >
          <slot></slot>
        </div>
      </div>
    </teleport>
  </div>
</template>
<script>
import { defineComponent } from 'vue';

export default defineComponent({
  name: 'AppModal',
  props: {
    isOpen: {
      type: Boolean,
    },
  },
  emits: ['dismiss'],
  setup() {
    /* Component properties */

    /* Event handlers */


    return {
      /* Component properties */

      /* Event handlers */
    };
  },
});
</script>
<style scoped>
.modal {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  background-color: rgba(0, 0, 0, .5);
  display: flex;
  align-items: center;
  justify-content: center;
}
</style>