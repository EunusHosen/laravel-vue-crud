<script setup lang="ts">
defineProps({
  htmlFor: {
    type: String,
    required: true
  },
  label: {
    type: String,
    required: true
  }
})
</script>

<template>
  <label :for="htmlFor" class="block text-sm font-medium leading-6 text-gray-900">{{
    label
  }}</label>
</template>
