<script setup lang="ts">
import { useRouter } from 'vue-router'
import { computed, reactive } from 'vue'
import { useAppStore } from '@/stores/app'
import { useTasksStore } from '@/stores/tasks'
import MainContent from '@/components/MainContent.vue'
import TaskForm from '@/components/tasks/TaskForm.vue'

const errors = reactive({})

const router = useRouter()

const appStore = useAppStore()
const taskStore = useTasksStore()

const id = router.currentRoute.value.params.id as number
taskStore.fetchTask(id)

const task = computed(() => {
  return taskStore.currentTask
})

const submit = (updatedTask) => {
  updatedTask.id = task.value.id
  taskStore
    .updateTask(updatedTask)
    .then(() => {
      appStore.setSuccessMessage('Task updated successfully')
      router.push({ name: 'home' })
    })
    .catch((error) => {
      Object.keys(error.response.data.errors).forEach((key) => {
        errors[key] = error.response.data.errors[key]
      })
    })
}
</script>

<template>
  <MainContent title="Edit Task">
    <div class="mt-6 text-gray-600 max-w-4xl">
      <TaskForm
        v-if="task.name"
        :name="task.name"
        :description="task.description"
        :due-date="task.dueDate"
        @submit="submit"
        :errors="errors"
        action-text="Update Task"
      />
    </div>
  </MainContent>
</template>
