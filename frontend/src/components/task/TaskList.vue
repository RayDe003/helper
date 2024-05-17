<template>
  <section class="task-list">
    <plan-task
      v-for="task in tasks"
      :key="task.id"
      :id="task.id"
      :name="task.name"
      :completed="task.completed"
      :mode="mode"
      @delete-task="emit('delete-task', task.id)"
      @complete-task="emit('complete-task', task.id)"
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
const emit = defineEmits(['delete-task', 'complete-task']);
</script>

<style scoped lang="scss">
.task-list {
  display: flex;
  flex-direction: column;
  gap: 10px;
}
</style>
