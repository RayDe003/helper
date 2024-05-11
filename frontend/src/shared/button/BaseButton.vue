<template>
  <button
    class="base-button"
    :class="{
      'base-button_w-full': fullWidth,
      'base-button_transparent': bgTransparent
    }"
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
  },
  borderRadius: {
    type: String,
    default: '8px'
  }
});
const fontSizeStr = computed(() => `${props.fontSize}px`);
</script>

<style scoped lang="scss">
$font-family: v-bind(fontFamily);
$font-size: v-bind(fontSizeStr);
$font-weight: v-bind(fontWeight);

.base-button {
  border-radius: v-bind(borderRadius);
  padding: v-bind(padding);
  background: $accent-purple;
  font-weight: $font-weight;
  font-size: $font-size;
  line-height: 120%;
  color: #fff;
  cursor: pointer;
  border: none;

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
