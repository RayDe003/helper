<template>
  <section class="task-list">
    <plan-task
      v-for="task in tasks"
      :key="task.id"
      :id="task.id"
      :name="task.name"
      @delete-task="emit('delete-task', task.id)"
    />
  </section>
</template>

<script setup>
import { PlanTask } from '@/components';

defineProps({
  tasks: { type: Array, default: () => [] }
});
const emit = defineEmits(['delete-task']);
</script>

<style scoped lang="scss">
.task-list {
  display: flex;
  flex-direction: column;
  gap: 10px;
}
</style>
