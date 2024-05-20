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
          :completed="achievement.completed"
        />
      </section>
    </section>
  </main-layout>
</template>

<script setup>
import { AchievementItem } from '@/components';
import { MainLayout } from '@/layouts';

const achievements = [
  {
    id: 1,
    title: 'Вы выполнили 10 задач с приоритетом “Высокий”',
    date: new Date(),
    completed: true
  },
  {
    id: 2,
    title: 'Вы воспользовались режимом “спасение от прокрастинации” 5 раз',
    date: new Date(),
    completed: false
  },
  {
    id: 3,
    title: 'Вы пососали 50 хуёв',
    date: new Date(),
    completed: false
  }
];
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
