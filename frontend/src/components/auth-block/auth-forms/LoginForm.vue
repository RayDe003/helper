<template>
  <base-form @submit-form="sendRequest">
    <template #labels>
      <form-field
        label="Логин"
        placeholder="Ваш логин"
        type="text"
        v-model="submitData.login"
        @update:model-value="error = null"
      />
      <form-field
        label="Пароль"
        placeholder="Ваш пароль"
        type="password"
        v-model="submitData.password"
        @update:model-value="error = null"
      />
    </template>
    <template #buttons>
      <base-button
        :full-width="true"
        :font-size="20"
        :font-weight="600"
        font-family="second"
        padding="16px 0"
      >
        Войти
      </base-button>
      <p v-if="error" class="error-message">{{ error }}</p>
    </template>
  </base-form>
</template>

<script setup>
import { reactive, ref } from 'vue';
import { useRouter } from 'vue-router';

import { loginUser } from '@/api';
import { BaseButton, BaseForm, FormField } from '@/shared';

const submitData = reactive({
  login: '',
  password: ''
});

const router = useRouter();
const error = ref(null);

const sendRequest = async () => {
  try {
    const { errorMessage } = await loginUser(submitData);
    error.value = errorMessage;
  } finally {
    if (!error.value) {
      await router.push({ name: 'plans' });
    }
  }
};
</script>

<style scoped lang="scss">
.error-message {
  color: red;
  font-size: 18px;
  font-weight: 500;
  text-align: center;
}
</style>
