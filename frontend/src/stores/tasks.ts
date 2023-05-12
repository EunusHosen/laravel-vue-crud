import { defineStore } from 'pinia'
import type TaskInterface from '@/types/Task'

export const useTasksStore = defineStore('tasks', {
  state: () => ({
    tasks: [] as TaskInterface[],
    completedTasks: [] as TaskInterface[]
  }),

  actions: {
    getTasks() {
      return [
        {
          id: 1,
          name: 'GraphQL API',
          description: 'Lorem ipsum',
          dueDate: 'March 17, 2023',
          dueDateTime: '2023-03-17T00:00Z'
        },
        {
          id: 2,
          name: 'New benefits plan',
          description: 'Lorem ipsum',
          dueDate: 'May 5, 2023',
          dueDateTime: '2023-05-05T00:00Z'
        },
        {
          id: 3,
          name: 'Onboarding emails',
          description: 'Lorem ipsum',
          dueDate: 'May 25, 2023',
          dueDateTime: '2023-05-25T00:00Z'
        },
        {
          id: 4,
          name: 'iOS app',
          description: 'Lorem ipsum',
          dueDate: 'June 7, 2023',
          dueDateTime: '2023-06-07T00:00Z'
        },
        {
          id: 5,
          name: 'Marketing site redesign',
          overdue: true,
          description: 'Lorem ipsum',
          dueDate: 'June 10, 2023',
          dueDateTime: '2023-06-10T00:00Z'
        }
      ]
    },

    addTask(task: TaskInterface) {
      this.tasks.push(task)
    },

    getTask(id: number) {
      return this.getTasks().find((task) => task.id == id)
    },

    updateTask(task: TaskInterface) {
      const index = this.tasks.indexOf(task)
      this.tasks[index] = task
    },

    completeTask(task: TaskInterface) {
      const index = this.tasks.indexOf(task)
      this.tasks.splice(index, 1)

      task.completed = true
      this.completedTasks.push(task)
    },

    deleteTask(task: TaskInterface) {
      const index = this.tasks.indexOf(task)
      this.tasks.splice(index, 1)
    }
  }
})
