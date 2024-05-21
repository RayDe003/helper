import axios from 'axios';
import { storeToRefs } from 'pinia';

import { useAuthUser } from '@/stores';

import { apiLink } from './index.js';

const authStore = useAuthUser();
const { userData, token } = storeToRefs(authStore);
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

// export const getUserData = async () => {
//   const pending = ref(true);
//   const error = ref(null);
//   try {
//     await axios
//       .get(apiLink('users/info'), {
//         headers: {
//           Accept: `Bearer ${token}`
//         }
//       })
//       .then((response) => console.log(response))
//       .catch((err) => (error.value = err));
//   } finally {
//     pending.value = false;
//   }
//   return { pending, error };
// };
