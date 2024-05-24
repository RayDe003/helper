<template>
  <section class="calendar">
    <month-switcher class="calendar__switcher" @current-date="getActualDate" />
    <section class="calendar-list" :key="refreshKey">
      <calendar-card
        v-for="(day, ind) in daysList"
        :key="ind"
        :date="day.date"
        :has_tasks="day.has_tasks"
      />
    </section>
  </section>
</template>

<script setup>
import { getMonth, isToday } from 'date-fns';
import { onMounted, ref } from 'vue';

import { getMonthDaysRequest } from '@/api';

import CalendarCard from './CalendarCard.vue';
import MonthSwitcher from './MonthSwitcher.vue';

const actualDate = ref(new Date());

const daysList = ref([]);
const refreshKey = ref(1);

const getDays = () =>
  getMonthDaysRequest(
    isToday(actualDate.value) ? null : getMonth(actualDate.value) + 1
  ).then((response) => (daysList.value = response.data.days));

const getActualDate = (date) => {
  daysList.value = [];
  refreshKey.value++;
  actualDate.value = date;
  getDays();
};

onMounted(getDays);
</script>

<style scoped lang="scss">
.calendar {
  padding-top: 20px;

  &__switcher {
    margin-bottom: 20px;
  }

  &-list {
    display: grid;
    height: 80dvh;
    grid-template-columns: repeat(7, 1fr);
    grid-template-rows: repeat(5, 1fr);
    gap: 20px;
  }
}
</style>
