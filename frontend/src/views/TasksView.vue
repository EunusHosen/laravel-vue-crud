<script setup lang="ts">
import { computed } from 'vue'
import { useTasksStore } from '@/stores/tasks'
import Tasks from '@/components/tasks/Tasks.vue'
import MainContent from '@/components/MainContent.vue'

const tasksStore = useTasksStore()
tasksStore.fetchTasks()

const tasks = computed(() => {
  return tasksStore.tasks
})
</script>

<template>
  <MainContent title="Tasks in Todo">
    <template #actions>
      <RouterLink
        :to="{ name: 'tasks.new' }"
        type="button"
        class="ml-3 inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm text-white shadow-sm hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
      >
        New Task
      </RouterLink>
    </template>

    <Tasks :tasks="tasks" />
  </MainContent>
</template>
