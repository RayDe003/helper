<template>
  <article class="card">
    <local-time :date="date" />
    <section class="card-tasks">
      <task-list
        :tasks="props.tasks"
        @delete-task="deleteTask"
        @complete-task="completeTask"
      />
    </section>
    <purple-button icon="arrow" @click="seeMore">Подробнее</purple-button>
  </article>
</template>

<script setup>
import { getDate, getMonth, getYear } from 'date-fns';
import { useRouter } from 'vue-router';

import { completeTaskRequest, deleteTaskRequest } from '@/api';
import { TaskList } from '@/components';
import { LocalTime, PurpleButton } from '@/shared';

const props = defineProps({
  date: { type: [Date, String], default: new Date() },
  tasks: { type: Array, default: () => [] }
});

const router = useRouter();

const seeMore = () => {
  router.push({
    name: 'plans.day',
    params: {
      day: getDate(props.date),
      month: getMonth(props.date) + 1,
      year: getYear(props.date)
    }
  });
};

const deleteTask = (id) => deleteTaskRequest(id);
const completeTask = (id) => completeTaskRequest(id);
</script>

<style scoped lang="scss">
.card {
  width: 100%;
  max-height: 470px;
  display: flex;
  flex-direction: column;
  overflow: hidden;
  gap: 20px;

  &-tasks {
    border: 2px solid #9747ff;
    border-radius: 7px;
    padding: 10px 10px 10px 10px;
    width: 100%;
    min-height: 250px;
    height: clamp(250px, 100%, 330px);
    overflow-y: scroll;
    &::-webkit-scrollbar {
      width: 0;
    }
  }
}
</style>
