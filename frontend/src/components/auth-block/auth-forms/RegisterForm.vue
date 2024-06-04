<template>
  <base-form @submit-form="sendRequest">
    <template #labels>
      <form-field
        label="Имя"
        placeholder="Ваше имя"
        type="text"
        v-model="submitData.login"
        @update:model-value="error = null"
      />
      <form-field
        label="Электронная почта"
        placeholder="Ваш e-mail"
        type="email"
        v-model="submitData.email"
        @update:model-value="error = null"
      />
      <form-field
        label="Пароль"
        placeholder="Придумайте пароль"
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
        @click="error = null"
      >
        Зарегистрироваться
      </base-button>
      <p class="form__description">
        Нажимая на кнопку “Зарегистрироваться” вы даёте согласие на
        <a href="#" class="form__description-underline">
          обработку персональных данных
        </a>
      </p>
      <p v-if="error" class="error-message">{{ error }}</p>
    </template>
  </base-form>
</template>

<script setup>
import { reactive, ref } from 'vue';
import { useRouter } from 'vue-router';

import { registerUser } from '@/api';
import { BaseButton, BaseForm, FormField } from '@/shared';

const submitData = reactive({
  login: '',
  email: '',
  password: '',
});

const router = useRouter();
const error = ref(null);

const sendRequest = async () => {
  try {
    const { errorMessage } = await registerUser(submitData);
    error.value = errorMessage;
  } finally {
    if (!error.value) {
      await router.push({ name: 'plans' });
    }
  }
};
</script>

<style scoped lang="scss">
.form__description {
  margin-top: 15px;
  font-family: $second-font;
  text-align: center;
  line-height: 150%;
  color: $main-color;
  &-underline {
    text-decoration: underline;
  }
}
.error-message {
  color: red;
  font-size: 18px;
  font-weight: 500;
  text-align: center;
}
</style>
