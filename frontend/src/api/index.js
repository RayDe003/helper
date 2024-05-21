import { reactive } from 'vue';

import { useAuthUser } from '@/stores';

export * from './current-user.js';

const { token } = useAuthUser();

export const apiLink = (api) => `${import.meta.env.VITE_API_URL}` + `${api}`;

export const apiHeaders = reactive({
  Authorization: `Bearer ${token}`
});
