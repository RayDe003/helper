<template>
  <section class="subtask-list">
    <plan-subtask
      v-for="subTask in subTasks"
      :key="`sub-${subTask.task_id}`"
      :id="`sub-${subTask.task_id}`"
      :is_complete="subTask.is_complete"
      @complete-subtask="emit('complete-subtask', subTask.task_id)"
    >
      {{ mode ? subTask.name : trimText(subTask.name, 11) }}
    </plan-subtask>
  </section>
</template>

<script setup>
import { PlanSubtask } from '@/components';

import { trimText } from './model/functions.js';

defineProps({
  mode: { type: String, default: null },
  subTasks: { type: Array, default: () => [] }
});

const emit = defineEmits(['complete-subtask']);
</script>

<style scoped lang="scss">
.subtask-list {
  display: flex;
  flex-direction: column;
  gap: 10px;
}
</style>
