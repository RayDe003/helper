<template>
  <div class="form-field">
    <label class="form-field__label">{{ label }}</label>
    <form-input
      :type="type"
      :placeholder="placeholder"
      :model-value="modelValue"
      @update:model-value="updateValue"
    />
  </div>
</template>

<script setup>
import { FormInput } from '@/shared/index.js';

defineProps({
  type: {
    type: String,
    default: 'text',
    validator: (value) => ['text', 'email', 'password'].includes(value)
  },
  modelValue: {
    type: [String, Number],
    default: ''
  },
  placeholder: {
    type: String,
    default: ''
  },
  label: {
    type: String,
    default: ''
  }
});

const emit = defineEmits(['update:modelValue']);
const updateValue = (value) => {
  emit('update:modelValue', value);
};
</script>

<style scoped lang="scss">
.form-field {
  width: 100%;
  height: fit-content;
  display: flex;
  flex-direction: column;
  gap: 10px;
  &__label {
    font-weight: 600;
    font-family: $second-font;
    font-size: 20px;
    color: $main-color;
  }
}
</style>
