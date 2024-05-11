<template>
  <header class="header">
    <div class="links">
      <router-link
        to="/plans/today"
        :class="{'links_selected': route.path === '/plans/today' }"
      >
        Планы на сегодня
      </router-link>
      <router-link
        to="/plans/weeks"
        :class="{'links_selected': route.path === '/plans/weeks' }"
      >Планы на ближайшие две недели
      </router-link>
      <router-link
        to="/plans/calendar"
        :class="{'links_selected': route.path === '/plans/calendar' }"
      >
        Календарь планов
      </router-link>
      <router-link
        to="/achievement"
        :class="{'links_selected': route.path === '/achievement' }"
      >
        Ачивки
      </router-link>
    </div>
    <div class="links">
      <router-link
        to="/settings"
        :class="{'links_selected': route.path === '/settings' }"
      >
        Настройки
      </router-link>
      <span @click="logout">Выход</span>
    </div>
  </header>
</template>

<script setup>
import { useAuthUser } from "@/stores/index.js";
import { useRoute, useRouter } from "vue-router";


const router = useRouter();
const route = useRoute();
const logout = () => {
  useAuthUser().clearToken();
  router.push({ name: 'login' })
}
</script>

<style scoped lang="scss">
.header {
  display: flex;
  justify-content: space-between;
  position: sticky;
  top: 0;
  width: 100%;
  padding: 20px;
  border: 2px solid #1E1E1E;
  border-radius: 10px;
}

.links {
  display: flex;
  gap: 60px;
  & a {
    color: inherit;
  }
  & > * {
    cursor: pointer;
  }
  &_selected {
    text-decoration: underline;
    text-decoration-thickness: 1px;
  }
}
</style>