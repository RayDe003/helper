import { reactive } from 'vue';

import { useAuthUser } from '@/stores';

const { token } = useAuthUser();

export const apiLink = (api) => `${import.meta.env.VITE_API_URL}` + `${api}`;

export const apiHeaders = reactive({
  Authorization: `Bearer ${token}`
});

export * from './current-user.js';
export * from './user-achievements.js';
export * from './user-subtasks.js';
export * from './user-system-tasks.js';
export * from './user-tasks.js';
