<template>
  <aside class="settings" ref="settings">
    <div class="settings__top">
      <h2 class="settings__title">Системные задачи</h2>
      <cross-icon
        style="cursor: pointer; display: block"
        @click="emits('close-settings')"
      />
    </div>
    <p class="settings__description">
      Выберите задачи, которые хотите видеть в режиме “спасение от
      прокрастинации”
    </p>
    <section class="settings__list">
      <system-task
        v-for="task in tasksDiary"
        :id="task.id"
        :key="task.id"
        :completed="task.completed"
        :title="task.name"
        @change-status="changeStatus"
      />
    </section>
  </aside>
</template>

<script setup>
import { onClickOutside } from '@vueuse/core';
import { ref } from 'vue';

import SystemTask from '@/components/settings/SystemTask.vue';
import { tasksDiary } from '@/components/task/model/tasks.js';
import { CrossIcon } from '@/shared';

const emits = defineEmits(['close-settings']);

const settings = ref(null);

const changeStatus = ({ id, status }) => {
  tasksDiary.value.map((item) => {
    if (item.id === id) item.completed = status;
  });
};
onClickOutside(settings, () => emits('close-settings'));
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
  box-shadow: 0 0 40px 10px rgba(black, 0.2);

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
    margin-bottom: 20px;
  }

  &__list {
    padding: 5px;
    display: flex;
    flex-direction: column;
    gap: 10px;
  }
}
</style>
