<template>
  <h2 class="calendar__title">
    <corner-icon
      style="display: block; cursor: pointer; transform: rotate(90deg)"
      @click="decrementDate"
    />
    <span>{{ currentMonth }}</span>
    <corner-icon
      style="display: block; cursor: pointer; transform: rotate(-90deg)"
      @click="incrementDate"
    />
  </h2>
</template>

<script setup>
import { intlFormat } from 'date-fns';
import { onMounted, ref } from 'vue';

import { CornerIcon } from '@/shared';

const emit = defineEmits(['current-date']);

const actualDate = ref(new Date());

const currentMonth = ref();

const getCurrentMonth = () => {
  let month = intlFormat(actualDate.value, { month: 'long' }, { locale: 'ru' });

  currentMonth.value = month[0].toUpperCase() + month.slice(1);
};
const incrementDate = () => {
  actualDate.value.setMonth(actualDate.value.getMonth() + 1);
  emit('current-date', actualDate.value);
  getCurrentMonth();
};
const decrementDate = () => {
  actualDate.value.setMonth(actualDate.value.getMonth() - 1);
  emit('current-date', actualDate.value);
  getCurrentMonth();
};
onMounted(getCurrentMonth);
</script>

<style scoped lang="scss">
.calendar__title {
  display: inline-flex;
  align-items: center;
  gap: 20px;
  font-size: 20px;
  font-weight: 900;
  margin-left: 20px;
  user-select: none;
}
</style>
