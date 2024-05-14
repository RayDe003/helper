<template>
  <main class="home-page">
    <div class="container">
      <section class="home-page__inner">
        <p class="home-page__over-title">Организуй свою жизнь с</p>
        <h1 class="home-page__title">Helper</h1>
        <p class="home-page__description">
          Сайт Helper предоставляет удобный инструмент для планирования
          задач и управления временем, помогая организовать повседневные дела и
          достигать поставленных целей. Создавайте списки дел, отслеживайте
          прогресс и повышайте эффективность своей работы благодаря интуитивному
          интерфейсу и персонализированным функциям.
        </p>
        <button class="home-page__button" @click="toLoginPage">
          Начать работу
        </button>
      </section>
    </div>
  </main>
</template>

<script setup>
import { useRouter } from 'vue-router';

const router = useRouter();
const toLoginPage = () => {
  router.push('/login');
};
</script>

<style scoped lang="scss">
@import 'style';
</style>
