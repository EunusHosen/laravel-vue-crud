<script setup lang="ts">
import Tasks from "@/components/tasks/Tasks.vue";
import MainContent from "@/components/MainContent.vue";
import {useTasksStore} from "@/stores/tasks";

const tasksStore = useTasksStore();
const tasks = tasksStore.getTasks();
</script>

<template>
    <MainContent title="Completed Tasks">
        <template #actions>
            <RouterLink
                :to="{ name: 'tasks.new' }"
                type="button" class="ml-3 inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm text-white shadow-sm hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">New Task</RouterLink>
        </template>

        <Tasks :tasks="tasks" />
    </MainContent>
</template>
