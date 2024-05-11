<template>
  <auth-layout>
    <auth-block page="register" @send-request="registerUser" />
  </auth-layout>
</template>

<script setup>
import { AuthBlock } from '@/components';
import { AuthLayout } from '@/layouts';
import { useAuthUser } from '@/stores';
import { useRouter } from "vue-router";

const router = useRouter();

const registerUser = async (value) => {
  // await axios.post('/', value)
  console.log(value);
  useAuthUser().setToken('tipatoken');

  await router.push({ name: 'plans' });
};
</script>

<style scoped lang="scss"></style>
