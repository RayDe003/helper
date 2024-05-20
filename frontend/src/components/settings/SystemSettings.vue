<template>
  <aside class="settings">
    <div class="settings__top">
      <h2 class="settings__title">Системные задачи</h2>
      <cross-icon style="cursor: pointer" @click="emits('close-settings')" />
    </div>
    <p class="settings__description">
      Выберите задачи, которые хотите видеть в режиме “спасение от
      прокрастинации”
    </p>
  </aside>
</template>

<script setup>
import { CrossIcon } from '@/shared';

const emits = defineEmits(['close-settings']);
</script>

<style scoped lang="scss">
.settings {
  padding: 20px;
  width: 30vw;
  height: 100svh;
  background: white;
  position: fixed;
  top: 0;
  right: 0;
  box-shadow: 0px 0px 40px 10px rgba(black, 0.2);

  &__top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 30px;
  }
  &__title {
    font-size: 30px;
    color: #3f2f72;
    font-weight: 900;
  }

  &__description {
    max-width: 345px;
  }
}
</style>
