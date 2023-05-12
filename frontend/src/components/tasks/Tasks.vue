<script setup lang="ts">
import Task from '@/components/tasks/Task.vue'
import type TaskInterface from '@/types/Task'

defineProps({
  tasks: {
    type: Array as () => TaskInterface[],
    required: true
  }
})
</script>

<template>
  <ul role="list" class="divide-y divide-gray-100">
    <Task v-for="task in tasks" :task="task" :key="task.id" />
  </ul>
</template>
