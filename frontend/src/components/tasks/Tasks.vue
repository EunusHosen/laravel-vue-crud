<script setup lang="ts">
import type TaskInterface from '@/types/Task'
import Task from '@/components/tasks/Task.vue'
import Pagination from '@/components/Pagination.vue'

defineProps({
  tasks: {
    type: Object as () => {
      data: TaskInterface[]
      meta: { last_page: number; current_page: number }
    },
    required: true
  },

  nextPage: {
    type: Function as () => () => void,
    required: true
  },

  previousPage: {
    type: Function as () => () => void,
    required: true
  }
})
</script>

<template>
  <ul role="list" class="divide-y divide-gray-100">
    <Task v-for="task in tasks.data" :task="task" :key="task.id" />
  </ul>

  <div class="mt-16" v-if="tasks.meta && tasks.meta.last_page > 1">
    <Pagination
      :next-page="nextPage"
      :previous-page="previousPage"
      :last-page="tasks.meta.last_page || 1"
      :current-page="tasks.meta.current_page || 1"
    />
  </div>
</template>
