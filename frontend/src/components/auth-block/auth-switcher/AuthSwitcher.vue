<template>
  <div class="auth-switcher">
    <router-link
      to="/login"
      class="auth-switcher__link"
      :class="{ 'auth-switcher__link_active': page === 'login' }"
    >
      Вход
    </router-link>
    <div class="auth-switcher__line" />
    <router-link
      to="/register"
      class="auth-switcher__link"
      :class="{ 'auth-switcher__link_active': page === 'register' }"
    >
      Регистрация
    </router-link>
  </div>
</template>

<script setup>
defineProps({
  page: {
    type: String,
    validator: (value) => ['login', 'register'].includes(value),
    required: true
  }
});
</script>

<style scoped lang="scss">
.auth-switcher {
  display: inline-flex;
  align-items: center;
  height: 48px;
  gap: 18px;
  &__link {
    font-weight: 900;
    font-size: 30px;
    letter-spacing: 0.05em;
    color: #aaa;
    transition: all 0.2s;
    &_active {
      color: $main-color;
    }
  }
  &__line {
    width: 2px;
    display: inline-block;
    height: 100%;
    border-radius: 50%;
    background: #aaa;
  }
}
</style>
