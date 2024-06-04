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
        v-for="task in systemTasks"
        :id="task.id"
        :key="task.id"
        :accept="task.accept"
        :title="task.title"
        @change-status="changeStatus"
      />
    </section>
  </aside>
</template>

<script setup>
import { onClickOutside } from '@vueuse/core';
import { onMounted, ref } from 'vue';

import { acceptSystemTaskRequest, getAllSystemTasksRequest } from '@/api';
import SystemTask from '@/components/settings/SystemTask.vue';
import { CrossIcon } from '@/shared';

const emits = defineEmits(['close-settings']);

const settings = ref(null);
const systemTasks = ref([]);

const changeStatus = ({ id, accept }) => acceptSystemTaskRequest(id, accept);

onClickOutside(settings, () => emits('close-settings'));

onMounted(() => {
  getAllSystemTasksRequest().then(
    (response) => (systemTasks.value = response.data.data)
  );
});
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
    overflow-y: scroll;
    &::-webkit-scrollbar {
      width: 0;
    }
    height: 80dvh;
    padding: 5px;
    display: flex;
    flex-direction: column;
    gap: 10px;
  }
}
</style>
