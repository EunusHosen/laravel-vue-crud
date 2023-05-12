<script setup lang="ts">
import MainContent from '@/components/MainContent.vue'
import EditAction from '@/components/tasks/EditAction.vue'
import DeleteAction from '@/components/tasks/DeleteAction.vue'
import { CalendarDaysIcon, CalendarIcon } from '@heroicons/vue/20/solid'

const task = {
  id: 1,
  name: 'GraphQL API',
  description:
    'Build a GraphQL API for the application. The API should be able to create, read, update, and delete tasks. The API should also be able to mark tasks as complete.',
  href: '#',
  status: 'Complete',
  createdBy: 'Leslie Alexander',
  dueDate: 'March 17, 2023',
  dueDateTime: '2023-03-25T00:00Z',
  createdAt: '2023-03-17T00:00Z',
  updatedAt: '2023-03-18T00:00Z'
}
</script>

<template>
  <MainContent :title="task.name">
    <template #actions>
      <EditAction :task="task" />
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
