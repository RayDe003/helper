import { ref } from 'vue';

export const tasksDiary = ref([
  {
    id: 'd-1',
    title: 'Помидоры',
    description: 'Купить на рынке у бабы тани',
    completed: false,
    priority: 1,
    notification: 'хз что-то',
    deadline: new Date(),
    children: [
      {
        task_id: 'sub-1',
        completed: false,
        title: 'Купить бомжа'
      },
      {
        task_id: 'sub-2',
        completed: false,
        title: 'Купи бомжа'
      }
    ]
  },
  {
    id: 'd-2',
    title: 'Огурцы',
    description: 'Купить на рынке у бабы тани',
    priority: 1,
    completed: false,
    deadline: new Date(),
    children: []
  }
]);

export const tasksProcrastination = ref([
  {
    id: 'p-1',
    title: 'Купить дошик',
    description: 'Купить на рынке у бабы тани',
    priority: 1,
    completed: false,
    deadline: new Date(),
    children: []
  },
  {
    id: 'p-2',
    title: 'Продать слона',
    description: 'Купить на рынке у бабы тани',
    priority: 1,
    completed: false,
    deadline: new Date(),
    children: []
  }
]);
