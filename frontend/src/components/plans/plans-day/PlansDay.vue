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
      :tasks-length="tasksProcrastination.length"
      @click="getRandomTasks"
    />
    <task-list
      v-if="tasksProcrastination || tasksDaily"
      :key="refreshKey"
      :mode="initMode ? 'procrastination' : 'diary'"
      :tasks="initMode ? tasksProcrastination : tasksDaily"
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
      :title="createdTaskData.title"
      :description="createdTaskData.description"
      :sub_tasks="createdTaskData.sub_tasks"
      :is_complete="createdTaskData.is_complete"
      :priority_id="createdTaskData.priority_id"
      :deadline="createdTaskData.deadline"
      :not_type_id="createdTaskData.not_type_id"
      @change-task="changeTask"
      @create-mode-leave="newTask = false"
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
import { computed, onMounted, reactive, ref, watch } from 'vue';
import { useRoute } from 'vue-router';

import {
  completeSubTaskRequest,
  completeSystemTaskRequest,
  completeTaskRequest,
  createSubTaskRequest,
  createTaskRequest,
  deleteSystemTaskRequest,
  deleteTaskRequest,
  getDailySystemTasksRequest,
  getDailyTasksRequest,
  getRandomTasksRequest,
  randomizeSystemTaskRequest,
  updateTaskRequest
} from '@/api';
import {
  changeTypeNotificationRequest,
  setTypeNotificationRequest
} from '@/api/user-notifications.js';
import { PlanTask, TaskList, TasksRefresher } from '@/components';
import { BaseSelect, LocalTime, PurpleButton } from '@/shared';

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
const tasksDaily = ref([]);
const tasksProcrastination = ref([]);

const switchMode = (value) => {
  refreshKey.value++;
  initMode.value = value;
};

const deleteTask = (id) => {
  initMode.value
    ? deleteSystemTaskRequest(id).then(() => getDailyTasks())
    : deleteTaskRequest(id).then(() => getDailyTasks());
};
const completeTask = (id) =>
  initMode.value ? completeSystemTaskRequest(id) : completeTaskRequest(id);

const getRandomTasks = () =>
  getRandomTasksRequest().then(
    (response) => (tasksProcrastination.value = response.data.data)
  );

const completeSubtask = (data) => completeSubTaskRequest(data);
const changeTask = (data) => {
  if (newTask.value) {
    createTaskRequest(data)
      .then((response) => {
        data.sub_tasks.map((sub_task) =>
          createSubTaskRequest(response.data.task.id, {
            text: sub_task.text
          })
        );
        setTypeNotificationRequest(response.data.task.id, {
          not_type_id: data.not_type_id
        });
      })
      .finally(() => getDailyTasks());
    newTask.value = false;
    return;
  }
  updateTaskRequest(data.id, data)
    .then(() => changeTypeNotificationRequest(data.id, data.not_type_id))
    .finally(() => getDailyTasks());
};
const randomizeTask = (id) =>
  randomizeSystemTaskRequest(id).then(() => getDailyTasks());

const createdTaskId = ref(1);
const createdTaskData = reactive({
  title: 'Новая задача',
  description: 'Описание',
  priority_id: 1,
  deadline: null,
  not_type_id: null
});
const createTask = () => {
  newTask.value = true;
};

const getDailyTasks = () => {
  if (initMode.value) {
    getDailySystemTasksRequest().then(
      (response) => (tasksProcrastination.value = response.data.data)
    );
  } else {
    getDailyTasksRequest(
      paramsDate.value.day
        ? `${paramsDate.value.year}-${paramsDate.value.month}-${paramsDate.value.day}`
        : null
    ).then((response) => (tasksDaily.value = response.data.tasks));
  }
};

watch(paramsDate, () => getDailyTasks());
watch([tasksDaily, tasksProcrastination], () => {
  refreshKey.value++;
});

onMounted(getDailyTasks);
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
