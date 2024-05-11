<template>
  <base-form @submit-form="registerUser">
    <template #labels>
      <form-field
        label="Имя"
        placeholder="Ваше имя"
        type="text"
        v-model="submitData.name"
      />
      <form-field
        label="Электронная почта"
        placeholder="Ваш e-mail"
        type="email"
        v-model="submitData.email"
      />
      <form-field
        label="Пароль"
        placeholder="Придумайте пароль"
        type="password"
        v-model="submitData.password"
      />
      <form-field
        label="Пароль"
        placeholder="Повторите пароль"
        type="password"
        v-model="submitData.password_confirmation"
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
        Зарегистрироваться
      </base-button>
      <p class="form__description">
        Нажимая на кнопку “Зарегистрироваться” вы даёте согласие на
        <a href="#" class="underline"> обработку персональных данных </a>
      </p>
    </template>
  </base-form>
</template>

<script setup>
import { reactive } from 'vue';

import { BaseButton, BaseForm, FormField } from '@/shared/index.js';

const submitData = reactive({
  name: '',
  email: '',
  password: '',
  password_confirmation: ''
});
const emit = defineEmits(['registration-user']);

const registerUser = () => {
  emit('registration-user', submitData);
};
</script>

<style scoped lang="scss">
.form__description {
  margin-top: 15px;
  font-family: $second-font;
  text-align: center;
  line-height: 150%;
  color: $main-color;
}
</style>
