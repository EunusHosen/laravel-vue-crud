<script setup lang="ts">
import { computed } from 'vue'
import { useRouter } from 'vue-router'
import { useTasksStore } from '@/stores/tasks'
import MainContent from '@/components/MainContent.vue'
import EditAction from '@/components/tasks/EditAction.vue'
import DeleteAction from '@/components/tasks/DeleteAction.vue'
import { CalendarDaysIcon, CalendarIcon } from '@heroicons/vue/20/solid'
import ToggleCompleteAction from '@/components/tasks/ToggleCompleteAction.vue'

const router = useRouter()
const tasksStore = useTasksStore()

const id = router.currentRoute.value.params.id as number
tasksStore.fetchTask(id)

const task = computed(() => {
  return tasksStore.currentTask
})
</script>

<template>
  <MainContent v-if="task.name" :title="task.name">
    <template #actions>
      <EditAction :task="task" />
      <ToggleCompleteAction :task="task" />
      <DeleteAction :task="task" />
    </template>

    <template #meta>
      <div class="flex-col sm:flex sm:flex-row sm:gap-4 gap-1">
        <div class="flex gap-1">
          <CalendarDaysIcon class="w-4" />
          Due On: {{ task.dueDate }}
        </div>

        <div class="flex gap-1">
          <CalendarIcon class="w-4" />
          Created At: {{ task.createdAt }}
        </div>
      </div>
    </template>

    <div class="mt-6 text-gray-600 max-w-4xl">
      {{ task.description }}
    </div>
  </MainContent>
</template>
