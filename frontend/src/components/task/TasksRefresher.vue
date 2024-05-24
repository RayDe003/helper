<template>
  <p class="refresher" v-if="tasksLength">Заново <reload-icon /></p>
  <p class="refresher" v-else>Зарандомить <rotate-icon /></p>
</template>

<script setup>
import { ReloadIcon, RotateIcon } from '@/shared';

defineProps({
  tasksLength: { type: Number, default: 0 }
});
</script>

<style scoped lang="scss">
.refresher {
  display: flex;
  width: fit-content;
  cursor: pointer;
  align-items: center;
  gap: 10px;
  margin-bottom: 15px;
}
</style>
