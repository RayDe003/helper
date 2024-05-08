<template>
  <form class="form" @submit.prevent="submitForm">
    <div class="form-labels">
      <slot name="labels" />
    </div>
    <div class="form-buttons">
      <slot name="buttons" />
    </div>
  </form>
</template>

<script setup>
const emits = defineEmits(['submit-form']);
const submitForm = () => {
  emits('submit-form');
};
</script>

<style scoped lang="scss">
.form {
  width: 100%;
  display: flex;
  flex-direction: column;
  gap: 40px;
  &-labels {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }
}
</style>
