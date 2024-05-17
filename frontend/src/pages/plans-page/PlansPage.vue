<template>
  <main-layout>
    <router-view />
  </main-layout>
</template>

<script setup>
import { watch } from 'vue';
import { useRouter } from 'vue-router';

import { getUserData } from '@/api';
import { MainLayout } from '@/layouts';

const { pending, error } = await getUserData();
const router = useRouter();

watch(pending, () => {
  if (error.value) router.push({ name: 'login' });
});
</script>

<style scoped lang="scss"></style>
