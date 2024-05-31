import axios from 'axios';
import { storeToRefs } from 'pinia';

import { useAuthUser } from '@/stores';

import { apiLink } from './index.js';

const authStore = useAuthUser();
const { userData } = storeToRefs(authStore);
export const loginUser = async (data) => {
  let errorMessage = null;
  await axios
    .post(apiLink('login'), data)
    .then((response) => {
      useAuthUser().setToken(response.data.token);
      userData.value = response.data.user;
    })
    .catch((error) => {
      errorMessage = error.response.data.message;
    });

  return { errorMessage };
};

export const registerUser = async (data) => {
  let errorMessage = null;
  await axios.post(apiLink('register'), data).catch((error) => {
    errorMessage = error.response.data.message;
  });
  return { errorMessage };
};
