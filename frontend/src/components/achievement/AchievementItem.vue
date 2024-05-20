<template>
  <article class="achievement" :class="{ achievement_completed: completed }">
    <div class="achievement__left">
      <achievements-icon :color="completed ? '#9747FF' : '#AAAAAA'" />
      {{ title }}
    </div>
    <div class="achievement__right" v-if="completed">
      Получено {{ dateForPreview }} <complete-icon />
    </div>
  </article>
</template>

<script setup>
import { intlFormat } from 'date-fns';
import { computed } from 'vue';

import { AchievementsIcon } from '@/shared';
import { CompleteIcon } from '@/shared/index.js';

const props = defineProps({
  id: { type: Number, required: true },
  title: { type: String, default: '' },
  date: { type: [Date, String], default: new Date() },
  completed: { type: Boolean, default: false }
});

const dateForPreview = computed(() =>
  intlFormat(props.date, { day: 'numeric', month: 'numeric', year: 'numeric' })
);
</script>

<style scoped lang="scss">
.achievement {
  padding: 17px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  color: #aaaaaa;
  border: 2px solid #aaaaaa;
  border-radius: 10px;
  &_completed {
    color: inherit;
    border: 2px solid #9747ff;
  }
  &__left {
    display: flex;
    align-items: center;
    gap: 22px;
  }
  &__right {
    display: flex;
    align-items: center;
    gap: 10px;
  }
}
</style>
