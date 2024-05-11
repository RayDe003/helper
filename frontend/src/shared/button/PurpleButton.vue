<template>
  <base-button
    font-size="16px"
    font-weight="500"
    padding="10px 24px 10px 20px"
    border-radius="26px"
    :bg-transparent="false"
  >
    <span class="button__inner">
      <slot /> <cross-icon class="icon_rotate" color="white" />
    </span>
  </base-button>
</template>

<script setup>
import { BaseButton, CrossIcon } from '@/shared';
</script>

<style scoped lang="scss">
.button__inner {
  display: flex;
  align-items: center;
  gap: 10px;
}
.icon_rotate {
  transform: rotate(45deg);
  width: 16px;
  height: 16px;
}
</style>
