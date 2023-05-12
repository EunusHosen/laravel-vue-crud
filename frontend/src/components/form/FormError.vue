<script setup lang="ts">
import { defineProps } from 'vue'

defineProps({
  errors: {
    type: Array,
    required: true
  }
})
</script>

<template>
  <div class="mt-1 text-red-500 text-sm" v-if="errors.length">
    {{ errors[0] }}
  </div>
</template>
