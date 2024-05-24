<template>
  <base-checkbox
    :id="id"
    name="subtask"
    :value="is_complete"
    v-model="isChecked"
  >
    <slot />
  </base-checkbox>
</template>

<script setup>
import { ref, watch } from 'vue';

import { BaseCheckbox } from '@/shared';

const props = defineProps({
  id: { type: [Number, String], required: true },
  is_complete: { type: [Number, Boolean], default: false }
});

const isChecked = ref(props.is_complete);
const emit = defineEmits(['complete-subtask']);

watch(isChecked, () => {
  if (isChecked.value === true) {
    emit('complete-subtask');
  }
});
</script>

<style scoped lang="scss"></style>
