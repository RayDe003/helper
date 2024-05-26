<template>
  <section class="task-list">
    <plan-task
      v-for="task in tasks"
      :key="task.id"
      :id="task.id"
      :title="task.title"
      :description="task.description"
      :is_complete="task.is_complete"
      :sub_tasks="task.sub_tasks"
      :priority_id="task.priority_id"
      :deadline="task.deadline"
      :reverse="reverse"
      :mode="mode"
      @delete-task="emit('delete-task', task.id)"
      @complete-task="emit('complete-task', task.id)"
      @change-task="changeTask"
      @complete-subtask="completeSubtask"
      @randomize-task="emit('randomize-task', task.id)"
    />
  </section>
</template>

<script setup>
import { PlanTask } from '@/components';

defineProps({
  tasks: { type: Array, default: () => [] },
  mode: {
    type: String,
    default: null,
    validator: (value) => ['diary', 'procrastination'].includes(value)
  },
  reverse: {
    type: Boolean,
    default: false
  }
});
const emit = defineEmits([
  'delete-task',
  'complete-task',
  'change-task',
  'complete-subtask',
  'randomize-task'
]);
const changeTask = (data) => emit('change-task', data);
const completeSubtask = (data) => emit('complete-subtask', data);
</script>

<style scoped lang="scss">
.task-list {
  display: flex;
  flex-direction: column;
  gap: 10px;
}
</style>
