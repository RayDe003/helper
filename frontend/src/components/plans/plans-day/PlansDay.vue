<template>
  <section class="day">
    <base-select
      class="base-select"
      :init-mode="+initMode"
      @switch-mode="switchMode"
      v-if="route.name === 'plans.today'"
    />
    <local-time
      :date="`${paramsDate.year}/${paramsDate.month}/${paramsDate.day}`"
      class="local-time"
      v-else-if="paramsDate"
    />
    <tasks-refresher
      v-if="+initMode"
      :tasks-length="tasks.length"
      @click="refreshKey++"
    />
    <task-list
      :key="refreshKey"
      :mode="initMode ? 'procrastination' : 'diary'"
      :tasks="tasks"
      @delete-task="deleteTask"
      @complete-task="completeTask"
      @change-task="changeTask"
      @complete-subtask="completeSubtask"
      @randomize-task="randomizeTask"
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
    icon="cross"
    @click="createTask"
    v-if="+initMode === 0 && !newTask"
  >
    Создать задачу
  </purple-button>
</template>

<script setup>
import { useRouteQuery } from '@vueuse/router';
import { computed, reactive, ref } from 'vue';
import { useRoute } from 'vue-router';

import { PlanTask, TaskList, TasksRefresher } from '@/components';
import {
  tasksDiary,
  tasksProcrastination
} from '@/components/task/model/tasks.js';
import { BaseSelect, PurpleButton } from '@/shared';
import { LocalTime } from '@/shared/index.js';

const initMode = useRouteQuery('mode', 0, { transform: Number });
const newTask = ref(false);

const route = useRoute();
const paramsDate = computed(() => {
  const day = route.params?.day;
  const month = route.params?.month;
  const year = route.params?.year;

  return { day, month, year };
});

const refreshKey = ref(1);
const tasks = computed(() =>
  initMode.value ? tasksProcrastination.value : tasksDiary.value
);

const switchMode = (value) => (initMode.value = value);

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
const randomizeTask = (id) => {
  console.log(id);
  // todo: refresh tasks
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
.day {
  padding: 24px 24px 50px;
  width: 100%;
  height: 100%;
}
.local-time {
  display: block;
  margin-bottom: 25px;
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
