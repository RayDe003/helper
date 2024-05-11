<template>
  <div class="toast">
    <ellipses-icon @click="showMenu" class="toast-icon" />
    <menu
      class="toast-menu"
      v-if="isShowedMenu"
      :ref="menu"
      v-on-click-outside="isShowedMenu ? showMenu : null"
    >
      <li class="toast-menu__item" v-if="mode === 'diary'">Настроить</li>
      <li class="toast-menu__item" v-else>Перерандомить задачу</li>
      <li class="toast-menu__item" @click="emit('delete-task')">Удалить</li>
    </menu>
  </div>
</template>

<script setup>
import { vOnClickOutside } from '@vueuse/components';
import { ref } from 'vue';

import { EllipsesIcon } from '@/shared';

defineProps({
  mode: {
    type: String,
    default: 'diary',
    validator: (value) => ['diary', 'procrastination'].includes(value)
  }
});

const emit = defineEmits(['delete-task']);
const isShowedMenu = ref(false);

const menu = ref();

const showMenu = () => (isShowedMenu.value = !isShowedMenu.value);
</script>

<style scoped lang="scss">
.toast {
  display: flex;
  position: relative;

  &-icon {
    cursor: pointer;
  }

  &-menu {
    position: absolute;
    display: flex;
    flex-direction: column;
    gap: 4px;
    width: 250px;
    padding-block: 17px;
    list-style: none;
    right: -10px;
    top: 30px;
    border-radius: 7px;
    border: 1px solid $accent-black;
    background: white;
    z-index: 5;

    &__item {
      width: 100%;
      padding: 3px 20px;
      line-height: 150%;
      cursor: pointer;
      &:hover {
        background: rgba($accent-purple, 0.2);
      }
    }
  }
}
</style>
