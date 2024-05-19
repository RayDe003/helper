<template>
  <section class="subtask-list">
    <plan-subtask
      v-for="subTask in subTasks"
      :key="`sub-${subTask.task_id}`"
      :id="`sub-${subTask.task_id}`"
      :completed="subTask.completed"
      @complete-subtask="emit('complete-subtask', subTask.task_id)"
    >
      {{ subTask.name }}
    </plan-subtask>
  </section>
</template>

<script setup>
import { PlanSubtask } from '@/components';

defineProps({
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
