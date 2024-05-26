<template>
  <header class="header">
    <div class="links">
      <router-link
        to="/plans/today"
        :class="{ links_selected: route.path === '/plans/today' }"
      >
        Планы на сегодня
      </router-link>
      <router-link
        to="/plans/weeks"
        :class="{ links_selected: route.path === '/plans/weeks' }"
        >Планы на ближайшие две недели
      </router-link>
      <router-link
        to="/plans/calendar"
        :class="{ links_selected: route.path === '/plans/calendar' }"
      >
        Календарь планов
      </router-link>
      <router-link
        to="/achievements"
        :class="{ links_selected: route.path === '/achievements' }"
      >
        Достижения
      </router-link>
    </div>
    <div class="links">
      <div @click="showSettings">Настройки</div>
      <span @click="logout">Выход</span>
    </div>
    <system-settings v-show="showedSettings" @close-settings="hideSettings" />
  </header>
</template>

<script setup>
import { ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';

import { SystemSettings } from '@/components';
import { useAuthUser } from '@/stores';

const showedSettings = ref(false);
const showSettings = () => {
  showedSettings.value = true;
};

const hideSettings = () => {
  showedSettings.value = false;
};

const router = useRouter();
const route = useRoute();
const logout = () => {
  useAuthUser().clearToken();
  router.push({ name: 'login' });
};
</script>

<style scoped lang="scss">
.header {
  display: flex;
  justify-content: space-between;
  position: sticky;
  top: 20px;
  width: 100%;
  padding: 18px;
  border: 2px solid #1e1e1e;
  background: #fff;
  border-radius: 10px;
  z-index: 20;
}

.links {
  display: flex;
  gap: 60px;
  & a {
    color: inherit;
  }
  & > * {
    cursor: pointer;
    line-height: 1;
  }
  &_selected {
    text-decoration: underline;
  }
}
</style>
