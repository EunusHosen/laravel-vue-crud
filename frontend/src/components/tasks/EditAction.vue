<script setup lang="ts">
defineProps({
  task: {
    type: Object,
    required: true
  }
})
</script>

<template>
  <RouterLink
    :to="{ name: 'tasks.edit', params: { id: task.id } }"
    class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm text-white shadow-sm hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
    >Edit<span class="sr-only">, {{ task.name }}</span>
  </RouterLink>
</template>
