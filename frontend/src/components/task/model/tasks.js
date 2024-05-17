import { ref } from 'vue';

export const tasksDiary = ref([
  {
    id: 1,
    name: 'Помидоры',
    completed: false
  },
  {
    id: 2,
    name: 'Огурцы',
    completed: false
  }
]);

export const tasksProcrastination = ref([
  {
    id: 3,
    name: 'Купить дошик',
    completed: false
  },
  {
    id: 4,
    name: 'Продать слона',
    completed: false
  }
]);
