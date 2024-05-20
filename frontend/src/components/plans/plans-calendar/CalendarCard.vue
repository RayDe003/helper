<template>
  <article class="card">
    <div class="card-date">
      <div class="card-date__day">{{ getDate(date) }}</div>
      <p>{{ weekday }}</p>
    </div>
    <purple-button size="small" @click="goToDay">Планы на день</purple-button>
  </article>
</template>

<script setup>
import { getDate, getMonth, getYear, intlFormat } from 'date-fns';
import { computed } from 'vue';
import { useRouter } from 'vue-router';

import { PurpleButton } from '@/shared/index.js';

const props = defineProps({
  date: { type: [Date, String], required: true }
});

const router = useRouter();

const weekday = computed(() => {
  let buff = intlFormat(props.date, { weekday: 'short' }, { locale: 'ru' });

  return buff[0].toUpperCase() + buff.slice(1);
});

const goToDay = () => {
  router.push({
    name: 'plans.day',
    params: {
      day: getDate(props.date),
      month: getMonth(props.date) + 1,
      year: getYear(props.date)
    }
  });
};
</script>

<style scoped lang="scss">
.card {
  display: flex;
  position: relative;
  align-items: center;
  justify-content: center;
  width: 100%;
  height: 100%;
  border: 2px solid $accent-purple;
  border-radius: 10px;

  &-date {
    display: flex;
    position: absolute;
    align-items: center;
    gap: 8px;
    top: 5px;
    left: 5px;

    &__day {
      width: 26px;
      height: 26px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: $accent-purple;
      border-radius: 50%;
      color: white;
    }
  }
}
</style>
