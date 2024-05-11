<template>
  <div class="main-layout">
    <app-header />
    <main class="main">
      <slot />
    </main>
  </div>
</template>

<script setup>
import { onBeforeMount } from "vue";
import { useAuthUser } from "@/stores";
import { useRouter } from "vue-router";
import { AppHeader } from "@/components";

const router = useRouter()
onBeforeMount(async () => {
  if (!useAuthUser().token) {
    await router.push('/login');
  }
});
</script>

<style scoped lang="scss">
.main {
  width: 100%;
  min-height: 100%;
}

.main-layout {
   width: 100%;
   min-height: 100vh;
   padding: 20px;
   background: #fff;
 }
</style>