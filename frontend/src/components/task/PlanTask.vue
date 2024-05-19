<template>
  <article class="task" :class="{ 'task-settings': settingMode }">
    <div v-if="!settingMode" class="task-wrapper">
      <p class="task-checkbox">
        <base-checkbox
          :id="id"
          :name="mode"
          :value="completed"
          v-model="isChecked"
        >
          {{ mode ? name : trimText(name, 10) }}
        </base-checkbox>
        <corner-icon
          class="task-checkbox__icon"
          :class="{ 'task-checkbox__icon_rotate': showedSubtasks }"
          v-if="children.length"
          @click="showSubtasks"
        />
      </p>
      <subtask-list
        :mode="mode"
        :sub-tasks="children"
        class="task-sub"
        v-if="showedSubtasks"
        @complete-subtask="completeSubtask"
      />
    </div>
    <task-settings
      :id="id"
      :name="name"
      :description="description"
      :children="children"
      :priority="priority"
      :deadline="deadline"
      @change-task="changeTask"
      v-else
    />
    <toast-menu
      v-if="!isNewTask"
      :mode="mode"
      v-model="settingMode"
      @delete-task="emit('delete-task')"
      @randomize-task="emit('randomize-task')"
    />
  </article>
</template>

<script setup>
import { ref, watch } from 'vue';

import { SubtaskList, TaskSettings } from '@/components';
import { BaseCheckbox, ToastMenu } from '@/shared';
import { CornerIcon } from '@/shared/index.js';

import { trimText } from './model/functions.js';

const props = defineProps({
  mode: {
    type: String,
    default: null,
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
  description: {
    type: String,
    default: ''
  },
  children: {
    type: Array,
    default: () => []
  },
  priority: {
    type: Number,
    default: null
  },
  deadline: {
    type: [Date, String],
    default: null
  },
  completed: {
    type: Boolean,
    default: false
  },
  settingMode: {
    type: Boolean,
    default: false
  },
  isNewTask: {
    type: Boolean,
    default: false
  }
});
const emit = defineEmits([
  'delete-task',
  'complete-task',
  'change-task',
  'create-task',
  'complete-subtask',
  'randomize-task'
]);

const isChecked = ref(props.completed);
const settingMode = ref(props.settingMode);

const showedSubtasks = ref(false);
const showSubtasks = () => (showedSubtasks.value = !showedSubtasks.value);

const changeTask = (data) => {
  settingMode.value = false;
  emit('change-task', data);
};

const completeSubtask = (id) => emit('complete-subtask', [props.id, id]);

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
  align-items: start;
  user-select: none;
  &-settings {
    background: $light-purple;
    padding: 17px 20px;
    border-radius: 10px;
  }
  &-wrapper {
    display: flex;
    flex-direction: column;
    gap: 10px;
  }
  &-sub {
    margin-left: 25px;
  }
  &-checkbox {
    display: flex;
    align-items: center;
    gap: 10px;

    &__icon {
      display: block;
      transform: rotate(0deg);
      cursor: pointer;

      &_rotate {
        transition: all 0.2s;
        transform: rotate(180deg);
      }
    }
  }
}
</style>
