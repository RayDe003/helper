<template>
  <section class="today">
    <base-select
      class="base-select"
      :init-mode="+initMode"
      @switch-mode="switchMode"
    />
    <task-list
      :mode="initMode ? 'procrastination' : 'diary'"
      :tasks="tasks"
      @delete-task="deleteTask"
      @complete-task="completeTask"
    ></task-list>
  </section>
  <purple-button class="create-button" v-if="+initMode === 0">
    Создать задачу
  </purple-button>
</template>

<script setup>
import { useRouteQuery } from '@vueuse/router';
import { computed } from 'vue';

import { TaskList } from '@/components';
import {
  tasksDiary,
  tasksProcrastination
} from '@/components/task/model/tasks.js';
import { BaseSelect, PurpleButton } from '@/shared';

const initMode = useRouteQuery('mode', 0, { transform: Number });
const switchMode = (value) => (initMode.value = value);

const tasks = computed(() =>
  initMode.value ? tasksProcrastination.value : tasksDiary.value
);

const deleteTask = (id) => {
  initMode.value
    ? tasksProcrastination.value.splice(
        tasksProcrastination.value.findIndex((item) => item.id === id),
        1
      )
    : tasksDiary.value.splice(
        tasksDiary.value.findIndex((item) => item.id === id),
        1
      );
};
const completeTask = (id) => {
  initMode.value
    ? tasksProcrastination.value.map((task) => {
        if (task.id === id) task.completed = true;
        return task;
      })
    : tasksDiary.value.map((task) => {
        if (task.id === id) task.completed = true;
        return task;
      });
};

// const deleteTask = (id) =>
//   tasksDiary.value.splice(
//     tasksDiary.value.findIndex((item) => item.id === id),
//     1
//   );
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
