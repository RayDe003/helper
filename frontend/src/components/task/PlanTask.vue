<template>
  <article class="task" :class="{ 'task-settings': settingMode }">
    <cross-icon
      class="task-cross"
      v-if="isNewTask"
      @click="emit('create-mode-leave')"
    />
    <div v-if="!settingMode" class="task-wrapper">
      <p class="task-checkbox">
        <base-checkbox
          :id="id"
          :name="mode"
          :value="is_complete"
          :reverse="reverse"
          v-model="isChecked"
        >
          {{ mode ? title : trimText(title, 10) }}
        </base-checkbox>
        <corner-icon
          class="task-checkbox__icon"
          :class="{ 'task-checkbox__icon_rotate': showedSubtasks }"
          v-if="sub_tasks.length"
          @click="showSubtasks"
        />
      </p>
      <subtask-list
        :mode="mode"
        :sub-tasks="sub_tasks"
        class="task-sub"
        v-if="showedSubtasks"
        @complete-subtask="completeSubtask"
      />
    </div>
    <task-settings
      :id="id"
      :title="title"
      :description="description"
      :sub_tasks="sub_tasks"
      :priority_id="priority_id"
      :deadline="deadline"
      :is-new-task="isNewTask"
      :not_type_id="not_type_id"
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
import { BaseCheckbox, CornerIcon, CrossIcon, ToastMenu } from '@/shared';

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
  title: {
    type: String,
    default: ''
  },
  description: {
    type: String,
    default: ''
  },
  sub_tasks: {
    type: Array,
    default: () => []
  },
  priority_id: {
    type: Number,
    default: null
  },
  deadline: {
    type: [Date, String],
    default: null
  },
  is_complete: {
    type: [Number, Boolean],
    default: false
  },
  settingMode: {
    type: Boolean,
    default: false
  },
  isNewTask: {
    type: Boolean,
    default: false
  },
  reverse: {
    type: Boolean,
    default: false
  },
  not_type_id: {
    type: Number,
    default: null
  }
});
const emit = defineEmits([
  'delete-task',
  'complete-task',
  'change-task',
  'create-task',
  'complete-subtask',
  'randomize-task',
  'create-mode-leave'
]);

const isChecked = ref(props.is_complete);
const settingMode = ref(props.settingMode);

const showedSubtasks = ref(false);
const showSubtasks = () => (showedSubtasks.value = !showedSubtasks.value);

const changeTask = (data) => {
  settingMode.value = false;
  emit('change-task', data);
};

const completeSubtask = (id) =>
  emit('complete-subtask', { taskId: props.id, subTaskId: id });

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
  position: relative;
  &-cross {
    display: block;
    position: absolute;
    top: 15px;
    right: 15px;
    cursor: pointer;
  }
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
