<template>
  <auth-layout>
    <auth-block page="register" @send-request="registerUser" />
  </auth-layout>
</template>

<script setup>
import { AuthBlock } from '@/components';
import { AuthLayout } from '@/layouts';
import { useAuthUser } from "@/stores";

const registerUser = async (value) => {
  // await axios.post('/', value)
  console.log(value);
  useAuthUser().setToken('tipatoken');
}
</script>

<style scoped lang="scss"></style>
