<template>
  <base-form>
    <template #labels>
      <form-field label="Логин" placeholder="Ваш логин" type="text" />
      <form-field label="Пароль" placeholder="Ваш пароль" type="password" />
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
import { BaseButton, BaseForm, FormField } from '@/shared/ui';
</script>

<style scoped lang="scss"></style>
