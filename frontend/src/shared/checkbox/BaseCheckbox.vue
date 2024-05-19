<template>
  <div class="checkbox-area" @click="switchCheck">
    <div
      class="checkbox"
      :class="{ checkbox_checked: type === 'checkbox' ? isChecked : checked }"
    >
      <input
        :id="id"
        :type="type"
        :name="name"
        hidden
        v-model="isChecked"
        :value="value"
        :disabled="type === 'checkbox' && isChecked"
        ref="checkbox"
      />
      <check-icon v-if="type === 'checkbox' ? isChecked : checked" />
    </div>
    <span
      class="checkbox__text"
      :class="{ 'checkbox_checked-text': type === 'checkbox' && isChecked }"
    >
      <slot />
    </span>
  </div>
</template>

<script setup>
import { ref } from 'vue';

import { CheckIcon } from '@/shared';

const props = defineProps({
  id: {
    type: [String, Number],
    required: true
  },
  type: {
    type: String,
    default: 'checkbox',
    validator: (value) => ['checkbox', 'radio'].includes(value)
  },
  name: {
    type: String,
    default: null
  },
  value: {
    type: [String, Number, Boolean],
    default: null
  },
  checked: {
    type: Boolean,
    default: false
  },
  reverse: {
    type: Boolean,
    default: false
  }
});

// eslint-disable-next-line vue/require-prop-types
const isChecked = defineModel({ default: true });
const checkbox = ref();
const switchCheck = () => checkbox.value.click();
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

  &__text {
    text-overflow: ellipsis;
    text-wrap: none;
    overflow: hidden;
  }
  &-area {
    display: flex;
    cursor: pointer;
    gap: 10px;
    align-items: center;
  }
  &_checked {
    border: 1px solid $accent-purple;
    transition: opacity 0.2s;
    opacity: 0.8;
    &-text {
      text-decoration: line-through;
    }
  }
}
</style>
