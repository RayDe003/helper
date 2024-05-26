<template>
  <section class="weeks">
    <plans-card
      v-for="(day, index) in weeks"
      :key="index"
      :date="day.date"
      :tasks="day.tasks"
      @refresh-tasks="getWeeksTasks"
    />
  </section>
</template>

<script setup>
import { onMounted, ref } from 'vue';

import { getWeeksTasksRequest } from '@/api';

import PlansCard from './PlansCard.vue';

const weeks = ref([]);

const getWeeksTasks = () => {
  getWeeksTasksRequest().then(
    (response) => (weeks.value = response.data.tasks)
  );
};

onMounted(getWeeksTasks);
</script>

<style scoped lang="scss">
.weeks {
  height: auto;
  padding: 20px 5px;
  display: grid;
  gap: 20px;
  grid-template-columns: repeat(7, minmax(220px, 1fr));
  grid-template-rows: repeat(2, minmax(auto, 1fr));
}
</style>
