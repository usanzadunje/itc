<template>
  <button
      @click="openModal()"
  >
    {{ text }}
  </button>

  <teleport to="body">
    <div
        v-if="isOpen"
        class="modal"
        @click="openModal(false)"
    >
      <div @click="$event.stopPropagation()">
        <slot @dismiss="openModal(false)"></slot>
      </div>
    </div>
  </teleport>
</template>
<script>
import { defineComponent, ref } from 'vue';

export default defineComponent({
  name: 'AppModalButton',
  props: {
    text: {
      type: String,
    },
  },
  setup() {
    /* Component properties */
    const isOpen = ref(false);

    /* Event handlers */
    const openModal = (state = true) => {
      isOpen.value = state;
    };

    return {
      /* Component properties */
      isOpen,

      /* Event handlers */
      openModal,
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