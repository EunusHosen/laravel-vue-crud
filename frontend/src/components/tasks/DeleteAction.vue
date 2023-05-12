<script setup lang="ts">
import { ref } from 'vue'
import DangerModal from '@/components/DangerModal.vue'

defineProps({
  task: {
    type: Object,
    required: true
  }
})

const showModal = ref(false)

const clickButton = () => {
  showModal.value = true
}

const deleteTask = () => {
  console.log('deleteTask')
  showModal.value = false
}
</script>

<template>
  <div>
    <button
      @click.prevent="clickButton"
      class="ml-3 inline-flex items-center rounded-md bg-red-600 px-3 py-2 text-sm text-white shadow-sm hover:bg-red-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600"
    >
      Delete<span class="sr-only">, {{ task.name }}</span>
    </button>

    <DangerModal
      :show="showModal"
      title="Delete Task"
      description="Are you sure you want to delete this task? The task will be permanently removed. This action cannot be undone."
      :danger-action="deleteTask"
      danger-button-text="Delete Task"
      @close="showModal = false"
    />
  </div>
</template>
