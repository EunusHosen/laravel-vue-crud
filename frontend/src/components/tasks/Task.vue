<script setup lang="ts">
import { defineProps } from 'vue'
import TaskInterface from '@/types/Task'

defineProps({
  task: {
    type: Object as () => TaskInterface,
    required: true
  }
})
</script>

<template>
  <li :key="task.id" class="flex items-center justify-between gap-x-6 py-5">
    <RouterLink :to="{ name: 'tasks.show', params: { id: task.id } }" class="min-w-0">
      <div class="flex items-start gap-x-3">
        <p class="text-sm font-semibold leading-6 text-indigo-600">{{ task.name }}</p>

        <p
          v-if="task.overdue"
          class="rounded-md whitespace-nowrap mt-0.5 px-1.5 py-0.5 text-xs font-medium ring-1 ring-inset text-yellow-800 bg-yellow-50 ring-yellow-600/20"
        >
          Overdue
        </p>
      </div>
      <div class="mt-1 flex items-center gap-x-2 text-xs leading-5 text-gray-500">
        <p class="whitespace-nowrap">
          Due on
          <time :datetime="task.dueDate">{{ task.dueDate }}</time>
        </p>
      </div>
    </RouterLink>

    <div class="flex flex-none items-center gap-x-4">
      <RouterLink
        :to="{ name: 'tasks.show', params: { id: task.id } }"
        class="hidden rounded-md bg-white px-2.5 py-1.5 text-sm text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:block"
        >View task<span class="sr-only">, {{ task.name }}</span></RouterLink
      >
    </div>
  </li>
</template>
