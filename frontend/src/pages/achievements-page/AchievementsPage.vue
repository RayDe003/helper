<template>
  <main-layout>
    <section class="achievements">
      <h1 class="achievements__title">Достижения</h1>
      <section class="achievements__list">
        <achievement-item
          v-for="achievement in achievements"
          :id="achievement.id"
          :key="achievement.id"
          :date="achievement.date"
          :title="achievement.title"
          :is_complete="achievement.is_complete"
        />
      </section>
    </section>
  </main-layout>
</template>

<script setup>
import { onMounted, ref } from 'vue';

import { getAchievementsRequest } from '@/api';
import { AchievementItem } from '@/components';
import { MainLayout } from '@/layouts';

const achievements = ref([]);

onMounted(() =>
  getAchievementsRequest().then(
    (response) => (achievements.value = response.data.data)
  )
);
</script>

<style scoped lang="scss">
.achievements {
  padding-top: 20px;
  &__title {
    font-size: 20px;
    font-weight: 500;
    margin-left: 20px;
    margin-bottom: 30px;
  }

  &__list {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }
}
</style>
