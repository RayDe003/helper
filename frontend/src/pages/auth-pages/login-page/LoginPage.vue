<template>
  <auth-layout>
    <auth-block page="login" @send-request="loginUser" />
  </auth-layout>
</template>

<script setup>
import { AuthBlock } from '@/components';
import { AuthLayout } from '@/layouts';
import { useAuthUser } from "@/stores";

const loginUser = async (value) => {
  // await axios.post('/', value)
  console.log(value);
  useAuthUser().setToken('tipatoken');
}
</script>

<style scoped lang="scss"></style>
