<template>
  <article class="task">
    <base-checkbox>{{ name }}</base-checkbox>
    <toast-menu :mode="mode" @delete-task="emit('delete-task')" />
  </article>
</template>

<script setup>
import { BaseCheckbox, ToastMenu } from '@/shared';

defineProps({
  mode: {
    type: String,
    default: 'diary',
    validator: (value) => ['diary', 'procrastination'].includes(value)
  },
  id: {
    type: Number,
    required: true
  },
  name: {
    type: String,
    default: ''
  }
});

const emit = defineEmits(['delete-task']);
</script>

<style scoped lang="scss">
.task {
  display: flex;
  width: 100%;
  height: fit-content;
  justify-content: space-between;
  align-items: center;
  user-select: none;
}
</style>
