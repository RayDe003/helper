<template>
  <div class="checkbox-area" @click="switchCheck">
    <div class="checkbox" :class="{ checkbox_checked: isChecked }">
      <check-icon v-if="isChecked" />
    </div>
    <span><slot /></span>
  </div>
</template>

<script setup>
import { CheckIcon } from '@/shared';

// eslint-disable-next-line vue/require-prop-types
const isChecked = defineModel({ default: false });

const switchCheck = () => (isChecked.value = !isChecked.value);
</script>

<style scoped lang="scss">
.checkbox {
  border: 1px solid $accent-black;
  width: 15px;
  height: 15px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 4px;
  &-area {
    display: flex;
    cursor: pointer;
    gap: 10px;
    align-items: center;
  }
  &_checked {
    border: 1px solid $accent-purple;
  }
}
</style>
