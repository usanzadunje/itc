<template>
  <div class="flex flex-col">
    <label v-if="label" class="text-md font-medium" :for="id">
      <span>{{ label }}</span>
      <span v-if="required" class="text-md text-primary-600 font-semibold">*</span>
    </label>
    <input
        ref="input"
        :id="id"
        class="border border-gray-200 rounded-full mt-2 px-6 py-2 text-primary-600 font-normal"
        :class="{ 'border-red-400': error }"
        :type="type"
        :placeholder="placeholder"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        @focus="$emit('focus')"
    />
    <slot></slot>
    <div v-if="error" class="text-red-500">{{ error }}</div>
  </div>
</template>
<script lang="ts">
import { defineComponent } from 'vue';

import { v4 as uuid } from 'uuid';

export default defineComponent({
  name: 'AppInput',
  components: {},
  emits: ['focus', 'update:modelValue'],
  props: {
    label: {
      type: String,
    },
    id: {
      type: String,
      default() {
        return `text-input-${uuid()}`;
      },
    },
    type: {
      type: String,
      default: 'text',
    },
    placeholder: {
      type: String,
    },
    required: {
      type: Boolean,
    },
    error: {
      type: String,
    },
    modelValue: {
      type: String,
    },
  },
  setup() {


    return {};
  },
});
</script>
<style scoped>

</style>