<template>
  <button
    class="base-button"
    :class="{ 'base-button_w-full': fullWidth, 'base-button_transparent': bgTransparent }"
  >
    <slot />
  </button>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
  bgTransparent: {
    type: Boolean,
    default: true
  },
  fullWidth: {
    type: Boolean,
    default: false
  },
  padding: {
    type: String,
    default: '0'
  },
  fontFamily: {
    type: String,
    default: 'base',
    validator: (value) => ['base', 'second'].includes(value)
  },
  fontSize: {
    type: Number,
    default: 20
  },
  fontWeight: {
    type: Number,
    default: 400
  }
});
const fontSizeStr = computed(() => `${props.fontSize}px`);
</script>

<style scoped lang="scss">
$font-family: v-bind(fontFamily);
$font-size: v-bind(fontSizeStr);
$font-weight: v-bind(fontWeight);

.base-button {
  padding: v-bind(padding);
  background: $main-color;
  color: #fff;
  font-size: $font-size;
  font-weight: $font-weight;
  border-radius: 8px;
  line-height: 120%;
  @if ($font-family == 'base') {
    font-family: $base-font;
  } @else {
    font-family: $second-font;
  }
  &_transparent {
    background: transparent;
    border: 2px solid $main-color;
    color: $main-color;
  }
  &_w-full {
    width: 100%;
  }
}
</style>
