<template>
  <section class="task-list">
    <plan-task
      v-for="task in tasks"
      :key="task.id"
      :id="task.id"
      :name="task.name"
      :description="task.description"
      :completed="task.completed"
      :children="task.children"
      :priority="task.priority"
      :deadline="task.deadline"
      :mode="mode"
      @delete-task="emit('delete-task', task.id)"
      @complete-task="emit('complete-task', task.id)"
      @change-task="changeTask"
      @complete-subtask="completeSubtask"
    />
  </section>
</template>

<script setup>
import { PlanTask } from '@/components';

defineProps({
  tasks: { type: Array, default: () => [] },
  mode: {
    type: String,
    default: 'diary',
    validator: (value) => ['diary', 'procrastination'].includes(value)
  }
});
const emit = defineEmits([
  'delete-task',
  'complete-task',
  'change-task',
  'complete-subtask'
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
