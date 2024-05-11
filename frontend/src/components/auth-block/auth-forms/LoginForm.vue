<template>
  <base-form @submit-form="loginUser">
    <template #labels>
      <form-field
        label="Логин"
        placeholder="Ваш логин"
        type="text"
        v-model="submitData.login"
      />
      <form-field
        label="Пароль"
        placeholder="Ваш пароль"
        type="password"
        v-model="submitData.password"
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
    </template>
  </base-form>
</template>

<script setup>
import { reactive } from 'vue';

import { BaseButton, BaseForm, FormField } from '@/shared/ui';

const submitData = reactive({
  login: '',
  password: ''
});
const emit = defineEmits(['login-user']);

const loginUser = () => {
  emit('login-user', submitData);
};
</script>

<style scoped lang="scss"></style>
