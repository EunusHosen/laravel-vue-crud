<script setup lang="ts">
import { reactive } from 'vue'
import { useRouter } from 'vue-router'
import { useTasksStore } from '@/stores/tasks'
import { useAppStore } from '@/stores/app'
import TaskForm from '@/components/tasks/TaskForm.vue'
import MainContent from '@/components/MainContent.vue'

const errors = reactive({})

const router = useRouter()

const taskStore = useTasksStore()
const appStore = useAppStore()

const submit = (task) => {
  taskStore.addTask(task)
  appStore.setSuccessMessage('Task added successfully')
  router.push({ name: 'home' })
}
</script>

<template>
  <MainContent title="Add New Task">
    <div class="mt-6 text-gray-600 max-w-4xl">
      <TaskForm @submit="submit" :errors="errors" />
    </div>
  </MainContent>
</template>
