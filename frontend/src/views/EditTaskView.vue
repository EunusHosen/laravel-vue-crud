<script setup lang="ts">
import { reactive } from 'vue'
import { useRouter } from 'vue-router'
import { useAppStore } from '@/stores/app'
import { useTasksStore } from '@/stores/tasks'
import TaskForm from '@/components/tasks/TaskForm.vue'
import MainContent from '@/components/MainContent.vue'

const errors = reactive({})

const router = useRouter()

const taskStore = useTasksStore()
const appStore = useAppStore()
const task = reactive({
  name: 'Task name',
  description: 'Task description here...',
  dueDate: '2023-05-23'
});

const submit = (task) => {
  taskStore.addTask(task)
  appStore.setSuccessMessage('Task updated successfully')
  router.push({ name: 'home' })
}
</script>

<template>
  <MainContent title="Edit Task">
    <div class="mt-6 text-gray-600 max-w-4xl">
      <TaskForm
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
