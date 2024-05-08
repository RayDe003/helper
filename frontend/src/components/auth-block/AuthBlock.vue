<template>
  <section class="auth-block">
    <router-link class="auth-block__close" to="/">
      <cross-icon />
    </router-link>
    <div class="auth-block__inner">
      <auth-switcher :page="page" />
      <login-form v-if="page === 'login'" />
      <register-form v-else />
    </div>
  </section>
</template>

<script setup>
import { CrossIcon } from '@/shared';

import LoginForm from './auth-forms/LoginForm.vue';
import RegisterForm from './auth-forms/RegisterForm.vue';
import AuthSwitcher from './auth-switcher/AuthSwitcher.vue';

const props = defineProps({
  page: {
    type: String,
    required: true,
    validator: (value) => ['login', 'register'].includes(value)
  }
});
</script>

<style scoped lang="scss">
.auth-block {
  position: relative;
  background: white;
  padding: 80px 70px;
  border-radius: 10px;
  &__inner {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 40px;
    width: 400px;
  }
  &__close {
    position: absolute;
    display: flex;
    align-items: center;
    justify-content: center;
    top: 10px;
    right: 10px;
    cursor: pointer;
    width: 35px;
    height: 35px;
  }
}
</style>
