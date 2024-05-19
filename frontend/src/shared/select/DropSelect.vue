<template>
  <div class="select">
    <p class="select__switcher" @click="showSelect">
      <span>{{ title }}</span>
      <corner-icon :class="{ icon_rotate: isShowedSelect }" />
    </p>
    <section class="select-checkbox__wrapper" v-if="isShowedSelect">
      <base-checkbox
        type="radio"
        v-for="(parameter, ind) in parameters"
        :id="`pr-${parameter.id}`"
        :key="ind"
        :name="name"
        :value="parameter.value"
        :checked="parameter.value === modelValue"
        v-model="modelValue"
      >
        {{ parameter.title }}
      </base-checkbox>
    </section>
  </div>
</template>

<script setup>
import { ref } from 'vue';

import { BaseCheckbox, CornerIcon } from '@/shared';

defineProps({
  title: { type: String, default: '' },
  name: { type: String, default: '' },
  parameters: { type: Array, required: true }
});

const isShowedSelect = ref(false);
// eslint-disable-next-line vue/require-prop-types
const modelValue = defineModel();
const showSelect = () => (isShowedSelect.value = !isShowedSelect.value);
</script>

<style scoped lang="scss">
.select {
  display: flex;
  flex-direction: column;
  gap: 10px;

  &__switcher {
    display: flex;
    gap: 10px;
    align-items: center;
    cursor: pointer;
  }

  &-checkbox__wrapper {
    display: flex;
    flex-direction: column;
    gap: 10px;
  }
}
.icon {
  &_rotate {
    transition: 0.2s all;
    transform: rotate(180deg);
  }
}
</style>
