<template>
  <section class="settings">
    <input
      type="text"
      class="settings-input"
      @change="inputData('title')"
      v-model="settingsData.title"
      @keyup.enter="submitSettings('title')"
    />
    <input
      type="text"
      class="settings-input"
      @change="inputData('description')"
      v-model="settingsData.description"
      @keyup.enter="submitSettings('description')"
    />
    <div class="settings-date" @click="clickDatePicker">
      <calendar-icon />
      <p style="position: relative">
        Дата:
        <span class="settings-date__show">
          {{ dateForPreview }}
        </span>
        <input
          style="
            position: absolute;
            left: 0;
            bottom: -5px;
            opacity: 0.01;
            z-index: 0;
          "
          type="date"
          ref="datePicker"
          v-model="settingsData.deadline"
        />
      </p>
    </div>
    <div class="settings-subtasks">
      <p class="settings-subtasks__title">
        <span class="settings-subtasks__name">
          <check-list-icon />
          Чек лист
        </span>
        <cross-icon
          class="settings-subtasks__icon"
          color="black"
          @click="addSubtask"
        />
      </p>
      <section class="settings-subtasks__list" :key="rerenderSubsKey">
        <input
          v-for="(child, ind) in children"
          :key="child.task_id"
          v-model="child.title"
          class="settings-input"
          type="text"
          @change="inputData('children', ind)"
          @keyup.enter="submitSettings('children', ind)"
        />
      </section>
    </div>
    <drop-select
      v-model="settingsData.priority_id"
      :parameters="priorityParameters"
      name="priority"
      title="Приоритет"
    />
    <button class="settings-button" @click="submitSettings">Подтвердить</button>
  </section>
</template>

<script setup>
import { intlFormat, isToday } from 'date-fns';
import { computed, reactive, ref } from 'vue';

import { CalendarIcon, CheckListIcon, CrossIcon, DropSelect } from '@/shared';

const props = defineProps({
  id: { type: [String, Number], required: true },
  title: { type: String, default: 'Новая задача' },
  description: { type: String, default: 'Описание' },
  deadline: {
    type: [Date, String],
    default: null
  },
  children: {
    type: Array,
    default: () => []
  },
  priority_id: { type: Number, default: null }
});

const emits = defineEmits(['change-task']);

const priorityParameters = [
  {
    id: 1,
    value: 1,
    title: 'Низкий'
  },
  {
    id: 2,
    value: 2,
    title: 'Средний'
  },
  {
    id: 3,
    value: 3,
    title: 'Высокий'
  }
];

const settingsData = reactive({
  id: props.id,
  title: props.title,
  description: props.description,
  deadline: props.deadline,
  // children: props.children,
  priority_id: props.priority_id
});

const dateForPreview = computed(() => {
  if (settingsData.deadline) {
    return isToday(settingsData.deadline)
      ? 'Сегодня'
      : intlFormat(
          settingsData.deadline,
          {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
          },
          {
            locale: 'ru-RU'
          }
        );
  } else return 'не задана';
});

const inputData = (settingName, index = null) => {
  if (settingsData[settingName] === '') {
    switch (settingName) {
      case 'title':
        settingsData[settingName] = 'Новая задача';
        break;
      case 'description':
        settingsData[settingName] = 'Описание';
        break;
    }
  }
  if (index !== null && !settingsData.children[index]?.title) {
    settingsData.children[index].title = 'Подзадача';
  }
};

const rerenderSubsKey = ref(1);

const addSubtask = () => {
  rerenderSubsKey.value++;
  settingsData.children.push({
    task_id: `new-sub-${settingsData.children.length}`,
    is_complete: false,
    title: 'Подзадача'
  });
};

const submitSettings = (triggerName = null, ind = null) => {
  triggerName ? inputData(triggerName, ind) : null;
  emits('change-task', settingsData);
};
const datePicker = ref();
const clickDatePicker = () => datePicker.value.showPicker();
</script>

<style scoped lang="scss">
.settings {
  display: flex;
  flex-direction: column;
  width: 95%;
  gap: 15px;

  &-input {
    border: none;
    width: 100%;
    padding: 0;
    background: transparent;
    font-size: 16px;
    font-weight: 500;
    opacity: 0.8;
    &:focus {
      opacity: 1;
    }
  }

  &-button {
    background: #c192ff;
    border: none;
    color: white;
    font-size: 16px;
    margin-top: 10px;
    padding: 3px;
    width: 250px;
    border-radius: 7px;
    cursor: pointer;
  }

  &-date {
    display: flex;
    align-items: center;
    cursor: pointer;
    gap: 10px;

    &__show {
      z-index: 5;
    }
    & > p > span {
      color: #9747ff;
    }
  }

  &-subtasks {
    &__title {
      display: inline-flex;
      align-items: center;
      gap: 14px;
      margin-bottom: 10px;
    }
    &__name {
      display: inline-flex;
      align-items: center;
      gap: 10px;
    }
    &__icon {
      display: block;
      width: 16px;
      height: 16px;
      cursor: pointer;
      transform: rotate(45deg);
    }

    &__list {
      margin-left: 25px;
      display: flex;
      flex-direction: column;
      gap: 10px;
    }
  }
}
</style>
