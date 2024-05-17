<template>
  <div class="select">
    Режим:
    <div class="select__mode">
      <span @click="showSelect">
        {{ mods[selectedModIndex] }}
      </span>
      <corner-icon :class="{ icon_rotate: isShowedSelect }" />
      <div
        class="select__block"
        v-if="isShowedSelect"
        @click="switchMode(selectedModIndex ? 0 : 1)"
      >
        {{ mods[selectedModIndex ? 0 : 1] }}
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

import { CornerIcon } from '@/shared';

const props = defineProps({
  initMode: { type: Number, default: 0 }
});

const emits = defineEmits(['switch-mode']);

const mods = ['Ежедневник', 'Спасатель от прокрастинации'];

const selectedModIndex = ref(props.initMode);
const isShowedSelect = ref(false);

const showSelect = () => (isShowedSelect.value = !isShowedSelect.value);

const switchMode = (value) => {
  selectedModIndex.value = value;
  emits('switch-mode', value);
  showSelect();
};
</script>

<style scoped lang="scss">
.select {
  display: flex;
  gap: 12px;
  user-select: none;
  &__mode {
    display: flex;
    width: 100%;
    height: fit-content;
    position: relative;
    cursor: pointer;
    align-items: center;
    gap: 8px;
  }
  &__block {
    background: #fff;
    border: 2px solid $accent-black;
    padding: 10px;
    line-height: 1;
    border-radius: 3px;
    position: absolute;
    bottom: -5px;
    transform: translateY(100%);
  }
}
.icon {
  &_rotate {
    transition: all 0.2s;
    transform: rotate(180deg);
  }
}
</style>
