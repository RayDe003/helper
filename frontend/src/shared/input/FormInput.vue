<template>
  <input
    class="form-input"
    :type="type"
    :value="modelValue"
    :placeholder="placeholder"
    @input="updateValue"
  />
</template>

<script setup>
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
  }
});
const emit = defineEmits(['update:modelValue']);

const updateValue = (event) => {
  const inputElement = event.target;
  emit('update:modelValue', inputElement.value);
};
</script>

<style scoped lang="scss">
.form-input {
  width: 100%;
  height: fit-content;
  padding: 12px;
  background: transparent;
  border: 2px solid $main-color;
  font-size: 16px;
  font-family: $second-font;
  font-weight: 600;
}
</style>
