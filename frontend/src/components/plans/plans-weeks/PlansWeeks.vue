<template>
  <section class="weeks">
    <plans-card v-for="item in weeks" :key="item" :date="item" />
  </section>
</template>

<script setup>
import { eachDayOfInterval } from 'date-fns';

import PlansCard from './PlansCard.vue';

const weeks = eachDayOfInterval({
  start: new Date(),
  end: new Date(2024, 5, 3)
});
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
