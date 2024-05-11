<template>
  <section class="today">
    <base-select
      class="base-select"
      :init-mode="initMode"
      @switch-mode="switchMode"
    />
    <task-list :tasks="tasks" @delete-task="deleteTask"></task-list>
  </section>
  <purple-button class="create-button" v-if="initMode === 0">
    Создать задачу
  </purple-button>
</template>

<script setup>
import { ref } from 'vue';

import { TaskList } from '@/components';
import { tasks } from '@/components/task/model/tasks.js';
import { BaseSelect, PurpleButton } from '@/shared';

const initMode = ref(0);

const switchMode = (value) => (initMode.value = value);

const deleteTask = (id) =>
  tasks.value.splice(
    tasks.value.findIndex((item) => item.id === id),
    1
  );
</script>

<style scoped lang="scss">
.today {
  padding: 24px;
  width: 100%;
  height: 100%;
}

.base-select {
  margin-bottom: 25px;
}
.create-button {
  position: absolute;
  bottom: 20px;
}
</style>
