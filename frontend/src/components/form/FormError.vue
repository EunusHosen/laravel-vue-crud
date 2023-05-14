<script setup lang="ts">
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
