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
      @change-task="changeTask"
      @complete-subtask="completeSubtask"
    />
    <plan-task
      v-if="newTask"
      class="new-task"
      mode="diary"
      :setting-mode="true"
      :is-new-task="true"
      :id="`new-${createdTaskId}`"
      :name="createdTaskData.name"
      :description="createdTaskData.description"
      :children="createdTaskData.children"
      :completed="createdTaskData.completed"
      :priority="createdTaskData.priority"
      :deadline="createdTaskData.deadline"
      @change-task="changeTask"
    />
  </section>
  <purple-button
    class="create-button"
    @click="createTask"
    v-if="+initMode === 0 && !newTask"
  >
    Создать задачу
  </purple-button>
</template>

<script setup>
import { useRouteQuery } from '@vueuse/router';
import { computed, reactive, ref } from 'vue';

import { TaskList } from '@/components';
import { PlanTask } from '@/components/index.js';
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
const newTask = ref(false);

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
      })
    : tasksDiary.value.map((task) => {
        if (task.id === id) task.completed = true;
      });
};

const completeSubtask = (data) => {
  tasksDiary.value.map((task) => {
    if (
      task.id === data[0] &&
      task.children.find((child) => child.task_id === data[1])
    ) {
      task.children[
        task.children.findIndex((child) => child.task_id === data[1])
      ].completed = true;
    }
  });
};
const changeTask = (data) => {
  if (newTask.value) {
    tasksDiary.value.push(data);
    newTask.value = false;
    return;
  }
  tasksDiary.value.map((task) => {
    if (task.id === data.id) {
      task.name = data.name;
      task.description = data.description;
      task.priority = data.priority;
      task.deadline = data.deadline;
    }
  });
};
const createdTaskId = ref(1);
const createdTaskData = reactive({
  name: 'Новая задача',
  description: 'Описание',
  completed: false,
  priority: 1,
  deadline: null
});
const createTask = () => {
  createdTaskId.value++;
  newTask.value = true;
};
</script>

<style scoped lang="scss">
.today {
  padding: 24px 24px 50px;
  width: 100%;
  height: 100%;
}

.base-select {
  margin-bottom: 25px;
}
.create-button {
  position: fixed;
  bottom: 20px;
}
.new-task {
  margin-top: 15px;
}
</style>
