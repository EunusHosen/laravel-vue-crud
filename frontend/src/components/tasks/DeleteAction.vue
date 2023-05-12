<script setup lang="ts">
import { ref } from 'vue'
import router from "@/router";
import {useAppStore} from "@/stores/app";
import {useTasksStore} from "@/stores/tasks";
import DangerModal from '@/components/DangerModal.vue'

const props = defineProps({
  task: {
    type: Object,
    required: true
  }
})

const show = ref(false)

const tasksStore = useTasksStore();

const showModal = () => {
  show.value = true
}

const deleteTask = () => {
  tasksStore.deleteTask(props.task.id)
  useAppStore().setSuccessMessage('Task deleted successfully')
  router.push({ name: 'home' })
  show.value = false
}
</script>

<template>
  <div>
    <button
      @click.prevent="showModal"
      class="inline-flex items-center rounded-md bg-red-600 px-4 py-2 text-sm text-white shadow-sm hover:bg-red-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600"
    >
      Delete<span class="sr-only">, {{ task.name }}</span>
    </button>

    <DangerModal
      :show="show"
      title="Delete Task"
      description="Are you sure you want to delete this task? The task will be permanently removed. This action cannot be undone."
      :danger-action="deleteTask"
      danger-button-text="Delete Task"
      @close="show = false"
    />
  </div>
</template>
