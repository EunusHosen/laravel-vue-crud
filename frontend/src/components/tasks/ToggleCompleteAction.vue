<script setup lang="ts">
import router from '@/router'
import { useAppStore } from '@/stores/app'
import { useTasksStore } from '@/stores/tasks'

const props = defineProps({
  task: {
    type: Object,
    required: true
  }
})

const appStore = useAppStore()
const taskStore = useTasksStore()

const toggleComplete = () => {
  taskStore.toggleComplete(props.task.id).then(() => {
    const message = props.task.completed ? 'Task marked as incomplete' : 'Task marked as complete'
    appStore.setSuccessMessage(message)
    router.push({ name: props.task.completed ? 'home' : 'tasks.completed' })
  })
}
</script>

<template>
  <button
    @click.prevent="toggleComplete"
    class="inline-flex items-center rounded-md bg-indigo-400 px-4 py-2 text-sm text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-400"
  >
    Mark as {{ task.completed ? 'Incomplete' : 'Complete' }}
    <span class="sr-only">, {{ task.name }}</span>
  </button>
</template>
