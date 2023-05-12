<script setup lang="ts">
import { computed } from 'vue'
import { useTasksStore } from '@/stores/tasks'
import Tasks from '@/components/tasks/Tasks.vue'
import MainContent from '@/components/MainContent.vue'

const tasksStore = useTasksStore()
tasksStore.fetchCompletedTasks()

const tasks = computed(() => {
  return tasksStore.completedTasks
})
</script>

<template>
  <MainContent title="Completed Tasks">
    <Tasks :tasks="tasks" />
  </MainContent>
</template>
