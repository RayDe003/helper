<template>
  <article class="task">
    <base-checkbox
      :id="id"
      :name="mode"
      :value="completed"
      v-if="!settingMode"
      v-model="isChecked"
    >
      {{ name }}
    </base-checkbox>
    <toast-menu :mode="mode" @delete-task="emit('delete-task')" />
  </article>
</template>

<script setup>
import { ref, watch } from 'vue';

import { BaseCheckbox, ToastMenu } from '@/shared';

const props = defineProps({
  mode: {
    type: String,
    default: 'diary',
    validator: (value) => ['diary', 'procrastination'].includes(value)
  },
  id: {
    type: [String, Number],
    required: true
  },
  name: {
    type: String,
    default: ''
  },
  completed: {
    type: Boolean,
    default: false
  }
});
// eslint-disable-next-line vue/require-prop-types
const isChecked = ref(props.completed);
// eslint-disable-next-line vue/require-prop-types
const settingMode = defineModel({ default: false });

const emit = defineEmits(['delete-task', 'complete-task']);
watch(isChecked, () => {
  if (isChecked.value === true) {
    emit('complete-task');
  }
});
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
