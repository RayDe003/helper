<template>
  <base-checkbox
    :id="`system-${id}`"
    name="system-task"
    :value="completed"
    v-model="isChecked"
    :reverse="true"
  >
    {{ title }}
  </base-checkbox>
</template>

<script setup>
import { ref, watch } from 'vue';

import { BaseCheckbox } from '@/shared';

const props = defineProps({
  id: {
    type: [String, Number],
    required: true
  },
  completed: {
    type: Boolean,
    default: false
  },
  title: {
    type: String,
    default: ''
  }
});
const emits = defineEmits(['change-status']);

// eslint-disable-next-line vue/require-prop-types
const isChecked = ref(props.completed);

watch(isChecked, () =>
  emits('change-status', { id: props.id, status: isChecked.value })
);
</script>

<style scoped lang="scss"></style>
