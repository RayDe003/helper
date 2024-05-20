<template>
  <section class="calendar">
    <month-switcher class="calendar__switcher" @current-date="getActualDate" />
    <section class="calendar-list">
      <calendar-card v-for="(day, ind) in daysList" :key="ind" :date="day" />
    </section>
  </section>
</template>

<script setup>
import { eachDayOfInterval, getDaysInMonth } from 'date-fns';
import { onMounted, ref } from 'vue';

import CalendarCard from './CalendarCard.vue';
import MonthSwitcher from './MonthSwitcher.vue';

const actualDate = ref(new Date());

const daysList = ref([]);

const getDays = () => {
  if (!actualDate.value) return;
  daysList.value = eachDayOfInterval({
    start: new Date(
      actualDate.value.getFullYear(),
      actualDate.value.getMonth(),
      1
    ),
    end: new Date(
      actualDate.value.getFullYear(),
      actualDate.value.getMonth(),
      getDaysInMonth(actualDate.value)
    )
  });
};

const getActualDate = (date) => {
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
