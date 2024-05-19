<template>
  <p class="refresher" v-if="tasksLength">Заново <reload-icon /></p>
  <p class="refresher" v-else>Зарандомить <rotate-icon /></p>
</template>

<script setup>
import { ReloadIcon } from '@/shared';
import RotateIcon from '@/shared/icons/RotateIcon.vue';

defineProps({
  tasksLength: { type: Number, default: 0 }
});
</script>

<style scoped lang="scss">
.refresher {
  display: flex;
  cursor: pointer;
  align-items: center;
  gap: 10px;
  margin-bottom: 15px;
}
</style>
