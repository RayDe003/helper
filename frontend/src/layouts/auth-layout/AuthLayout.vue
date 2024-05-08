<template>
  <main class="auth-layout">
    <slot />
  </main>
</template>

<script setup></script>

<style scoped lang="scss">
.auth-layout {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
  min-height: 100vh;
  background: url('@/assets/images/home-page/background.jpg') no-repeat;
  background-size: cover;
}
</style>
