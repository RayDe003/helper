import { defineStore } from 'pinia';
import { ref } from 'vue';
import { useCookies } from 'vue3-cookies';

export const { cookies } = useCookies();

export const useAuthUser = defineStore('auth-user', () => {
  const token = ref(cookies.get('token'));

  const setToken = (value) => {
    token.value = value;
    cookies.set('token', value);
  };

  const clearToken = () => {
    token.value = null;
    cookies.remove('token');
  };

  return { token, setToken, clearToken };
});
