<template>
  <span>{{ dateForPreview[0].toUpperCase() + dateForPreview.slice(1) }}</span>
</template>

<script setup>
import { intlFormat } from 'date-fns';
import { computed } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();
const props = defineProps({
  date: { type: [String, Date], required: true }
});

const dateForPreview = computed(() => {
  let date = '';
  try {
    date = intlFormat(
      props.date,
      {
        weekday: 'long',
        day: 'numeric',
        month: 'long'
      },
      {
        locale: 'ru-RU'
      }
    );
  } catch (e) {
    router.back();
  }
  return date;
});
</script>
