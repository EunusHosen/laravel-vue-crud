<script setup lang="ts">
defineProps({
  task: {
    type: Object,
    required: true
  },
  active: {
    type: Boolean,
    required: true
  }
})
</script>

<template>
  <RouterLink
    :to="{ name: 'tasks.edit', params: { id: task.id } }"
    :class="[active ? 'bg-gray-50' : '', 'block px-3 py-1 text-sm leading-6 text-indigo-600']"
    >Mark as Complete<span class="sr-only">, {{ task.name }}</span></RouterLink
  >
</template>
