<template>
  <base-checkbox
    :id="`system-${id}`"
    name="system-task"
    :value="accept"
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
  accept: {
    type: [Number, Boolean],
    default: false
  },
  title: {
    type: String,
    default: ''
  }
});
const emits = defineEmits(['change-status']);

// eslint-disable-next-line vue/require-prop-types
const isChecked = ref(!!props.accept);

watch(isChecked, () =>
  emits('change-status', { id: props.id, accept: isChecked.value ? 1 : 0 })
);
</script>

<style scoped lang="scss"></style>
