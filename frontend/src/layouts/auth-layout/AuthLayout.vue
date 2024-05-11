<template>
  <main class="auth-layout">
    <slot />
  </main>
</template>

<script setup>
import { useRouter } from "vue-router";
import { onBeforeMount } from "vue";
import { useAuthUser } from "@/stores";

const router = useRouter()
onBeforeMount(async () => {
  if (useAuthUser().token) {
    await router.push('/plans')
  }
});
</script>

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
