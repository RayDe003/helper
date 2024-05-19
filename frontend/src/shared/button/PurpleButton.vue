<template>
  <base-button
    :font-size="16"
    :font-weight="500"
    padding="10px 24px 10px 20px"
    border-radius="26px"
    :bg-transparent="false"
    :full-width="false"
  >
    <span class="button__inner">
      <slot />
      <cross-icon v-if="icon === 'cross'" class="icon_rotate" color="white" />
      <arrow-icon v-else-if="icon === 'arrow'" />
    </span>
  </base-button>
</template>

<script setup>
import { ArrowIcon, BaseButton, CrossIcon } from '@/shared';

defineProps({
  icon: { type: String, default: null }
});
</script>

<style scoped lang="scss">
.button__inner {
  display: flex;
  width: fit-content;
  align-items: center;
  gap: 10px;
}
.icon_rotate {
  transform: rotate(45deg);
  width: 16px;
  height: 16px;
}
</style>
