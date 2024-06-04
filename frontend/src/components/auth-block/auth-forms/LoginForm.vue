<template>
  <base-form @submit-form="submit">
    <template #labels>
      <form-field
        label="Логин"
        placeholder="Ваш логин"
        type="text"
        v-model="login"
        :validation-error="errors.login"
        @update:model-value="backendError = null"
      />
      <form-field
        label="Пароль"
        placeholder="Ваш пароль"
        type="password"
        v-model="password"
        :validation-error="errors.password"
        @update:model-value="backendError = null"
      />
    </template>
    <template #buttons>
      <base-button
        :full-width="true"
        :font-size="20"
        :font-weight="600"
        :disabled="isDisabled"
        type="submit"
        font-family="second"
        padding="16px 0"
        @click="backendError = null"
      >
        Войти
      </base-button>
      <p v-if="backendError" class="error-message">{{ backendError }}</p>
    </template>
  </base-form>
</template>

<script setup>
import { computed, ref } from "vue";
import { useRouter } from 'vue-router';
import * as yup from 'yup';
import { useForm } from 'vee-validate';

import { loginUser } from '@/api';
import { BaseButton, BaseForm, FormField } from '@/shared';

const loginValidationSchema = yup.object({
  login:
    yup
      .string()
      .min(3, 'Логин должен быть от 3 до 255 символов')
      .max(255, 'Пароль должен быть от 3 до 255 символов')
      .required('Обязательно для заполнения'),
  password:
    yup
      .string()
      .min(6, 'Пароль должен быть от 6 до 20 символов')
      .max(20, 'Пароль должен быть от 6 до 20 символов')
      .required('Обязательно для заполнения')
})

const { errors, handleSubmit, defineField } = useForm({
  validationSchema: loginValidationSchema,
  initialValues: {
    login: '',
    password: ''
  },
})

const [login] = defineField('login');
const [password] = defineField('password');

const isDisabled = computed(() => {
  const isError = errors.value.login || errors.value.password;
  const isEmpty = !login.value || !password.value;
  return !!isError || !!isEmpty;
});

const router = useRouter();
const backendError = ref(null);

const sendRequest = async (data) => {
  try {
    const { errorMessage } = await loginUser(data);
    backendError.value = errorMessage;
  } finally {
    if (!backendError.value) {
      await router.push({ name: 'plans' });
    }
  }
};

const submit = handleSubmit((values) => sendRequest(values))
</script>

<style scoped lang="scss">
.error-message {
  color: red;
  font-size: 18px;
  font-weight: 500;
  text-align: center;
}
</style>
